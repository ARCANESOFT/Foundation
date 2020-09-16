<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Controllers;

use Arcanedev\LogViewer\Contracts\LogViewer;
use Arcanedev\LogViewer\Entities\{LogEntry, LogEntryCollection};
use Arcanedev\LogViewer\Exceptions\LogNotFoundException;
use Arcanesoft\Foundation\Support\Traits\HasNotifications;
use Arcanesoft\Foundation\System\Metrics\LogViewer\LogEntriesCountByLevel;
use Arcanesoft\Foundation\System\Metrics\LogViewer\LogFilesCount;
use Arcanesoft\Foundation\System\Policies\LogViewerPolicy;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\{Collection, Str};

/**
 * Class     LogViewerController
 *
 * @package  Arcanesoft\Foundation\System\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogViewerController extends Controller
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasNotifications;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\LogViewer\Contracts\LogViewer */
    protected $logViewer;

    /** @var int */
    protected $perPage = 30;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct(LogViewer $logViewer)
    {
        $this->logViewer = $logViewer;

        parent::__construct();

        $this->addBreadcrumbRoute(__('LogViewer'), 'admin::system.log-viewer.index');
        $this->setCurrentSidebarItem('foundation::system.log-viewer');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index(Request $request)
    {
        $this->authorize(LogViewerPolicy::ability('index'));

        $this->selectMetrics([
            LogFilesCount::class,
            LogEntriesCountByLevel::class,
        ]);

        $stats   = $this->logViewer->statsTable();
        $headers = $stats->header();
        $rows    = $this->paginate($stats->rows(), $request);

        return $this->view('system.log-viewer.index', compact('headers', 'rows'));
    }

    public function showLog(Request $request, string $date)
    {
        return $this->filter($request, $date, 'all');
    }

    public function search(Request $request, string $date, string $level)
    {
        return $this->filter($request, $date, $level);
    }

    public function filter(Request $request, string $date, string $level)
    {
        $this->authorize(LogViewerPolicy::ability('show'));

        $this->addBreadcrumbRoute($date, 'admin::system.log-viewer.logs.show', [$date]);

        $log     = $this->getLogOrFail($date);
        $levels  = $this->logViewer->levelsNames();
        $entries = $log->entries($level)
            ->unless(is_null($query = $request->get('query')), function (LogEntryCollection $entries) use ($query) {
                return $entries->filter(function (LogEntry $value) use ($query) {
                    return Str::contains($value->header, $query);
                });
            })
            ->paginate($this->perPage);

        return $this->view('system.log-viewer.show', compact('level', 'log', 'query', 'levels', 'entries'));
    }

    public function download(string $date)
    {
        $this->authorize(LogViewerPolicy::ability('download'));

        return $this->logViewer->download($date);
    }

    public function delete(string $date)
    {
        $this->authorize(LogViewerPolicy::ability('delete'));

        if ( ! $this->logViewer->delete($date))
            return $this->jsonResponseError();

        $this->notifySuccess(__('Log Deleted'), __('The log file has been successfully deleted!'));

        return $this->jsonResponseSuccess();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Paginate logs.
     *
     * @param  array                     $data
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    protected function paginate(array $data, Request $request)
    {
        $data = new Collection($data);
        $page = $request->get('page', 1);
        $path = $request->url();

        return new LengthAwarePaginator(
            $data->forPage($page, $this->perPage),
            $data->count(),
            $this->perPage,
            $page,
            compact('path')
        );
    }

    /**
     * Get a log or fail
     *
     * @param  string  $date
     *
     * @return \Arcanedev\LogViewer\Entities\Log|null
     */
    protected function getLogOrFail($date)
    {
        try {
            return $this->logViewer->get($date);
        }
        catch (LogNotFoundException $e) {
            abort(404, $e->getMessage());
        }

        return null;
    }
}
