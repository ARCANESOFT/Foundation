<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Http;

use Arcanedev\Breadcrumbs\HasBreadcrumbs;
use Arcanedev\LaravelMetrics\Contracts\Manager;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * Class     Controller
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Controller
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests,
        HasBreadcrumbs,
        Concerns\HasJsonResponses;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The view data.
     *
     * @var array
     */
    private $viewData = [];

    /**
     * The view namespace.
     *
     * @var string|null
     */
    protected $viewNamespace;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->initBreadcrumbsContainer();
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the current sidebar item.
     *
     * @param  string  $name
     *
     * @return $this
     */
    protected function setCurrentSidebarItem(string $name)
    {
        return $this->setData('currentSidebarItem', $name);
    }

    /**
     * Set the data for the view.
     *
     * @param  string  $name
     * @param  mixed   $data
     *
     * @return $this
     */
    protected function setData(string $name, $data)
    {
        $this->viewData[$name] = $data;

        return $this;
    }

    /**
     * Set the page title.
     *
     * @param  string  $title
     *
     * @return $this
     */
    protected function setTitle(string $title)
    {
        // TODO: Implement the method

        return $this;
    }

    /**
     * Set the metrics.
     *
     * @param  string|array  $metrics
     *
     * @return $this
     */
    protected function selectMetrics($metrics)
    {
        if (is_string($metrics))
            $metrics = config($metrics, []);

        app(Manager::class)->setSelected($metrics);

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Init the breadcrumbs container.
     */
    protected function initBreadcrumbsContainer()
    {
        $this->registerBreadcrumbs('foundation', [
            'title' => __('Dashboard'),
            'url'   => route('admin::index'),
            'data'  => [],
        ]);
    }

    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string  $name
     * @param  array   $data
     * @param  array   $mergeData
     *
     * @return \Illuminate\Contracts\View\View
     */
    protected function view(string $name, $data = [], $mergeData = []): ViewContract
    {
        if ( ! is_null($this->viewNamespace))
            $name = "{$this->viewNamespace}::{$name}";

        $this->preRenderingView();

        return tap(
            view()->make($name, $data, array_merge($this->viewData, $mergeData)),
            function ($view) {
                $this->postRenderingView($view);
            }
        );
    }

    /**
     * Pre-rendering the view.
     *
     * @return void
     */
    protected function preRenderingView(): void
    {
        $this->loadBreadcrumbs();
    }

    /**
     * Post rendering the view.
     *
     * @param \Illuminate\Contracts\View\View $view
     *
     * @return void
     */
    protected function postRenderingView(ViewContract $view): void
    {
        //
    }
}
