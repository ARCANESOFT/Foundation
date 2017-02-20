<?php namespace Arcanesoft\Foundation\Http\Controllers\Admin\System;

use Arcanesoft\Core\Traits\Notifyable;
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
     |  Traits
     | ------------------------------------------------------------------------------------------------
     */
    use Notifyable;

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
        // TODO: Add authorization check
        $this->setTitle('Backups');
        $this->addBreadcrumb('List of all backup statuses');

        $statuses = Backups::statuses();

        return $this->view('admin.system.backups.index', compact('statuses'));
    }

    public function show($index)
    {
        // TODO: Add authorization check
        $status = Backups::getStatus($index);

        if (is_null($status)) self::pageNotFound();

        $this->setTitle('Backups');
        $this->addBreadcrumb('List of all backups');

        $backups = $status->backupDestination()->backups();

        return $this->view('admin.system.backups.show', compact('status', 'backups'));
    }

    public function backup()
    {
        // TODO: Add authorization check
        self::onlyAjax();

        if (Backups::runBackups()) {
            $ajax = ['status' => 'success'];

            $this->notifySuccess('', 'Backups created !');
        }
        else {
            $ajax = [
                'status'  => 'error',
                'message' => 'There is an error while running the backups.'
            ];
        }

        return response()->json($ajax);
    }

    public function clear()
    {
        // TODO: Add authorization check
        self::onlyAjax();

        if (Backups::clearBackups()) {
            $ajax = ['status' => 'success'];

            $this->notifySuccess('The Backups was cleared successfully !', 'Backups cleared !');
        }
        else {
            $ajax = [
                'status'  => 'error',
                'message' => 'There is an error while clearing the backups.'
            ];
        }

        return response()->json($ajax);
    }
}