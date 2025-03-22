<?php

namespace Likewares\Module\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class EnableCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:enable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Activer le module spécifié.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $module = $this->laravel['module']->findOrFail($this->argument('alias'));

        if ($module->disabled()) {
            $module->enable();

            $this->info("Module [{$module}] activé avec succès.");
        } else {
            $this->comment("Le module [{$module}] est déjà activé.");
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
