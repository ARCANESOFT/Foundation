<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Datatable;

use Arcanesoft\Foundation\Datatable\Contracts\Filter as FilterContract;
use Arcanesoft\Foundation\Datatable\Filters\Select;
use Closure;

/**
 * Class     Filter
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Filter implements FilterContract
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var \Closure|null
     */
    protected $query = null;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Filter constructor.
     *
     * @param  string  $name
     * @param  string  $label
     */
    public function __construct(string $name, string $label)
    {
        $this->name = $name;
        $this->label = $label;
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the label.
     *
     * @return string
     */
    public function getLabel(): string
    {
        return __($this->label);
    }

    /**
     * Set the filter default value.
     *
     * @param  mixed  $value
     *
     * @return $this
     */
    public function value($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the filter query.
     *
     * @param  \Closure  $callback
     *
     * @return $this
     */
    public function query(Closure $callback)
    {
        $this->query = $callback;

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make a select filter instance.
     *
     * @param  string  $name
     * @param  string  $label
     * @param  mixed   $value
     * @param  array   $options
     *
     * @return \Arcanesoft\Foundation\Datatable\Filters\Select
     */
    public static function select(string $name, string $label, $value = null, array $options = []): Select
    {
        return (new Select($name, $label))
            ->value($value)
            ->options($options);
    }

    /**
     * Apply the filter for the given resources (query builder or collection instance).
     *
     * @param  \Illuminate\Database\Eloquent\Builder|\Illuminate\Support\Collection  $resources
     * @param  mixed                                                                 $value
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Support\Collection
     */
    public function apply($resources, $value)
    {
        if ($this->getValue() === $value)
            return $resources;

        return ($this->query)($resources, $value);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * Get the collection of items as JSON.
     *
     * @param  int  $options
     *
     * @return string
     */
    public function toJson($options = 0): string
    {
        return json_encode($this->jsonSerialize(), $options);
    }
}
