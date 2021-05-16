<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Support\Badges;

use Illuminate\View\Component;

/**
 * Class     Count
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Count extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * @var float|int
     */
    public $value;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Count constructor.
     *
     * @param  int  $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
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
        return view()->make('foundation::_components.support.badges.count');
    }
}
