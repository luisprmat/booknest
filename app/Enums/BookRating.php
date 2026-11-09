<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum BookRating: int implements HasLabel
{
    case Excellent = 5;
    case VeryGood = 4;
    case Good = 3;
    case Fair = 2;
    case Poor = 1;

    public function getLabel(): string|Htmlable|null
    {
        return $this->value.' - '.__(str($this->name)->snake(' ')->title()->value);
    }
}
