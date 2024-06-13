<?php

namespace App\Enums;

enum HttpResponseStatus: string
{
    case SUCCESS = 'success';

    case ERROR = 'error';
}
