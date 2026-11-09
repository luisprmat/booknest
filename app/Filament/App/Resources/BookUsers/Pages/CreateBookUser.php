<?php

namespace App\Filament\App\Resources\BookUsers\Pages;

use App\Filament\App\Resources\BookUsers\BookUserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBookUser extends CreateRecord
{
    protected static string $resource = BookUserResource::class;
}
