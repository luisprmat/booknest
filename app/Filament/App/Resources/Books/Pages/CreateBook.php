<?php

namespace App\Filament\App\Resources\Books\Pages;

use App\Filament\App\Resources\Books\BookResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBook extends CreateRecord
{
    protected static string $resource = BookResource::class;
}
