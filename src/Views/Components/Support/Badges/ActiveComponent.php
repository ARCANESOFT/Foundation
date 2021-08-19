<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Support\Badges;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;

/**
 * Class     ActiveComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ActiveComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  bool */
    public $active;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct(bool $active)
    {
        $this->active = $active;
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
        return $this->view('support.badges.active');
    }
}
