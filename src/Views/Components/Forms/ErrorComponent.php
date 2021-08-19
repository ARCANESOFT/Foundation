<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\ViewErrorBag;

/**
 * Class     ErrorComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ErrorComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var string */
    public $name;

    /** @var string */
    public $bag;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * @param  string  $name
     * @param  string  $bag
     */
    public function __construct(string $name, string $bag = 'default')
    {
        $this->name = $name;
        $this->bag = $bag;
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
        return $this->view('forms.error');
    }

    /**
     * Get the messages.
     *
     * @param  \Illuminate\Support\ViewErrorBag  $errors
     *
     * @return array
     */
    public function messages(ViewErrorBag $errors): array
    {
        $bag = $errors->getBag($this->bag);

        return $bag->has($this->name) ? $bag->get($this->name) : [];
    }
}
