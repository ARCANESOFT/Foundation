<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Helpers\Sidebar;

/**
 * Class     Manager
 *
 * @package  Arcanesoft\Foundation\Helpers\Sidebar
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Manager
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Helpers\Sidebar\Collection */
    protected $items;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Manager constructor.
     */
    public function __construct()
    {
        $this->items = new Collection;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the sidebar items.
     *
     * @return \Arcanesoft\Foundation\Helpers\Sidebar\Collection
     */
    public function items(): Collection
    {
        return $this->items;
    }

    /**
     * Set the selected item.
     *
     * @param  string  $name
     *
     * @return $this
     */
    public function setSelectedItem($name): self
    {
        $this->items->setSelected($name);

        return $this;
    }

    /**
     * Load the sidebar items from config files.
     *
     * @param  array  $items
     *
     * @return \Arcanesoft\Foundation\Helpers\Sidebar\Manager
     */
    public function loadFromConfig(array $items): Manager
    {
        foreach ($items as $item) {
            if (is_array($item)) {
                $this->items->pushSidebarItem($item);
            }
            elseif (config()->has($item)) {
                $this->loadFromConfig(config()->get($item));
            }
        }

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the sidebar is visible.
     *
     * @return bool
     */
    public static function isVisible(): bool
    {
        return session()->get('foundation.sidebar.visible', 'true') === 'true';
    }
}
