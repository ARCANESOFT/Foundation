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

    /** @var  float|int */
    public $value;

    /** @var  bool */
    public $icon;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * @param  bool|int  $value
     * @param  bool      $icon
     */
    public function __construct($value, bool $icon = false)
    {
        $this->value = $value;
        $this->icon  = $icon;
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
