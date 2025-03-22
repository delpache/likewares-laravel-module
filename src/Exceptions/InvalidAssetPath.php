<?php

namespace Likewares\Module\Exceptions;

class InvalidAssetPath extends \Exception
{
    public static function missingModuleName($asset)
    {
        return new static("Le nom du module n'a pas été spécifié dans l'asset [$asset].");
    }
}
