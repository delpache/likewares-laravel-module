<?php

namespace Likewares\Module\Commands;

use Illuminate\Console\Command;

class UnUseCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:unuse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Oublier le module utilisé avec module:use';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->laravel['module']->forgetUsed();

        $this->info('Module précédent utilisé avec succès oublié.');
    }
}
