<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms\Controls;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;

/**
 * Class     VueComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class VueComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  string */
    public $use;

    /** @var  string */
    public $name;

    /** @var  string|null */
    public $id;

    /** @var  string|null */
    public $label;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * @param  string       $use
     * @param  string       $name
     * @param  string|null  $id
     * @param  string|null  $label
     */
    public function __construct(string $use, string $name, ?string $id = null, ?string $label= null)
    {
        $this->use   = $use;
        $this->name  = $name;
        $this->id    = $id ?: $name;
        $this->label = $label;
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
        return $this->view('forms.controls.vue');
    }
}
