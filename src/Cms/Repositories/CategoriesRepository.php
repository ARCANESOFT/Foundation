<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Repositories;

use Arcanesoft\Foundation\Cms\Cms;
use Arcanesoft\Foundation\Cms\Models\Category;
use Illuminate\Support\Collection;

/**
 * Class     CategoriesRepository
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CategoriesRepository extends Repository
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the model FQN class.
     *
     * @return string
     */
    public static function modelClass(): string
    {
        return Cms::model('category', Category::class);
    }

    /* -----------------------------------------------------------------
     |  CRUD Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the first user with the given uuid, or fails if not found.
     *
     * @param  string  $uuid
     *
     * @return \Arcanesoft\Foundation\Cms\Models\Category|mixed
     */
    public function firstWhereUuidOrFail(string $uuid): Category
    {
        return $this
            ->where('uuid', '=', $uuid)
            ->withTrashed()
            ->firstOrFail();
    }

    /**
     * Create a new category.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Foundation\Cms\Models\Category
     */
    public function createOne(array $attributes): Category
    {
        if ( ! is_null($attributes['parent']))
            return $this->createOneWithParent($attributes['parent'], $attributes);

        return tap(
            $this->model()->fill($attributes),
            function (Category $category) use ($attributes) {
                $category->save();
            }
        );
    }

    /**
     * Create a category with a parent.
     *
     * @param  int|string  $parent
     * @param  array       $attributes
     *
     * @return \Arcanesoft\Foundation\Cms\Models\Category
     */
    public function createOneWithParent($parent, array $attributes): Category
    {
        /** @var  \Arcanesoft\Foundation\Cms\Models\Category  $parent */
        $parent = $this->find($parent);

        return tap($parent->children()->make($attributes), function (Category $category) {
            $category->save();
        });
    }

    /**
     * Update the given category.
     *
     * @param  \Arcanesoft\Foundation\Cms\Models\Category  $category
     * @param  array                                       $attributes
     */
    public function updateOne(Category $category, array $attributes)
    {
        return $category
            ->fill($attributes)
            ->setParentId($attributes['parent'])
            ->save();
    }

    /**
     * Delete the given category.
     *
     * @param  \Arcanesoft\Foundation\Cms\Models\Category  $category
     */
    public function deleteOne(Category $category)
    {
        //
    }

    /**
     * Restore the given category.
     *
     * @param  \Arcanesoft\Foundation\Cms\Models\Category  $category
     */
    public function restoreOne(Category $category)
    {
        //
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getSelectOptions(): Collection
    {
        $model = $this->model();

        return $this
            ->pluck('name', $model->getKeyName())
            ->prepend(__('-- Select a parent --'), 0);
    }
}
