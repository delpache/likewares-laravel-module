<?php

namespace Likewares\Module\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class DisableCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:disable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Désactiver le module spécifié.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $module = $this->laravel['module']->findOrFail($this->argument('alias'));

        if ($module->enabled()) {
            $module->disable();

            $this->info("Module [{$module}] désactivé avec succès.");
        } else {
            $this->comment("Le module [{$module}] est déjà désactivé.");
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['alias', InputArgument::REQUIRED, 'Module alias.'],
        ];
    }
}
