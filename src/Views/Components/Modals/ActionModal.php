<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Modals;

use Illuminate\View\Component;

/**
 * Class     ActionModal
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ActionModal extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $action;

    /**
     * @var string
     */
    public $method;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string|null
     */
    public $id;

    /**
     * @var string|null
     */
    public $body;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * ActionModal constructor.
     *
     * @param  string       $type
     * @param  string       $action
     * @param  string       $method
     * @param  string       $title
     * @param  string|null  $id
     * @param  string|null  $body
     */
    public function __construct(string $type, string $action, string $method, string $title, ?string $id = null, ?string $body = null)
    {
        $this->type   = $type;
        $this->action = $action;
        $this->method = $method;
        $this->title  = __($title);
        $this->id     = $id ?: $type;
        $this->body   = $body ? __($body) : null;
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
        return view()->make('foundation::_components.modals.action-modal');
    }
}
