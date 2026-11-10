<?php

namespace App\Providers\Filament;

use Filament\Panel;
use Filament\PanelProvider;

abstract class BasePanelProvider extends PanelProvider
{
    public function basePanel(Panel $panel): Panel
    {
        return $panel
            ->brandName('BookNest')
            ->brandLogo('/images/booknest-logo.png')
            ->favicon('/images/favicon.ico')
            ->brandLogoHeight('2.4rem')
            ->darkMode(false)
            ->font('Source Sans 3')
            ->sidebarWidth('250px')
            ->sidebarCollapsibleOnDesktop()
            ->topbar(false)
            ->viteTheme('resources/css/filament/theme.css')
            ->globalSearch(false)
            ->spa();
    }
}
