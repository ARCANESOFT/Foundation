<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Controllers;

use Arcanedev\LaravelPolicies\Ability;
use Arcanedev\LaravelPolicies\Contracts\PolicyManager;
use Arcanesoft\Foundation\System\Http\Datatables\AbilitiesDatatable;
use Arcanesoft\Foundation\System\Policies\AbilitiesPolicy;
use Illuminate\Support\Facades\Gate;

/**
 * Class     AbilitiesController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AbilitiesController extends Controller
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\LaravelPolicies\Contracts\PolicyManager */
    private $manager;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct(PolicyManager $manager)
    {
        $this->manager = $manager;

        parent::__construct();

        $this->setCurrentSidebarItem('foundation::system.info');
        $this->addBreadcrumbRoute(__('Abilities'), 'admin::system.abilities.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index()
    {
        $this->authorize(AbilitiesPolicy::ability('index'));

        return $this->view('system.abilities.index');
    }

    public function datatable(AbilitiesDatatable $datatable)
    {
        $this->authorize(AbilitiesPolicy::ability('index'));

        return $datatable;
    }

    public function show(string $key)
    {
        /** @var  \Arcanedev\LaravelPolicies\Ability  $ability */
        $ability = $this->getAbilities()->get($key);

        abort_if(is_null($ability), 404);

        $this->authorize(AbilitiesPolicy::ability('show'), [$ability]);

        $this->addBreadcrumb($ability->key());

        return $this->view('system.abilities.show', compact('ability'));
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the abilities.
     *
     * @return \Arcanedev\LaravelPolicies\Ability[]|\Illuminate\Support\Collection
     */
    protected function getAbilities()
    {
        return $this->manager->abilities()->map(function (Ability $ability) {
            return $ability->setMeta('is_registered', Gate::has($ability->key()));
        });
    }
}
