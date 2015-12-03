<?php namespace Arcanesoft\Foundation\Http\Controllers;

use Arcanesoft\Foundation\Bases\FoundationController;

/**
 * Class     LogViewerController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogViewerController extends FoundationController
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function index()
    {
        $this->setCurrentPage('foundation-logviewer');
        $title = 'LogViewer';
        $this->addBreadcrumb($title);

        return $this->view('log-viewer.index');
    }
}
