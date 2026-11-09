<?php

namespace App\Filament\App\Resources\BookUsers\Pages;

use App\Filament\App\Resources\BookUsers\BookUserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBookUser extends EditRecord
{
    protected static string $resource = BookUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
