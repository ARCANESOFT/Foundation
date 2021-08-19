<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Datatable\Filters;

use Arcanesoft\Foundation\Datatable\Filter;

/**
 * Class     Select
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Select extends Filter
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var array */
    protected $options = [];

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the filter's type.
     *
     * @return string
     */
    public function type(): string
    {
        return 'select';
    }

    /**
     * Set the select options.
     *
     * @param  array  $options
     *
     * @return $this
     */
    public function options(array $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get the select options.
     *
     * @return array
     */
    public function getOptions(): array
    {
        return array_map(function (string $option) {
            return __($option);
        }, $this->options);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type'    => $this->type(),
            'name'    => $this->getName(),
            'label'   => $this->getLabel(),
            'value'   => $this->getValue(),
            'options' => $this->getOptions(),
        ];
    }
}
