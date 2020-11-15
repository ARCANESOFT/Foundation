<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Datatables;

use Arcanedev\LaravelPolicies\Ability;
use Arcanedev\LaravelPolicies\Contracts\PolicyManager;
use Arcanesoft\Foundation\Datatable\{
    Action,
    Column,
    Datatable,
    Filter};
use Arcanesoft\Foundation\Datatable\Concerns\{HasActions, HasFilters, HasPagination};
use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Arcanesoft\Foundation\System\Http\Transformers\AbilityTransformer;
use Arcanesoft\Foundation\System\Policies\AbilitiesPolicy;
use Closure;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\{Collection, Str};

/**
 * Class     AbilitiesDatatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AbilitiesDatatable extends Datatable
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasActions;
    use HasFilters;
    use HasPagination;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the datatable request.
     *
     * @param  \Arcanedev\LaravelPolicies\Contracts\PolicyManager  $manager
     * @param  \Illuminate\Contracts\Auth\Access\Gate              $gate
     * @param  \Illuminate\Http\Request                            $request
     *
     * @return \Illuminate\Support\Collection
     */
    public function handle(PolicyManager $manager, Gate $gate, Request $request)
    {
        $abilities = $manager->abilities()
            ->map(function (Ability $ability) use ($gate) {
                return $ability->setMeta('is_registered', $gate->has($ability->key()));
            })
            ->values();

        $abilities = $this->handleSearchQuery($abilities, $request);

        return $abilities;
    }

    /**
     * Handle the search query.
     *
     * @param  \Illuminate\Support\Collection  $abilities
     * @param  \Illuminate\Http\Request        $request
     *
     * @return \Illuminate\Support\Collection
     */
    protected function handleSearchQuery(Collection $abilities, Request $request)
    {
        $search = $this->searchQuery($request);

        if (empty($search))
            return $abilities;

        return $abilities->filter(function (Ability $ability) use ($search) {
            $needles   = explode(' ', Str::lower($search));

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
    }
    /**
     * Define the datatable's columns.
     *
     * @return \Arcanesoft\Foundation\Datatable\Column[]
     */
    protected function columns(): array
    {
        return [
            Column::make('key', 'Ability')->sortable(Column::SORT_ASC, static::sortAbilityQuery(function (Ability $ability) {
                return $ability->key();
            })),
            Column::make('name', 'Name')->sortable(null, static::sortAbilityQuery(function (Ability $ability) {
                return $ability->meta('name', '');
            })),
            Column::make('description', 'Description')->sortable(null, static::sortAbilityQuery(function (Ability $ability) {
                return $ability->meta('description', '');
            })),
            Column::make('registered', 'Registered', Column::DATATYPE_STATUS)->align('center')->sortable(null, static::sortAbilityQuery(function (Ability $ability) {
                return $ability->meta('is_registered', false);
            })),
        ];
    }

    /**
     * Get the ability sort query.
     *
     * @param  \Closure  $callback
     *
     * @return \Closure
     */
    protected static function sortAbilityQuery(Closure $callback): Closure
    {
        return function (Collection $collection, Column $column) use ($callback): Collection {
            return $collection->sortBy(
                $callback, SORT_REGULAR, $column->getSortDirection() === Column::SORT_DESC
            )->values();
        };
    }

    /**
     * Define the datatable filters.
     *
     * @return \Arcanesoft\Foundation\Datatable\Contracts\Filter[]
     */
    protected function filters(): array
    {
        return [
            Filter::select('status', 'Status', 'all', [
                'all'            => 'All',
                'registered'     => 'Registered',
                'not-registered' => 'Not Registered',
            ])->query(function (Collection $abilities, string $value) {
                return $abilities->filter(function (Ability $ability) use ($value) {
                    return $ability->meta('is_registered', false) === ($value === 'registered');
                });
            }),
        ];
    }

    /**
     * Define the datatable actions.
     *
     * @param  \Illuminate\Http\Request                  $request
     * @param  \Arcanedev\LaravelPolicies\Ability|mixed  $ability
     *
     * @return array
     */
    protected function actions(Request $request, $ability): array
    {
        return [
            Action::link('show', 'Show', function () use ($ability) {
                return route('admin::system.abilities.show', [$ability->key()]);
            })->can(function () use ($ability) {
                return AbilitiesPolicy::can('show', [$ability]);
            })->asIcon()
        ];
    }

    /**
     * Get the transformer.
     *
     * @return \Arcanesoft\Foundation\Datatable\Contracts\Transformer
     */
    protected function transformer(): Transformer
    {
        return new AbilityTransformer;
    }
}
