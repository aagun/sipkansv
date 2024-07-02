<?php

namespace App\Enums;

enum ObservationType: string
{
    case PATROLI_ATAU_PERONDAAN = 'Patroli/Perondaan';
    case PENGAWASAN_RUTIN = 'Pengawasan Rutin';
    case PENGAWASAN_INSIDENTAL = 'Pengawasan Insidental';
}
