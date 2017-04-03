<?php namespace Arcanesoft\Foundation\Http\Controllers\Admin;

/**
 * Class     SettingsController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SettingsController extends Controller
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
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

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
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
