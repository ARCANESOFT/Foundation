<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms\Buttons;

use Illuminate\View\Component;

/**
 * Class     Cancel
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Cancel extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * @var string
     */
    public $to;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Cancel constructor.
     *
     * @param  string  $to
     */
    public function __construct(string $to)
    {
        $this->to = $to;
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
        return view()->make('foundation::_components.forms.buttons.cancel');
    }
}
