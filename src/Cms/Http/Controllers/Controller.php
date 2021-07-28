<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Http\Controllers;

use Arcanesoft\Foundation\Support\Http\Controller as BaseController;

/**
 * Class     Controller
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Controller extends BaseController
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The view namespace.
     *
     * @var string|null
     */
    protected $viewNamespace = 'foundation';

    /* -----------------------------------------------------------------
     |  Common Methods
     | -----------------------------------------------------------------
     */

    /**
     * Add the parent breadcrumb.
     */
    protected function addBreadcrumbParent(): void
    {
        $this->addBreadcrumbRoute(__('CMS'), 'admin::cms.index');
    }
}
