<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Views\Components;

use Arcanedev\LaravelPolicies\Ability;
use Arcanedev\LaravelPolicies\Contracts\PolicyManager;
use Arcanesoft\Foundation\System\Policies\AbilitiesPolicy;
use Arcanesoft\Foundation\Views\Concerns\WithSortField;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\{Collection, Str};

/**
 * Class     AbilitiesDatatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AbilitiesDatatable extends Datatable
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const NAME = 'foundation::system.abilities.index';

    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use WithSortField;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    public $sortField = 'key';

    public $search = '';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check the authorization.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $guard
     *
     * @return bool
     */
    public function authorize(Gate $guard): bool
    {
        return $guard->allows(AbilitiesPolicy::ability('index'));
    }

    /**
     * Render the component.
     *
     * @param  \Arcanedev\LaravelPolicies\Contracts\PolicyManager  $manager
     * @param  \Illuminate\Contracts\Auth\Access\Gate              $gate
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render(PolicyManager $manager, Gate $gate)
    {
        return view('foundation::system.abilities._datatables.index', [
            'abilities' => $this->getResults($manager, $gate),
            'fields'    => $this->getFields(),
        ]);
    }

    /**
     * Get the results.
     *
     * @param  \Arcanedev\LaravelPolicies\Contracts\PolicyManager  $manager
     * @param  \Illuminate\Contracts\Auth\Access\Gate              $gate
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function getResults(PolicyManager $manager, Gate $gate): LengthAwarePaginator
    {
        $abilities = $manager->abilities()
            ->map(function (Ability $ability) use ($gate) {
                return $ability->setMeta('is_registered', $gate->has($ability->key()));
            })
            ->unless(empty($this->search), function (Collection $items) {
                return $items->filter(function (Ability $ability) {
                    $needles   = explode(' ', Str::lower($this->search));
                    $haystacks = [
                        $ability->key(),
                        $ability->meta('name'),
                        $ability->meta('description'),
                    ];

                    foreach ($haystacks as $haystack) {
                        if (Str::contains(Str::lower($haystack), $needles))
                            return true;
                    }

                    return false;
                });
            })
            ->sortBy(function (Ability $ability) {
                if ($this->sortField === 'name')
                    return $ability->meta('name', '');

                // $this->sortField === key or else, do the same sorting
                return $ability->key();
            }, SORT_REGULAR, ! $this->sortAsc);

        return $this->convertToPagination($abilities);
    }

    /**
     * Get the fields.
     *
     * @return array
     */
    private function getFields(): array
    {
        return [
            'key'         => $this->renderSortField('key', __('Ability')),
            'name'        => $this->renderSortField('name', __('Name')),
            'description' => __('Description'),
            'registered'  => __('Registered'),
            'actions'     => __('Actions'),
        ];
    }
}
