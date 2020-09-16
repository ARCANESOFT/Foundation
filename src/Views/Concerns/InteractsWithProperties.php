<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Concerns;

use Illuminate\Support\{Collection, Str};
use ReflectionClass;
use ReflectionProperty;

/**
 * Trait     InteractsWithProperties
 *
 * @package  Arcanesoft\Foundation\Views\Concerns
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait InteractsWithProperties
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The cache of public property names, keyed by class.
     *
     * @var array
     */
    protected static $propertyCache = [];

    /**
     * The properties that should not be exposed to the component.
     *
     * @var array
     */
    protected $except = [];

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the data that should be supplied to the view.
     *
     * @author Freek Van der Herten
     * @author Brent Roose
     *
     * @return array
     */
    public function data(): array
    {
        $class = get_class($this);

        if ( ! isset(static::$propertyCache[$class])) {
            $reflection = new ReflectionClass($this);

            static::$propertyCache[$class] = Collection::make($reflection->getProperties(ReflectionProperty::IS_PUBLIC))
                ->reject(function (ReflectionProperty $property) {
                    return $this->shouldIgnore($property->getName());
                })
                ->map(function (ReflectionProperty $property) {
                    return $property->getName();
                })
                ->all();
        }

        $values = [];

        foreach (static::$propertyCache[$class] as $property) {
            $values[$property] = $this->{$property};
        }

        return $values;
    }

    /**
     * Hydrate the component with the given data.
     *
     * @param  array  $data
     *
     * @return $this
     */
    public function hydrate(array $data)
    {
        foreach (array_keys($this->data()) as $property) {
            if (isset($data[$property])) {
                $this->{$property} = $data[$property];
            }
        }

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Determine if the given property should be ignored.
     *
     * @param  string  $name
     *
     * @return bool
     */
    protected function shouldIgnore(string $name): bool
    {
        return Str::startsWith($name, '__');
    }
}
