<?php

namespace App\Filament\App\Resources\Books\Pages;

use App\Filament\App\Resources\Books\BookResource;
use Filament\Resources\Pages\ViewRecord;

class ViewBook extends ViewRecord
{
    protected static string $resource = BookResource::class;

    public function getHeading(): string
    {
        return '';
    }

    public function getTitle(): string
    {
        return $this->record->title;
    }
}
