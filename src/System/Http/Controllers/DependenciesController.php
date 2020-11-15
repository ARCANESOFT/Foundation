<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Controllers;

use Arcanesoft\Foundation\PackageManifest;
use Arcanesoft\Foundation\System\Http\Datatables\DependenciesDatatable;
use Arcanesoft\Foundation\System\Policies\DependenciesPolicy;

/**
 * Class     DependenciesController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DependenciesController extends Controller
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct()
    {
        parent::__construct();

        $this->setCurrentSidebarItem('foundation::system.info');
        $this->addBreadcrumbRoute(__('Dependencies'), 'admin::system.dependencies.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * List all the dependencies.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->authorize(DependenciesPolicy::ability('index'));

        return $this->view('system.dependencies.index');
    }

    /**
     * Get the datatable api response.
     *
     * @param  \Arcanesoft\Foundation\System\Http\Datatables\DependenciesDatatable  $datatable
     *
     * @return \Arcanesoft\Foundation\System\Http\Datatables\DependenciesDatatable
     */
    public function datatable(DependenciesDatatable $datatable)
    {
        $this->authorize(DependenciesPolicy::ability('index'));

        return $datatable;
    }

    /**
     * Show a package.
     *
     * @param  string  $vendorName
     * @param  string  $packageName
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $vendorName, string $packageName, PackageManifest $manifest)
    {
        $this->authorize(DependenciesPolicy::ability('show'));

        $name = "{$vendorName}/{$packageName}";

        $package = $manifest->installed()->first(function ($installed) use ($name) {
            return $installed['name'] === $name;
        });

        abort_if(is_null($package), 404);

        return $this->view('system.dependencies.show', compact('package'));
    }
}
