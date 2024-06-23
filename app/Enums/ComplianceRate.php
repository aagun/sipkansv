<?php

namespace App\Enums;

enum ComplianceRate: string
{
    case EXCELLENT = 'Baik Sekali';
    case SATISFACTORY = 'Baik';
    case UNSATISFACTORY = 'Kurang Baik';

}
