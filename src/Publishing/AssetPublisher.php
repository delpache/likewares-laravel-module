<?php

namespace Likewares\Module\Publishing;

use Likewares\Module\Support\Config\GenerateConfigReader;

class AssetPublisher extends IPublisher
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
        return $this->repository->assetPath($this->module->getLowerName());
    }

    /**
     * Get source path.
     *
     * @return string
     */
    public function getSourcePath()
    {
        return $this->getModule()->getExtraPath(
            GenerateConfigReader::read('asset')->getPath()
        );
    }
}
