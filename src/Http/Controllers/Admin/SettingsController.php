<?php namespace Arcanesoft\Foundation\Http\Controllers\Admin;

use Arcanesoft\Core\Traits\Notifyable;

/**
 * Class     SettingsController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SettingsController extends Controller
{
    /* ------------------------------------------------------------------------------------------------
     |  Traits
     | ------------------------------------------------------------------------------------------------
     */
    use Notifyable;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * SettingsController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setCurrentPage('foundation-settings');
        $this->addBreadcrumbRoute('Settings', 'admin::foundation.settings.index');
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function index()
    {
        $title = 'Generals';
        $this->setTitle("Settings - {$title}");
        $this->addBreadcrumb($title);
        $this->setCurrentPage('foundation-settings-generals');

        return $this->view('admin.settings.index');
    }
}
