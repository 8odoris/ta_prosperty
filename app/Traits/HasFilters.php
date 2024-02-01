<?php

namespace App\Traits;

use App\Helpers\DBHelper;
use Illuminate\Database\Eloquent\Builder;

trait HasFilters
{
    public function applyFilters(array $filters): Builder
    {
        $query = $this::query()->select()->addSelect(DBHelper::concatAs('name', 'surname', 'full_name'));

        foreach ($filters as $key => $filter) {
            match ($key) {
                'orderBy' => $this->multipleOrderBy($query, $filter),
                'age' => $query->whereBetween(DBHelper::calcAge('birth_date', 'death_date'), [$filter['min'], $filter['max']]),
                'full_name' => $query->where(DBHelper::concatAs('name', 'surname'), 'like', "%$filter%"),
            };
        }

        return $query;
    }

    protected function multipleOrderBy(Builder &$query, array $filter): void
    {
        foreach ($filter as $column => $direction) {
            $query->orderBy($column, $direction);
        }
    }
}
