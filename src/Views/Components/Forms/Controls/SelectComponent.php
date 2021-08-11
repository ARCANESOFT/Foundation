<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms\Controls;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;

/**
 * Class     SelectComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SelectComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  iterable */
    public $options;

    /** @var  string */
    public $name;

    /** @var  string|null */
    public $id;

    /** @var  mixed|null */
    public $value;

    /** @var  string|null */
    public $label;

    /** @var  string|null */
    public $help;

    /** @var  bool */
    public $grouped;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * @param  iterable     $options
     * @param  string       $name
     * @param  string|null  $id
     * @param  mixed|null   $value
     * @param  string|null  $label
     * @param  bool         $grouped
     */
    public function __construct(
        iterable $options,
        string $name,
        string $id = null,
        $value = null,
        ?string $label = null,
        ?string $help = null,
        bool $grouped = false
    ){
        $this->options = $options;
        $this->name    = $name;
        $this->id      = $id ?: $name;
        $this->value   = $value;
        $this->label   = $label;
        $this->help    = $help;
        $this->grouped = $grouped;
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
        return $this->view('forms.controls.select');
    }
}
