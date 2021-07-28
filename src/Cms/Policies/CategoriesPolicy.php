<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Policies;

use Arcanesoft\Foundation\Authorization\Models\Administrator;
use Arcanesoft\Foundation\Cms\Models\Category;

/**
 * Class     CategoriesPolicy
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CategoriesPolicy extends AbstractPolicy
{
    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the ability's prefix.
     *
     * @return string
     */
    protected static function prefix(): string
    {
        return 'admin::cms.categories.';
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the policy's abilities.
     *
     * @return \Arcanedev\LaravelPolicies\Ability[]|iterable
     */
    public function abilities(): iterable
    {
        $this->setMetas([
            'category' => 'Categories',
        ]);

        return [

            // admin::cms.categories.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the categories',
                'description' => 'Ability to list all the categories'
            ]),

            // admin::cms.categories.metrics
            $this->makeAbility('metrics')->setMetas([
                'name'        => 'Show the metrics',
                'description' => 'Ability to show the category\'s metrics',
            ]),

            // admin::cms.categories.show
            $this->makeAbility('show')->setMetas([
                'name'        => 'Show a category',
                'description' => 'Ability to show the category\'s details',
            ]),

            // admin::cms.categories.create
            $this->makeAbility('create')->setMetas([
                'name'        => 'Create a new category',
                'description' => 'Ability to create a new category',
            ]),

            // admin::cms.categories.update
            $this->makeAbility('update')->setMetas([
                'name'        => 'Update a category',
                'description' => 'Ability to update a category',
            ]),

            // admin::cms.categories.activate
            $this->makeAbility('activate')->setMetas([
                'name'        => 'Activate a category',
                'description' => 'Ability to activate a category',
            ]),

            // admin::cms.categories.deactivate
            $this->makeAbility('deactivate')->setMetas([
                'name'        => 'Deactivate a category',
                'description' => 'Ability to deactivate a category',
            ]),

            // admin::cms.categories.delete
            $this->makeAbility('delete')->setMetas([
                'name'        => 'Delete a category',
                'description' => 'Ability to delete a category',
            ]),

            // admin::cms.categories.force-delete
            $this->makeAbility('force-delete')->setMetas([
                'name'        => 'Force Delete a category',
                'description' => 'Ability to force delete a category',
            ]),

            // admin::cms.categories.restore
            $this->makeAbility('restore')->setMetas([
                'name'        => 'Restore a category',
                'description' => 'Ability to restore a category',
            ]),

        ];
    }

    /* -----------------------------------------------------------------
     |  Abilities
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the categories.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function index(Administrator $administrator)
    {
        //
    }

    /**
     * Allow to show the category's metrics.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function metrics(Administrator $administrator)
    {
        //
    }

    /**
     * Allow to show a category details.
     *
     * @param \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param \Arcanesoft\Foundation\Cms\Models\Category|null                  $category
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function show(Administrator $administrator, Category $category = null)
    {
        //
    }

    /**
     * Allow to create a category.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function create(Administrator $administrator)
    {
        //
    }

    /**
     * Allow to update a category.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Cms\Models\Category|null                  $category
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function update(Administrator $administrator, Category $category = null)
    {
        //
    }

    /**
     * Allow to delete a category.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Cms\Models\Category|null                  $category
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function delete(Administrator $administrator, Category $category = null)
    {
        if ( ! is_null($category))
            return $category->isDeletable();
    }

    /**
     * Allow to force delete a category.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Cms\Models\Category|null                  $category
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function forceDelete(Administrator $administrator, Category $category = null)
    {
        if ( ! is_null($category))
            return $category->isDeletable();
    }

    /**
     * Allow to restore a category.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Cms\Models\Category|null                  $category
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function restore(Administrator $administrator, Category $category = null)
    {
        if ( ! is_null($category))
            return $category->trashed();
    }
}
