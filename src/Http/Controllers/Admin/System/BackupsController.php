<?php namespace Arcanesoft\Foundation\Http\Controllers\Admin\System;

use Arcanesoft\Foundation\Services\Backups;

/**
 * Class     BackupsController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers\Admin\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class BackupsController extends Controller
{
    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * BackupsController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setCurrentPage('foundation-system-backups');
        $this->addBreadcrumbRoute('Backups', 'admin::foundation.system.backups.index');
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function index()
    {
        $this->setTitle('Backups');
        $this->addBreadcrumb('List of all backup statuses');

        $statuses = Backups::statuses();

        return $this->view('admin.system.backups.index', compact('statuses'));
    }

    public function show($index)
    {
        $status = Backups::getStatus($index);

        if (is_null($status)) self::pageNotFound();

        $this->setTitle('Backups');
        $this->addBreadcrumb('List of all backups');

        $backups = $status->backupDestination()->backups();

        return $this->view('admin.system.backups.show', compact('status', 'backups'));
    }
}
