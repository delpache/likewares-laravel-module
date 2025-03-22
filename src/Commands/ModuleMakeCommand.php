<?php

namespace Likewares\Module\Commands;

use Likewares\Module\Generators\ModuleGenerator;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ModuleMakeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Créer un nouveau module.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $aliases = $this->argument('alias');

        foreach ($aliases as $alias) {
            with(new ModuleGenerator($alias))
                ->setFilesystem($this->laravel['files'])
                ->setModule($this->laravel['module'])
                ->setConfig($this->laravel['config'])
                ->setConsole($this)
                ->setForce($this->option('force'))
                ->setPlain($this->option('plain'))
                ->generate();
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
            ['alias', InputArgument::IS_ARRAY, 'Les alias des modules seront créés.'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['plain', 'p', InputOption::VALUE_NONE, 'Générer un module simple (sans ressources).'],
            ['force', null, InputOption::VALUE_NONE, 'Forcer l\'exécution de l\'opération lorsque le module existe déjà.'],
        ];
    }
}
