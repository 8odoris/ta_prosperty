<?php

namespace App\Helpers;

use Illuminate\Contracts\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class DBHelper
{

    public static function concatAs(string $column1, string $column2, string $as = '', string $separator = ' '): Expression
    {
        return DB::raw("CONCAT_WS('$separator', `$column1`, `$column2`)" . (!empty($as) ? " AS `$as`" : ""));
    }

    public static function calcAge(string $column1, string $column2): Expression
    {
        return DB::raw("TIMESTAMPDIFF(YEAR, `$column1`, COALESCE(`$column2`, NOW()))");
    }
}
