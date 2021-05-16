<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms;

use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;

/**
 * Class     Error
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Error extends Component
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
     * Error constructor.
     *
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
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view()->make('foundation::_components.forms.error');
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
