<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Traits;

use Arcanesoft\Foundation\Cms\Cms;
use Arcanesoft\Foundation\Cms\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\{Arr, Collection};

/**
 * Trait     Categorizable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property-read  \Illuminate\Database\Eloquent\Collection|\Arcanesoft\Foundation\Cms\Models\Category[]|iterable  categories
 *
 * @mixin  \Illuminate\Database\Eloquent\Model
 */
trait Categorizable
{
    /* -----------------------------------------------------------------
     |  Relationship
     | -----------------------------------------------------------------
     */

    /**
     * Categories' relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function categories(): MorphToMany
    {
        return $this->morphToMany(
            Cms::model('category', Category::class),
            'categorizable',
            Cms::table('categorizables', 'categorizables'),
            'categorizable_id',
            'category_id'
        )->withTimestamps();
    }

    /**
     * Mutator for setting the categories
     *
     * @param  \Arcanesoft\Foundation\Cms\Models\Category|\Arcanesoft\Foundation\Cms\Models\Category[]|mixed  $categories
     */
    public function setCategoriesAttribute($categories): void
    {
        static::saved(function (self $model) use ($categories) {
            $model->syncCategories($categories);
        });
    }

    /**
     * Boot the categorizable trait for the model.
     */
    public static function bootCategorizable(): void
    {
        static::deleted(function (self $model) {
            $model->categories()->detach();
        });
    }

    /**
     * Scope query with all the given categories.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param mixed                                 $categories
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithAllCategories(Builder $builder, $categories): Builder
    {
        $categories = $this->prepareCategoryIds($categories);

        Collection::make($categories)->each(function ($category) use ($builder) {
            $builder->whereHas('categories', function (Builder $builder) use ($category) {
                return $builder->where('id', $category);
            });
        });

        return $builder;
    }

    /**
     * Scope query with any of the given categories.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param mixed                                 $categories
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithAnyCategories(Builder $builder, $categories): Builder
    {
        $categories = $this->prepareCategoryIds($categories);

        return $builder->whereHas('categories', function (Builder $builder) use ($categories) {
            $builder->whereIn('id', $categories);
        });
    }

    /**
     * Scope query with any of the given categories.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param mixed                                 $categories
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithCategories(Builder $builder, $categories): Builder
    {
        return static::scopeWithAnyCategories($builder, $categories);
    }

    /**
     * Scope query without any of the given categories.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param mixed                                 $categories
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithoutCategories(Builder $builder, $categories): Builder
    {
        $categories = $this->prepareCategoryIds($categories);

        return $builder->whereDoesntHave('categories', function (Builder $builder) use ($categories) {
            $builder->whereIn('id', $categories);
        });
    }

    /**
     * Scope query without any categories.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithoutAnyCategories(Builder $builder): Builder
    {
        return $builder->doesntHave('categories');
    }

    /**
     * Determine if the model has any of the given categories.
     *
     * @param mixed $categories
     *
     * @return bool
     */
    public function hasCategories($categories): bool
    {
        $categories = $this->prepareCategoryIds($categories);

        return ! $this->categories->pluck('id')->intersect($categories)->isEmpty();
    }

    /**
     * Determine if the model has any the given categories.
     *
     * @param mixed $categories
     *
     * @return bool
     */
    public function hasAnyCategories($categories): bool
    {
        return static::hasCategories($categories);
    }

    /**
     * Determine if the model has all of the given categories.
     *
     * @param mixed $categories
     *
     * @return bool
     */
    public function hasAllCategories($categories): bool
    {
        $categories = $this->prepareCategoryIds($categories);

        return Collection::make($categories)
            ->diff($this->categories()->pluck('id'))
            ->isEmpty();
    }

    /**
     * Sync model categories.
     *
     * @param  mixed  $categories
     * @param  bool   $detaching
     *
     * @return $this
     */
    public function syncCategories($categories, bool $detaching = true): self
    {
        // Find categories
        $categories = $this->prepareCategoryIds($categories);

        // Sync model categories
        $this->categories()->sync($categories, $detaching);

        return $this;
    }

    /**
     * Attach model categories.
     *
     * @param mixed $categories
     *
     * @return $this
     */
    public function attachCategories($categories): self
    {
        return $this->syncCategories($categories, false);
    }

    /**
     * Detach model categories.
     *
     * @param mixed $categories
     *
     * @return $this
     */
    public function detachCategories($categories = null): self
    {
        $categories = ! is_null($categories) ? $this->prepareCategoryIds($categories) : null;

        // Sync model categories
        $this->categories()->detach($categories);

        return $this;
    }

    /**
     * Prepare category IDs.
     *
     * @param mixed $categories
     *
     * @return array
     */
    protected function prepareCategoryIds($categories): array
    {
        // Convert collection to plain array
        if ($categories instanceof Collection && is_string($categories->first())) {
            $categories = $categories->toArray();
        }

        // Find categories by their ids
        if (is_numeric($categories) || (is_array($categories) && is_numeric(Arr::first($categories)))) {
            return array_map('intval', (array) $categories);
        }

        // Find categories by their slugs
        if (is_string($categories) || (is_array($categories) && is_string(Arr::first($categories)))) {
            $categories = Cms::makeModel('category', Category::class)
                ->newQuery()
                ->whereIn('slug', (array) $categories)
                ->pluck('id');
        }

        if ($categories instanceof Model)
            return [$categories->getKey()];

        if ($categories instanceof EloquentCollection)
            return $categories->modelKeys();

        if ($categories instanceof Collection)
            return $categories->toArray();

        return (array) $categories;
    }
}
