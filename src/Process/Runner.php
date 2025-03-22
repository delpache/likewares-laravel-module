<?php

namespace Likewares\Module\Process;

use Likewares\Module\Contracts\IRepositoryInterface;
use Likewares\Module\Contracts\IRunableInterface;

class Runner implements IRunableInterface
{
    /**
     * The module instance.
     * @var IRepositoryInterface
     */
    protected $module;

    public function __construct(IRepositoryInterface $module)
    {
        $this->module = $module;
    }

    /**
     * Run the given command.
     *
     * @param string $command
     */
    public function run($command)
    {
        passthru($command);
    }
}
