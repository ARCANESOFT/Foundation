<?php namespace Arcanesoft\Foundation\Http\Controllers;

use Arcanedev\LogViewer\Contracts\LogViewerInterface;
use Arcanedev\LogViewer\Entities\Log;
use Arcanedev\LogViewer\Exceptions\LogNotFound;
use Arcanesoft\Foundation\Bases\FoundationController;
use Arcanesoft\Foundation\Presenters\PaginationPresenter;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class     LogViewerController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogViewerController extends FoundationController
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The LogViewer instance.
     *
     * @var \Arcanedev\LogViewer\Contracts\LogViewerInterface
     */
    protected $logViewer;

    /**
     * Logs per page.
     *
     * @var int
     */
    protected $perPage = 30;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * LogViewerController constructor.
     *
     * @param  \Arcanedev\LogViewer\Contracts\LogViewerInterface  $logViewer
     */
    public function __construct(LogViewerInterface $logViewer)
    {
        parent::__construct();

        $this->logViewer = $logViewer;

        $this->setCurrentPage('foundation-logviewer');
        $this->addBreadcrumbRoute('LogViewer', 'foundation::log-viewer.index');
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function index()
    {
        $stats    = $this->logViewer->statsTable();
        $percents = $this->calcPercentages($stats->footer(), $stats->header());

        $this->addBreadcrumb('Dashboard');

        return $this->view('log-viewer.dashboard', compact('percents'));
    }

    public function listLogs()
    {
        $stats   = $this->logViewer->statsTable();
        $headers = $stats->header();
        // $footer   = $stats->footer();

        $page    = request('page', 1);
        $offset  = ($page * $this->perPage) - $this->perPage;

        $rows    = new LengthAwarePaginator(
            array_slice($stats->rows(), $offset, $this->perPage, true),
            count($stats->rows()),
            $this->perPage,
            $page
        );
        $rows->setPath(request()->url());

        $this->addBreadcrumb('Logs List');

        return $this->view('log-viewer.list', compact('headers', 'rows', 'footer'));
    }

    /**
     * Show the log.
     *
     * @param  string  $date
     *
     * @return \Illuminate\View\View
     */
    public function show($date)
    {
        $log       = $this->getLogOrFail($date);
        $levels    = $this->logViewer->levelsNames();
        $entries   = $log->entries()->paginate($this->perPage);
        $presenter = new PaginationPresenter($entries);

        $this->addBreadcrumbRoute('Logs List', 'foundation::log-viewer.logs.list');
        $this->addBreadcrumb($date);

        return $this->view('log-viewer.show', compact('log', 'levels', 'entries', 'presenter'));
    }

    /**
     * Filter the log entries by level.
     *
     * @param  string  $date
     * @param  string  $level
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showByLevel($date, $level)
    {
        $log = $this->getLogOrFail($date);

        if ($level == 'all') {
            return redirect()->route('foundation::log-viewer.logs.show', [$date]);
        }

        $levels    = $this->logViewer->levelsNames();
        $entries   = $this->logViewer->entries($date, $level)->paginate($this->perPage);
        $presenter = new PaginationPresenter($entries);

        $this->addBreadcrumbRoute('Logs List', 'foundation::log-viewer.logs.list');
        $this->addBreadcrumbRoute($date, 'foundation::log-viewer.logs.show', [$date]);
        $this->addBreadcrumb(ucfirst($level));

        return $this->view('log-viewer.show', compact('log', 'levels', 'entries', 'presenter'));
    }

    /**
     * Download the log
     *
     * @param  string  $date
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($date)
    {
        return $this->logViewer->download($date);
    }

    /**
     * Delete a log.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        self::onlyAjax();

        $date    = $request->get('date');
        $deleted = $this->logViewer->delete($date);

        return response()->json([
            'result' => $deleted ? 'success' : 'error'
        ]);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get a log or fail
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
        catch(LogNotFound $e) {
            abort(404, $e->getMessage());
        }

        return $log;
    }

    /**
     * Calculate the percentage
     *
     * @param  array  $total
     * @param  array  $names
     *
     * @return array
     */
    private function calcPercentages(array $total, array $names)
    {
        $percents = [];
        $all      = array_get($total, 'all');

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
