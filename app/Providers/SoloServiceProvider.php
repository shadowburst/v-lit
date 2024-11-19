<?php

namespace App\Providers;

use AaronFrancis\Solo\Commands\EnhancedTailCommand;
use AaronFrancis\Solo\Facades\Solo;
use AaronFrancis\Solo\Providers\SoloApplicationServiceProvider;

class SoloServiceProvider extends SoloApplicationServiceProvider
{
    public function register()
    {
        Solo::useTheme('dark')
            // Commands that auto start.
            ->addCommands([
                'Vite' => 'npm run dev',
                'Queue' => 'php artisan queue:listen --tries=1',
                'Reverb' => 'php artisan reverb:start',
                EnhancedTailCommand::make('Logs', 'tail -f -n 100 '.storage_path('logs/laravel.log')),
            ])
            // Not auto-started
            ->addLazyCommands([
                'Test-PHP' => 'php artisan test',
                'Test-JS' => 'npm run test',
                'Pint' => 'php ./vendor/bin/pint --ansi',
            ]);
    }

    public function boot() {}
}
