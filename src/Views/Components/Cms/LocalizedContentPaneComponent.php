<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Cms;


use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;

/**
 * Class     LocalizedContentPaneComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LocalizedContentPaneComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  string */
    public $locale;

    /** @var  bool */
    public $active;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * @param  string  $locale
     * @param  bool    $active
     */
    public function __construct(string $locale, bool $active = false)
    {
        $this->locale = $locale;
        $this->active = $active;
    }

    /* -----------------------------------------------------------------
     |  Main Properties
     | -----------------------------------------------------------------
     */

    /** {@inheritDoc} */
    public function render(): View
    {
        return $this->view('cms.localized-content-pane');
    }
}
