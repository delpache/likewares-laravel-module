<?php

namespace Likewares\Module\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class PublishConfigurationCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:publish-config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publier les fichiers de configuration d\'un module dans l\'application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($alias = $this->argument('alias')) {
            $this->publishConfiguration($alias);

            return;
        }

        foreach ($this->laravel['module']->allEnabled() as $module) {
            $this->publishConfiguration($module->getAlias());
        }
    }

    /**
     * @param string $alias
     * @return string
     */
    private function getServiceProviderForModule($alias)
    {
        $namespace = $this->laravel['config']->get('module.namespace');
        $studlyName = Str::studly($alias);

        return "$namespace\\$studlyName\\Providers\\Main";
    }

    /**
     * @param string $alias
     */
    private function publishConfiguration($alias)
    {
        $this->call('vendor:publish', [
            '--provider' => $this->getServiceProviderForModule($alias),
            '--force' => $this->option('force'),
            '--tag' => ['config'],
        ]);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['alias', InputArgument::OPTIONAL, 'Alias du module qui sera utilisé.'],
        ];
    }

    /**
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['--force', '-f', InputOption::VALUE_NONE, 'Forcer la publication des fichiers de configuration'],
        ];
    }
}
