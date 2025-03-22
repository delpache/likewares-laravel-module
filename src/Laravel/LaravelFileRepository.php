<?php

namespace Likewares\Module\Laravel;

use Likewares\Module\FileRepository;
use Likewares\Module\Laravel\Module;

class LaravelFileRepository extends FileRepository
{
    /**
     * {@inheritdoc}
     */
    protected function createModule(...$args)
    {
        return new Module(...$args);
    }
}
