<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Helpers\Sidebar;

use Arcanesoft\Foundation\Authorization\Auth;
use Illuminate\Support\{Arr, HtmlString};

/**
 * Class     Item
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Item
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  string */
    protected $name;

    /** @var  string */
    public $title;

    /** @var  string */
    public $url;

    /** @var  string */
    public $icon;

    /** @var  \Arcanesoft\Foundation\Helpers\Sidebar\Collection */
    public $children;

    /** @var  array */
    protected $roles;

    /** @var  array */
    protected $permissions;

    /** @var bool */
    private $selected = false;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * SidebarItem constructor.
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes)
    {
        $this->name        = Arr::pull($attributes, 'name');
        $this->setTitle(Arr::pull($attributes, 'title'));
        $this->icon        = Arr::pull($attributes, 'icon');
        $this->roles       = Arr::pull($attributes, 'roles', []);
        $this->permissions = Arr::pull($attributes, 'permissions', []);
        $this->children    = Collection::make()->pushSidebarItems(Arr::pull($attributes, 'children', []));
        $this->selected    = false;

        $this->parseUrl($attributes);
    }

    /* -----------------------------------------------------------------
     |  Setters & Getters
     | -----------------------------------------------------------------
     */

    /**
     * Set the title.
     *
     * @param  string  $title
     *
     * @return \Arcanesoft\Foundation\Helpers\Sidebar\Item
     */
    public function setTitle(string $title): self
    {
        $this->title = __($title);

        return $this;
    }

    /**
     * Set the url.
     *
     * @param  string  $url
     *
     * @return \Arcanesoft\Foundation\Helpers\Sidebar\Item
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Set the selected sidebar item.
     *
     * @param  string  $name
     *
     * @return $this
     */
    public function setSelected(string $name): self
    {
        $this->selected = ($this->name === $name);
        $this->children->setSelected($name);

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Set the url from the route.
     *
     * @param  string  $name
     * @param  array   $params
     *
     * @return \Arcanesoft\Foundation\Helpers\Sidebar\Item
     */
    public function route($name, array $params = []): self
    {
        return $this->setUrl(route($name, $params));
    }

    /**
     * Set the url from the action.
     *
     * @param  string|array  $name
     * @param  array         $params
     *
     * @return \Arcanesoft\Foundation\Helpers\Sidebar\Item
     */
    public function action($name, array $params = []) : self
    {
        return $this->setUrl(action($name, $params));
    }

    /**
     * Set the icon classes.
     *
     * @param  string  $classes
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function icon($classes = '') : HtmlString
    {
        $html = $this->icon
            ? "<i class=\"{$this->icon} {$classes}\"></i>"
            : '';

        return new HtmlString($html);
    }

    /**
     * Get the active/inactive class.
     *
     * @param  string  $active
     * @param  string  $inactive
     *
     * @return string
     */
    public function active($active = 'active', $inactive = '')
    {
        return $this->isActive() ? $active : $inactive;
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if has children.
     *
     * @return bool
     */
    public function hasChildren() : bool
    {
        return $this->children->isNotEmpty();
    }

    /**
     * Check if the item is active.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isSelected() || $this->children->hasAnySelected();
    }

    /**
     * Check if the item is selected.
     *
     * @return bool
     */
    public function isSelected(): bool
    {
        return $this->selected;
    }

    /**
     * Check if can see the item.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed|null  $administrator
     *
     * @return bool
     */
    public function canSee($administrator = null): bool
    {
        $administrator = $administrator ?? Auth::admin();

        return $administrator->isSuperAdmin()
            || $this->checkHasRole($administrator)
            || $this->checkHasPermission($administrator)
            || $this->checkCanSeeChildren($administrator);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Parse the url attribute.
     *
     * @param  array  $attributes
     */
    protected function parseUrl(array $attributes) : void
    {
        if (isset($attributes['url']))
            $this->setUrl($attributes['url']);
        elseif (isset($attributes['route']))
            $this->route(...Arr::wrap($attributes['route']));
        elseif (isset($attributes['action']))
            $this->action(...Arr::wrap($attributes['action']));
        else
            $this->setUrl('#');
    }

    /**
     * Check if the authenticated admin has the allowed role.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator  $administrator
     *
     * @return bool
     */
    protected function checkHasRole($administrator): bool
    {
        return $administrator->isOne($this->roles);
    }

    /**
     * Check if the authenticated admin has the allowed permission.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator  $admin
     *
     * @return bool
     */
    protected function checkHasPermission($admin): bool
    {
        foreach ($this->permissions as $permission) {
            if ($admin->can($permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if the authenticated admin can access the item's children.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator  $administrator
     *
     * @return bool
     */
    protected function checkCanSeeChildren($administrator): bool
    {
        return $this->children->filter(function (Item $child) use ($administrator) {
            return $child->canSee($administrator);
        })->isNotEmpty();
    }
}
