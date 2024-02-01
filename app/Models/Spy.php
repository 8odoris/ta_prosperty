<?php

namespace App\Models;

use App\Enums\AgenciesEnum;
use Illuminate\Database\Eloquent\Builder;
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
 */
class Spy extends Model
{
    use HasFactory;

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
}
