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
     * @param  string|null  $help
     * @param  bool         $grouped
     */
    public function __construct(
        string $type = 'password',
        string $name,
        string $id = null,
        string $value = '',
        string $label = null,
        string $help = null,
        bool $grouped = false
    ) {
        parent::__construct($type, $name, $id, $value, $label, $help);

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
