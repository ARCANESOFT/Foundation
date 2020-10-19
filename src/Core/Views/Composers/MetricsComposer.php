<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Views\Composers;

use Arcanedev\LaravelMetrics\Contracts\Manager;
use Illuminate\Contracts\View\View;

/**
 * Class     MetricsComposer
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetricsComposer
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const VIEW = 'foundation::_partials.metrics';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * @var \Arcanedev\LaravelMetrics\Contracts\Manager
     */
    private $manager;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * MetricsComposer constructor.
     *
     * @param  \Arcanedev\LaravelMetrics\Contracts\Manager  $manager
     */
    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\Contracts\View\View  $view
     */
    public function compose(View $view): void
    {
        $metrics = $this->manager->makeSelected()->filter(function ($metric) {
            return $metric->authorizedToSee(request());
        });

        $view->with('foundationMetrics', $metrics);
    }

    /**
     * Get the composer views.
     *
     * @return array
     */
    public function views(): array
    {
        return [
            static::VIEW,
        ];
    }
}
