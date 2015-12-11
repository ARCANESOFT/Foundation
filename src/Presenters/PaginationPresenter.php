<?php namespace Arcanesoft\Foundation\Presenters;

use Illuminate\Pagination\BootstrapThreePresenter;

/**
 * Class     SmallBootstrapThreePresenter
 *
 * @package  Arcanesoft\Foundation\Presenters\Pagination
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PaginationPresenter extends BootstrapThreePresenter
{
    /**
     * Convert the URL window into Bootstrap HTML.
     *
     * @param  string  $class
     *
     * @return string
     */
    public function render($class = 'pagination-sm m0')
    {
        if ($this->hasPages()) {
            return sprintf(
                '<ul class="pagination '. $class .'">%s %s %s</ul>',
                $this->getPreviousButton(),
                $this->getLinks(),
                $this->getNextButton()
            );
        }

        return '';
    }
}
