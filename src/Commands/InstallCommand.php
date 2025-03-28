<?php

namespace Likewares\Module\Commands;

use Illuminate\Console\Command;
use Likewares\Module\Json;
use Likewares\Module\Process\Installer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installer le module spécifié par l\'alias de package donné (vendor/nom).';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (is_null($this->argument('alias'))) {
            $this->installFromFile();

            return;
        }

        $this->install(
            $this->argument('alias'),
            $this->argument('version'),
            $this->option('type'),
            $this->option('tree')
        );
    }

    /**
     * Install modules from modules.json file.
     */
    protected function installFromFile()
    {
        if (!file_exists($path = base_path('modules.json'))) {
            $this->error("Le fichier 'modules.json' n'existe pas à la racine de votre projet.");

            return;
        }

        $modules = Json::make($path);

        $dependencies = $modules->get('require', []);

        foreach ($dependencies as $module) {
            $module = collect($module);

            $this->install(
                $module->get('alias'),
                $module->get('version'),
                $module->get('type')
            );
        }
    }

    /**
     * Install the specified module.
     *
     * @param string $name
     * @param string $version
     * @param string $type
     * @param bool   $tree
     */
    protected function install($alias, $version = 'dev-master', $type = 'composer', $tree = false)
    {
        $installer = new Installer(
            $alias,
            $version,
            $type ?: $this->option('type'),
            $tree ?: $this->option('tree')
        );

        $installer->setRepository($this->laravel['module']);

        $installer->setConsole($this);

        if ($timeout = $this->option('timeout')) {
            $installer->setTimeout($timeout);
        }

        if ($path = $this->option('path')) {
            $installer->setPath($path);
        }

        $installer->run();

        if (!$this->option('no-update')) {
            $this->call('module:update', [
                'alias' => $installer->getModuleAlias(),
            ]);
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
            ['alias', InputArgument::OPTIONAL, 'Alias du module à installer.', ''],
            ['version', InputArgument::OPTIONAL, 'La version du module à installer.', ''],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['timeout', null, InputOption::VALUE_OPTIONAL, 'Délai d\'attente du processus.', null],
            ['path', null, InputOption::VALUE_OPTIONAL, 'Chemin d\'installation.', null],
            ['type', null, InputOption::VALUE_OPTIONAL, 'Type installation.', null],
            ['tree', null, InputOption::VALUE_NONE, 'Installer le module en tant que git subtree', null],
            ['no-update', null, InputOption::VALUE_NONE, 'Désactive la mise à jour automatique des dépendances.', null],
        ];
    }
}
