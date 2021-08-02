<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms\Buttons;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;

/**
 * Class     CancelComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CancelComponent extends Component
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
     * {@inheritDoc}
     */
    public function render(): View
    {
        return $this->view('forms.buttons.cancel');
    }
}
