<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;

/**
 * Class     LabelComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LabelComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  string */
    public $for;

    /** @var  string */
    public $label;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
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
     * {@inheritDoc}
     */
    public function render(): View
    {
        return $this->view('forms.label');
    }
}
