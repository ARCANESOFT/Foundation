<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms\Controls;

use Illuminate\Contracts\View\View;

/**
 * Class     PasswordComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PasswordComponent extends Component
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
     * @param  string       $value
     * @param  string|null  $label
     * @param  bool         $grouped
     */
    public function __construct(
        string $name,
        string $id = null,
        string $type = 'text',
        string $value = '',
        string $label = null,
        bool $grouped = false
    ) {
        parent::__construct($name, $id, $type, $value, $label);

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
        return $this->view('forms.controls.password');
    }
}
