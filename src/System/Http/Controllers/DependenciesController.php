<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Controllers;

/**
 * Class     DependenciesController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DependenciesController extends Controller
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Index page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return $this->view('system.dependencies.index');
    }

    /**
     * Show a package.
     *
     * @param  string  $name
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $name)
    {
        dd($name);
        $package = [];

        return $this->view('system.dependencies.show', compact('package'));
    }
}
