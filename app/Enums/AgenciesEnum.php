<?php

namespace App\Enums;

use App\Traits\HasEnumConverter;

enum AgenciesEnum: string
{
    use HasEnumConverter;

    case CIA = 'CIA';
    case MI6 = 'MI6';
    case AGENCY3 = 'agency3';
    case AGENCY4 = 'agency4';
}
