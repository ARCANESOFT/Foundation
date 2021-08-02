<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Cms;

use Arcanesoft\Foundation\Cms\Repositories\LanguagesRepository;
use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;

/**
 * Class     LocalizedContentComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LocalizedContentComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Illuminate\Database\Eloquent\Collection */
    public $languages;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * @param  \Arcanesoft\Foundation\Cms\Repositories\LanguagesRepository  $repo
     */
    public function __construct(LanguagesRepository $repo)
    {
        $this->languages = $repo->all();
    }

    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the locales.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getLocales()
    {
        return $this->languages->pluck('code');
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
        return $this->view('cms.localized-content');
    }
}
