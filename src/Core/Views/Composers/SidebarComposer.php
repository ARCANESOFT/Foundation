<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Views\Composers;

use Arcanesoft\Foundation\Helpers\Sidebar\Manager;
use Illuminate\Contracts\View\View;

/**
 * Class     SidebarComposer
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SidebarComposer
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const VIEW = 'foundation::_template.sidebar';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * @var \Arcanesoft\Foundation\Helpers\Sidebar\Manager
     */
    private $manager;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\Contracts\View\View  $view
     */
    public function compose(View $view)
    {
        $items = config()->get('arcanesoft.foundation.sidebar.items', []);

        $sidebar = $this->manager
            ->loadFromConfig($items)
            ->setSelectedItem($view->currentSidebarItem ?? '');

        $view->with('sidebar', $sidebar);
    }

    /**
     * Get the composer views.
     *
     * @return array
     */
    public function views(): array
    {
        return [
            static::VIEW,
        ];
    }
}
