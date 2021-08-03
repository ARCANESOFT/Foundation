<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms\Controls;

use Illuminate\Contracts\View\View;

/**
 * Class     InputComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class InputComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  bool */
    public $grouped;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * @param  string       $name
     * @param  string|null  $id
     * @param  string       $type
     * @param  string|null  $value
     * @param  string|null  $label
     * @param  bool         $grouped
     */
    public function __construct(
        string $type = 'text',
        string $name,
        string $id = null,
        ?string $value = '',
        ?string $label = null,
        bool $grouped = false
    ) {
        parent::__construct($type, $name, $id, $value, $label);

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
        return $this->view('forms.controls.input');
    }
}
