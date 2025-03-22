<?php

namespace Likewares\Module\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class UseCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:use';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Utiliser le module spécifié.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $alias = Str::kebab($this->argument('alias'));

        if (!$this->laravel['module']->has($alias)) {
            $this->error("Le module [{$alias}] n'existe pas.");

            return;
        }

        $this->laravel['module']->setUsed($alias);

        $this->info("Module [{$alias}] utilisé avec succès.");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['alias', InputArgument::REQUIRED, 'Alias du module qui sera utilisé.'],
        ];
    }
}
