<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Helpers\Sidebar;

use Illuminate\Support\Collection as BaseCollection;

/**
 * Class     Collection
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Collection extends BaseCollection
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Push multiple sidebar items into the collection.
     *
     * @param  array  $items
     *
     * @return \Arcanesoft\Foundation\Helpers\Sidebar\Collection
     */
    public function pushSidebarItems(array $items): Collection
    {
        foreach ($items as $item) {
            $this->pushSidebarItem($item);
        }

        return $this;
    }

    /**
     * Push a new sidebar item to the collection.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Foundation\Helpers\Sidebar\Collection
     */
    public function pushSidebarItem(array $attributes): Collection
    {
        return $this->push(new Item($attributes));
    }

    /**
     * Set the selected item.
     *
     * @param  string  $name
     *
     * @return \Arcanesoft\Foundation\Helpers\Sidebar\Collection
     */
    public function setSelected($name): Collection
    {
        return $this->transform(function (Item $item) use ($name) {
            return $item->setSelected($name);
        });
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if has any selected item.
     *
     * @return bool
     */
    public function hasAnySelected(): bool
    {
        return $this->filter(function (Item $item) {
            return $item->isActive();
        })->isNotEmpty();
    }
}
