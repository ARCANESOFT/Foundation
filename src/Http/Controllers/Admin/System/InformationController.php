<?php namespace Arcanesoft\Foundation\Http\Controllers\Admin\System;

/**
 * Class     InformationController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers\Admin\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class InformationController extends Controller
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */
    /**
     * InformationController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setCurrentPage('foundation-system-information');
        $this->addBreadcrumbRoute('Information', 'admin::foundation.system.information.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    public function index()
    {
        $this->setTitle('System information');

        return $this->view('admin.system.information.index');
    }
}
