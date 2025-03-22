<?php

namespace Likewares\Module\Lumen;

use Likewares\Module\FileRepository;
use Likewares\Module\Lumen\Module;

class LumenFileRepository extends FileRepository
{
    /**
     * {@inheritdoc}
     */
    protected function createModule(...$args)
    {
        return new Module(...$args);
    }
}
