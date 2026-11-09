<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum BookStatus: string implements HasColor, HasLabel
{
    case Requested = 'requested';
    case Borrowed = 'borrowed';
    case Returned = 'returned';

    public function getLabel(): string|Htmlable|null
    {
        return __($this->name);
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Requested => 'warning',
            self::Borrowed => 'success',
            self::Returned => 'gray',
        };
    }

    public function getBadgeLabel(): string
    {
        return match ($this) {
            self::Requested => __('Requested'),
            self::Borrowed => __('Currently Reading'),
            self::Returned => __('Read Before'),
        };
    }
}
