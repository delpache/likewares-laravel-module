<?php

namespace Likewares\Module\Commands;

use Illuminate\Console\Command;

class SetupCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Configuration des dossiers de modules pour la première utilisation.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->generateModulesFolder();

        $this->generateAssetsFolder();
    }

    /**
     * Generate the modules folder.
     */
    public function generateModulesFolder()
    {
        $this->generateDirectory(
            $this->laravel['module']->config('paths.modules'),
            'Répertoire des modules créé avec succès',
            'Le répertoire des modules existe déjà'
        );
    }

    /**
     * Generate the assets folder.
     */
    public function generateAssetsFolder()
    {
        $this->generateDirectory(
            $this->laravel['module']->config('paths.assets'),
            'Répertoire Assets créé avec succès',
            'Le répertoire Assets existe déjà'
        );
    }

    /**
     * Generate the specified directory by given $dir.
     *
     * @param $dir
     * @param $success
     * @param $error
     */
    protected function generateDirectory($dir, $success, $error)
    {
        if (!$this->laravel['files']->isDirectory($dir)) {
            $this->laravel['files']->makeDirectory($dir, 0755, true, true);

            $this->info($success);

            return;
        }

        $this->error($error);
    }
}
