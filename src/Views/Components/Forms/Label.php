<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms;

use Illuminate\View\Component;

/**
 * Class     Label
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Label extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var string */
    public $for;

    /** @var string */
    public $label;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Label constructor.
     *
     * @param  string       $for
     * @param  string|null  $label
     */
    public function __construct(string $for, ?string $label = null)
    {
        $this->for   = $for;
        $this->label = __($label ?: $for);
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
        return view()->make('foundation::_components.forms.label');
    }
}
