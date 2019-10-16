<?php namespace Arcanesoft\Foundation\Http\Controllers\Admin\System;

use Arcanedev\LaravelApiHelper\Traits\JsonResponses;
use Arcanedev\LogViewer\Contracts\LogViewer as LogViewerContract;
use Arcanedev\LogViewer\Entities\Log;
use Arcanedev\LogViewer\Entities\LogEntry;
use Arcanesoft\Foundation\Policies\LogViewerPolicy;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Class     LogViewerController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers\Admin\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogViewerController extends Controller
{
    /* -----------------------------------------------------------------
     |  Trait
     | -----------------------------------------------------------------
     */

    use JsonResponses;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The LogViewer instance.
     *
     * @var \Arcanedev\LogViewer\Contracts\LogViewer
     */
    protected $logViewer;

    /**
     * Logs per page.
     *
     * @var int
     */
    protected $perPage = 30;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * LogViewerController constructor.
     *
     * @param  \Arcanedev\LogViewer\Contracts\LogViewer  $logViewer
     */
    public function __construct(LogViewerContract $logViewer)
    {
        parent::__construct();

        $this->logViewer = $logViewer;
        $this->perPage   = config('arcanesoft.foundation.log-viewer.per-page', $this->perPage);
        $this->setCurrentPage('foundation-system-logviewer');
        $this->addBreadcrumbRoute('LogViewer', 'admin::foundation.system.log-viewer.index');
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */

    /**
     * Show the LogViewer Dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize(LogViewerPolicy::PERMISSION_DASHBOARD);

        $stats    = $this->logViewer->statsTable();
        $percents = $this->calcPercentages($stats->footer(), $stats->header());

        $this->setTitle('LogViewer Dashboard');
        $this->addBreadcrumb('Dashboard');

        return $this->view('admin.system.log-viewer.dashboard', compact('percents'));
    }

    /**
     * List all logs.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\View\View
     */
    public function listLogs(Request $request)
    {
        $this->authorize(LogViewerPolicy::PERMISSION_LIST);

        $stats   = $this->logViewer->statsTable();
        $headers = $stats->header();
        // $footer   = $stats->footer();

        $page    = $request->get('page', 1);
        $offset  = ($page * $this->perPage) - $this->perPage;
        $rows    = new LengthAwarePaginator(
            array_slice($stats->rows(), $offset, $this->perPage, true),
            count($stats->rows()),
            $this->perPage,
            $page
        );
        $rows->setPath($request->url());

        $this->setTitle($title = trans('foundation::log-viewer.titles.logs-list'));
        $this->addBreadcrumb($title);

        return $this->view('admin.system.log-viewer.list', compact('headers', 'rows'));
    }

    /**
     * Show the log entries by date.
     *
     * @param  \Arcanedev\LogViewer\Entities\Log  $log
     *
     * @return \Illuminate\View\View
     */
    public function show(Log $log)
    {
        $this->authorize(LogViewerPolicy::PERMISSION_SHOW);

        $levels  = $this->logViewer->levelsNames();
        $entries = $log->entries($level = 'all')->paginate($this->perPage);
        $query   = '';

        $this->addBreadcrumbRoute(trans('foundation::log-viewer.titles.logs-list'), 'admin::foundation.system.log-viewer.logs.list');
        $this->setTitle($title = "Log : {$log->date}");
        $this->addBreadcrumb($title);

        return $this->view('admin.system.log-viewer.show', compact('log', 'levels', 'level', 'query', 'entries'));
    }

    /**
     * Filter the log entries by date and level.
     *
     * @param  \Arcanedev\LogViewer\Entities\Log  $log
     * @param  string                             $level
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showByLevel(Log $log, $level)
    {
        $this->authorize(LogViewerPolicy::PERMISSION_SHOW);

        if ($level == 'all')
            return redirect()->route('admin::foundation.system.log-viewer.logs.show', [$log->date]);

        $levels  = $this->logViewer->levelsNames();
        $entries = $this->logViewer->entries($log->date, $level)->paginate($this->perPage);
        $query   = '';

        $this->addBreadcrumbRoute(trans('foundation::log-viewer.titles.logs-list'), 'admin::foundation.system.log-viewer.logs.list');

        $this->setTitle($log->date.' | '.ucfirst($level));
        $this->addBreadcrumbRoute($log->date, 'admin::foundation.system.log-viewer.logs.show', [$log->date]);
        $this->addBreadcrumb(ucfirst($level));

        return $this->view('admin.system.log-viewer.show', compact('log', 'levels', 'query', 'entries', 'level'));
    }

    /**
     * Show the log with the search query.
     *
     * @param  \Arcanedev\LogViewer\Entities\Log  $log
     * @param  string                             $level
     * @param  \Illuminate\Http\Request           $request
     *
     * @return \Illuminate\View\View
     */
    public function search(Log $log, $level = 'all', Request $request)
    {
        if (is_null($query = $request->get('query')))
            return redirect()->route('admin::foundation.system.log-viewer.logs.show', [$log->date]);

        $levels  = $this->logViewer->levelsNames();
        $entries = $log->entries($level)->filter(function (LogEntry $value) use ($query) {
            return Str::contains($value->header, $query);
        })->paginate($this->perPage);

        return $this->view('admin.system.log-viewer.show', compact('log', 'levels', 'level', 'query', 'entries'));
    }

    /**
     * Download the log.
     *
     * @param  \Arcanedev\LogViewer\Entities\Log  $log
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Log $log)
    {
        $this->authorize(LogViewerPolicy::PERMISSION_DOWNLOAD);

        return $this->logViewer->download($log->date);
    }

    /**
     * Delete a log.
     *
     * @param  \Arcanedev\LogViewer\Entities\Log  $log
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Log $log)
    {
        $this->authorize(LogViewerPolicy::PERMISSION_DELETE);

        $date = $log->date;

        if ($this->logViewer->delete($date)) {
            $this->notifySuccess(
                $message = trans('foundation::log-viewer.messages.deleted.message', compact('date')),
                trans('foundation::log-viewer.messages.deleted.title')
            );

            return $this->jsonResponseSuccess(compact('message'));
        }

        return $this->jsonResponseError([
            'message' => "An error occurred while deleting the log [$date]"
        ]);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Calculate the percentage.
     *
     * @param  array  $total
     * @param  array  $names
     *
     * @return array
     */
    private function calcPercentages(array $total, array $names)
    {
        $percents = [];
        $all      = Arr::get($total, 'all');

        foreach ($total as $level => $count) {
            $percents[$level] = [
                'name'    => $names[$level],
                'count'   => $count,
                'percent' => round(($count / $all) * 100, 2),
            ];
        }

        return $percents;
    }
}
