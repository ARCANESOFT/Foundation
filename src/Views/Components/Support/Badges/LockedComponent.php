<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Support\Badges;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;

/**
 * Class     LockedComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LockedComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  bool */
    public $locked;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct(bool $locked)
    {
        $this->locked = $locked;
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
        return $this->view('support.badges.locked');
    }
}
