<?php namespace Arcanesoft\Foundation\Http\Controllers\Admin\System;

use Arcanedev\LaravelApiHelper\Traits\JsonResponses;
use Arcanesoft\Foundation\Services\Backups;

/**
 * Class     BackupsController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers\Admin\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class BackupsController extends Controller
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */
    use JsonResponses;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
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

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
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

        if (Backups::runBackups()) {
            $this->notifySuccess($message = 'The Backups was created successfully !', 'Backups created !');

            return $this->jsonResponseSuccess(compact('message'));
        }

        return $this->jsonResponseError('There is an error while running the backups.');
    }

    public function clear()
    {
        // TODO: Add authorization check

        if (Backups::clearBackups()) {
            $this->notifySuccess($message = 'The Backups was cleared successfully !', 'Backups cleared !');

            return $this->jsonResponseSuccess(compact('message'));
        }

        return $this->jsonResponseError('There is an error while running the backups.');
    }
}
