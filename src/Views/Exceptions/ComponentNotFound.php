<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Exceptions;

use Exception;

/**
 * Class     ComponentNotFound
 *
 * @package  Arcanesoft\Foundation\Views\Exceptions
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ComponentNotFound extends Exception
{
    /**
     * Make the exception.
     *
     * @param  string  $name
     *
     * @return static
     */
    public static function make(string $name): self
    {
        return new static("Component not found: [{$name}]");
    }
}
