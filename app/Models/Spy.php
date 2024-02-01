<?php

namespace App\Models;

use App\Enums\AgenciesEnum;
use App\Traits\HasFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Spy
 *
 * @mixin Builder
 *
 * @property-read int $id
 *
 * @property string $name
 * @property string $surname
 * @property string $agency
 * @property string $country_of_operation
 * @property Carbon $birth_date
 * @property Carbon $death_date
 *
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read string $full_name
 */
class Spy extends Model
{
    use HasFactory, HasFilters;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['name', 'surname', 'agency', 'country_of_operation', 'birth_date', 'death_date'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'agency' => AgenciesEnum::class,
        'birth_date' => 'date:Y-m-d',
        'death_date' => 'date:Y-m-d',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Scope a query to include random spies.
     *
     * @param Builder $query
     * @param int $limit
     * @return void
     */
    public function scopeRandomSpies(Builder $query, int $limit): void
    {
        $query->inRandomOrder()->limit($limit);
    }

    /**
     * Get the spy's full name.
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => $attributes['name'] . ' ' . $attributes['surname']
        );
    }
}
