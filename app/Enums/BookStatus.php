<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum BookStatus: string implements HasLabel
{
    case Requested = 'requested';
    case Borrowed = 'borrowed';
    case Returned = 'returned';

    public function getLabel(): string|Htmlable|null
    {
        return __($this->name);
    }
}
