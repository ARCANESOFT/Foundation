<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Support\Badges;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;

/**
 * Class     CountComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CountComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  float|int */
    public $value;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * @param  int  $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
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
        return $this->view('support.badges.count');
    }
}
