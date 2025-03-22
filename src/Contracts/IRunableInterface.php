<?php

namespace Likewares\Module\Contracts;

interface IRunableInterface
{
    /**
     * Run the specified command.
     *
     * @param string $command
     */
    public function run($command);
}
