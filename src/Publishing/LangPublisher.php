<?php

namespace Likewares\Module\Publishing;

use Likewares\Module\Support\Config\GenerateConfigReader;

class LangPublisher extends IPublisher
{
    /**
     * Determine whether the result message will shown in the console.
     *
     * @var bool
     */
    protected $showMessage = false;

    /**
     * Get destination path.
     *
     * @return string
     */
    public function getDestinationPath()
    {
        $name = $this->module->getLowerName();

        return base_path("resources/lang/{$name}");
    }

    /**
     * Get source path.
     *
     * @return string
     */
    public function getSourcePath()
    {
        return $this->getModule()->getExtraPath(
            GenerateConfigReader::read('lang')->getPath()
        );
    }
}
