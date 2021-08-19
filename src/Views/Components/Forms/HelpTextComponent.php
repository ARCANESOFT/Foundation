<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;

/**
 * Class     HelpTextComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class HelpTextComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  string */
    public $id;

    /** @var  string|null */
    public $text;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * @param  string       $id
     * @param  string|null  $text
     */
    public function __construct(string $id, ?string $text = null)
    {
        $this->id   = $id;
        $this->text = $text;
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
        return $this->view('forms.help-text');
    }
}
