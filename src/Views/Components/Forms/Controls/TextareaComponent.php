<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms\Controls;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;

/**
 * Class     TextareaComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TextareaComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  string */
    public $name;

    /** @var  string|null */
    public $id;

    /** @var  string|null */
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
     * @param  string       $name
     * @param  string|null  $id
     * @param  string|null  $value
     * @param  string|null  $label
     * @param  string|null  $help
     * @param  bool         $grouped
     */
    public function __construct(
        string $name,
        ?string $id = null,
        ?string $value = '',
        ?string $label = null,
        ?string $help = null,
        bool $grouped = false
    ) {
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
        return $this->view('forms.controls.textarea');
    }
}
