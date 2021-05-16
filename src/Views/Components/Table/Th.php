<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Table;

use Illuminate\View\Component;

/**
 * Class     Th
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Th extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var string|null */
    public $label = null;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Th constructor.
     *
     * @param  string|null  $label
     */
    public function __construct(string $label = null)
    {
        if ( ! empty($label))
            $this->label = __($label);
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
        return view()->make('foundation::_components.table.table-th');
    }
}
