<?php namespace Arcanesoft\Foundation\Http\Controllers\Admin\System;

use Arcanedev\LaravelApiHelper\Traits\JsonResponses;
use Arcanedev\LogViewer\Contracts\LogViewer as LogViewerContract;
use Arcanedev\LogViewer\Entities\Log;
use Arcanedev\LogViewer\Entities\LogEntry;
use Arcanedev\LogViewer\Exceptions\LogNotFoundException;
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

        return $this->view('admin.system.log-viewer.list', compact('headers', 'rows', 'footer'));
    }

    /**
     * Show the log entries by date.
     *
     * @param  string  $date
     *
     * @return \Illuminate\View\View
     */
    public function show($date)
    {
        $this->authorize(LogViewerPolicy::PERMISSION_SHOW);

        $log     = $this->getLogOrFail($date);
        $levels  = $this->logViewer->levelsNames();
        $entries = $log->entries($level = 'all')->paginate($this->perPage);

        $this->addBreadcrumbRoute(trans('foundation::log-viewer.titles.logs-list'), 'admin::foundation.system.log-viewer.logs.list');
        $this->setTitle($title = "Log : {$date}");
        $this->addBreadcrumb($title);

        return $this->view('admin.system.log-viewer.show', compact('log', 'levels', 'level', 'search', 'entries'));
    }

    /**
     * Filter the log entries by date and level.
     *
     * @param  string  $date
     * @param  string  $level
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showByLevel($date, $level)
    {
        $this->authorize(LogViewerPolicy::PERMISSION_SHOW);

        $log = $this->getLogOrFail($date);

        if ($level == 'all')
            return redirect()->route('admin::foundation.system.log-viewer.logs.show', [$date]);

        $levels  = $this->logViewer->levelsNames();
        $entries = $this->logViewer->entries($date, $level)->paginate($this->perPage);

        $this->addBreadcrumbRoute(trans('foundation::log-viewer.titles.logs-list'), 'admin::foundation.system.log-viewer.logs.list');

        $this->setTitle($date.' | '.ucfirst($level));
        $this->addBreadcrumbRoute($date, 'admin::foundation.system.log-viewer.logs.show', [$date]);
        $this->addBreadcrumb(ucfirst($level));

        return $this->view('admin.system.log-viewer.show', compact('log', 'levels', 'entries'));
    }

    /**
     * Show the log with the search query.
     *
     * @param  string                    $date
     * @param  string                    $level
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\View\View
     */
    public function search($date, $level = 'all', Request $request)
    {
        $log = $this->getLogOrFail($date);

        if (is_null($query = $request->get('query')))
            return redirect()->route('admin::foundation.system.log-viewer.logs.show', [$date]);

        $levels  = $this->logViewer->levelsNames();
        $entries = $log->entries($level)->filter(function (LogEntry $value) use ($query) {
            return Str::contains($value->header, $query);
        })->paginate($this->perPage);

        return $this->view('admin.system.log-viewer.show', compact('log', 'levels', 'level', 'query', 'entries'));
    }

    /**
     * Download the log.
     *
     * @param  string  $date
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($date)
    {
        $this->authorize(LogViewerPolicy::PERMISSION_DOWNLOAD);

        return $this->logViewer->download($date);
    }

    /**
     * Delete a log.
     *
     * @param  string  $date
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($date)
    {
        $this->authorize(LogViewerPolicy::PERMISSION_DELETE);

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
     * Get a log or fail.
     *
     * @param  string  $date
     *
     * @return Log|null
     */
    private function getLogOrFail($date)
    {
        $log = null;

        try {
            $log = $this->logViewer->get($date);
        }
        catch(LogNotFoundException $e) {
            abort(404, $e->getMessage());
        }

        return $log;
    }

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
