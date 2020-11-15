<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Datatable;

use Closure;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Class     Column
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Column implements Arrayable
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const SORT_ASC  = 'asc';
    const SORT_DESC = 'desc';

    const DATATYPE_ACTIONS          = 'actions';
    const DATATYPE_AVATAR           = 'avatar';
    const DATATYPE_BADGE_ACTIVE     = 'badge-active';
    const DATATYPE_BADGE_COUNT      = 'badge-count';
    const DATATYPE_DESCRIPTION_LIST = 'description-list';
    const DATATYPE_PLAIN            = 'plain';
    const DATATYPE_STATUS           = 'status';
    const DATATYPE_TAGS             = 'tags';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Column's label.
     *
     * @var string
     */
    protected $key;

    /**
     * Column's label.
     *
     * @var string
     */
    protected $label;

    /**
     * Sort by state.
     *
     * @var bool
     */
    protected $sortable = false;

    /**
     * Sort query.
     *
     * @var \Closure|null
     */
    protected $sortQuery = null;

    /**
     * Sort by direction.
     *
     * @var string|null
     */
    protected $direction = null;

    /**
     * Column's alignment.
     *
     * @var string
     */
    protected $align = 'left';

    /**
     * Escape the column value.
     *
     * @var bool
     */
    protected $escaped = true;

    /**
     * Declare the column's datatype.
     *
     * @var string
     */
    protected $datatype = self::DATATYPE_PLAIN;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Column constructor.
     *
     * @param  string  $key
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * Get the sort query.
     *
     * @return \Closure|null
     */
    public function getSortQuery(): ?Closure
    {
        return $this->sortQuery;
    }

    /**
     * Set the sort query callback.
     *
     * @param  \Closure  $callback
     *
     * @return $this
     */
    public function sortQuery(Closure $callback): self
    {
        $this->sortQuery = $callback;

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make a new column instance.
     *
     * @param  string       $key
     * @param  string|null  $label
     * @param  string|null  $datatype
     *
     * @return $this
     */
    public static function make(string $key, ?string $label = null, ?string $datatype = null): self
    {
        return (new static($key))
            ->label($label ?: $key)
            ->datatype($datatype ?: static::DATATYPE_PLAIN);
    }

    /**
     * Get the key.
     *
     * @return string
     */
    public function key(): string
    {
        return $this->key;
    }

    /**
     * Set the label.
     *
     * @param  string  $label
     *
     * @return $this
     */
    public function label(string $label): self
    {
        $this->label = __($label);

        return $this;
    }

    /**
     * Set the align.
     *
     * @param  string  $align
     *
     * @return $this
     */
    public function align(string $align): self
    {
        // TODO: Convert this into a static constants ?
        $this->align = [
            'left'   => 'left',
            'center' => 'center',
            'right'  => 'right',
        ][$align];

        return $this;
    }

    /**
     * Set the escaped.
     *
     * @param  bool  $escaped
     *
     * @return $this
     */
    public function escaped($escaped = true): self
    {
        $this->escaped = $escaped;

        return $this;
    }

    /**
     * Get the sort by direction.
     *
     * @return string|null
     */
    public function getSortDirection(): ?string
    {
        return $this->direction;
    }

    /**
     * Set the sort direction.
     *
     * @param  string  $direction
     *
     * @return $this
     */
    public function sortDirection(string $direction)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * Make the column sortable.
     *
     * @param  string|null    $direction
     * @param  \Closure|null  $callback
     *
     * @return $this
     */
    public function sortable(?string $direction = null, Closure $callback = null): self
    {
        if ( ! $this->isSortable())
            $this->sortable = true;

        if ($direction)
            $this->sortDirection($direction);

        if ($callback)
            $this->sortQuery($callback);

        return $this;
    }

    /**
     * Set the column's datatype.
     *
     * @param  string  $datatype
     *
     * @return $this
     */
    public function datatype(string $datatype): self
    {
        $this->datatype = $datatype; // TODO: Add a datatype check

        return $this;
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
            'key'      => $this->key,
            'label'    => $this->label,
            'align'    => $this->align,
            'sortable' => $this->sortable,
            'escaped'  => $this->escaped,
            'datatype' => $this->datatype,
        ];
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Determine if the columns is sortable.
     *
     * @return bool
     */
    public function isSortable(): bool
    {
        return $this->sortable;
    }

    /**
     * Determine if the column has sort query.
     *
     * @return bool
     */
    public function hasSortQuery(): bool
    {
        return ! is_null($this->sortQuery);
    }

    /**
     * Determine if the columns has sort by direction.
     *
     * @return bool
     */
    public function hasSortByDirection(): bool
    {
        if (is_null($this->direction))
            return false;

        return in_array(strtolower($this->direction), [static::SORT_ASC, static::SORT_DESC]);
    }
}
