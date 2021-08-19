<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Modals;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;

/**
 * Class     ActionModalComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ActionModalComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  string */
    public $type;

    /** @var  string */
    public $action;

    /** @var  string */
    public $method;

    /** @var  string */
    public $title;

    /** @var  string|null */
    public $id;

    /** @var  string|null */
    public $body;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * @param  string       $type
     * @param  string       $action
     * @param  string       $method
     * @param  string       $title
     * @param  string|null  $id
     * @param  string|null  $body
     */
    public function __construct(
        string $type,
        string $action,
        string $method,
        string $title,
        ?string $id = null,
        ?string $body = null
    ) {
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
     * {@inheritDoc}
     */
    public function render(): View
    {
        return $this->view('modals.action-modal');
    }
}
