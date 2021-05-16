<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Support\Badges;

use Illuminate\View\Component;

/**
 * Class     Active
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Active extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * @var float|int
     */
    public $value;

    /**
     * @var bool
     */
    public $icon;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Count constructor.
     *
     * @param  bool|int  $value
     * @param  bool      $icon
     */
    public function __construct($value, bool $icon = false)
    {
        $this->value = $value;
        $this->icon  = $icon;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view()->make('foundation::_components.support.badges.active');
    }
}
