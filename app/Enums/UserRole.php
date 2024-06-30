<?php

namespace App\Enums;

enum UserRole: string
{
    case RO_ADMIN = 'RO_ADMIN';
    case RO_SUPERVISOR = 'RO_SUPERVISOR';
    case RO_OPERATOR = 'RO_OPERATOR';
    case RO_HEAD = 'RO_HEAD';
}
