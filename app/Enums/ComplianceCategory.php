<?php

namespace App\Enums;

enum ComplianceCategory: string
{
    case COMPLIANT = 'Patuh';
    case NON_COMPLIANT = 'Tidak Patuh';
}
