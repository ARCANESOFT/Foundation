<?php namespace Arcanesoft\Foundation\Http\Controllers\Admin\System;

use Arcanedev\LaravelApiHelper\Traits\JsonResponses;
use Arcanesoft\Foundation\Policies\BackupPolicy;
use Arcanesoft\Foundation\Services\Backups;
use Illuminate\Support\Facades\Log;

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
        $this->addBreadcrumbRoute(trans('foundation::backups.titles.backups'), 'admin::foundation.system.backups.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index()
    {
        $this->authorize(BackupPolicy::PERMISSION_LIST);

        $statuses = Backups::statuses();

        $this->setTitle($title = trans('foundation::backups.titles.monitor-statuses-list'));
        $this->addBreadcrumb($title);

        return $this->view('admin.system.backups.index', compact('statuses'));
    }

    public function show($index)
    {
        $this->authorize(BackupPolicy::PERMISSION_SHOW);

        if (is_null($status = Backups::getStatus($index)))
            self::pageNotFound();

        $backups = $status->backupDestination()->backups();

        $this->setTitle($title = trans('foundation::backups.titles.monitor-status'));
        $this->addBreadcrumb($title);

        return $this->view('admin.system.backups.show', compact('status', 'backups'));
    }

    public function backup()
    {
        $this->authorize(BackupPolicy::PERMISSION_CREATE);

        if (Backups::runBackups()) {
            return $this->jsonResponseSuccess([
                'message' => $this->transNotification('created'),
            ]);
        }

        return $this->jsonResponseError(['message' => 'There is an error while running the backups.']);
    }

    public function clear()
    {
        $this->authorize(BackupPolicy::PERMISSION_DELETE);

        if (Backups::clearBackups()) {
            return $this->jsonResponseSuccess([
                'message' => $this->transNotification('cleared'),
            ]);
        }

        return $this->jsonResponseError(['message' => 'There is an error while running the backups.']);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Notify with translation.
     *
     * @param  string  $action
     * @param  array   $replace
     * @param  array   $context
     *
     * @return string
     */
    protected function transNotification($action, array $replace = [], array $context = [])
    {
        $title   = trans("foundation::backups.messages.{$action}.title");
        $message = trans("foundation::backups.messages.{$action}.message", $replace);

        Log::info($message, $context);
        $this->notifySuccess($message, $title);

        return $message;
    }
}
