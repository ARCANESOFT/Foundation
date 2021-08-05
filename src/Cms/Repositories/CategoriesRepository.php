<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Repositories;

use Arcanesoft\Foundation\Cms\Cms;
use Arcanesoft\Foundation\Cms\Models\Category;

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
        return tap(
            $this->newModelInstance()->fill($attributes),
            function (Category $category) use ($attributes) {
                $category->setParentId($attributes['parent']);
                $category->save();
            }
        );
    }

    /**
     * Update the given category.
     *
     * @param  \Arcanesoft\Foundation\Cms\Models\Category  $category
     * @param  array                                       $attributes
     */
    public function updateOne(Category $category, array $attributes)
    {
        //
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
}
