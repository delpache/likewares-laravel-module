<?php

namespace Likewares\Module\Contracts;

use Likewares\Module\Module;

interface IActivatorInterface
{
    public function is(Module $module, bool $active): bool;

    public function enable(Module $module): void;

    public function disable(Module $module): void;

    public function setActive(Module $module, bool $active): void;

    public function delete(Module $module): void;

    public function reset(): void;
}
