<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Http\Controllers;

use Arcanesoft\Foundation\Cms\Http\Datatables\CategoriesDatatable;
use Arcanesoft\Foundation\Cms\Http\Requests\Categories\{CreateCategoryRequest, UpdateCategoryRequest};
use Arcanesoft\Foundation\Cms\Models\Category;
use Arcanesoft\Foundation\Cms\Policies\CategoriesPolicy;
use Arcanesoft\Foundation\Cms\Repositories\CategoriesRepository;
use Arcanesoft\Foundation\Support\Traits\HasNotifications;

/**
 * Class     CategoriesController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CategoriesController extends Controller
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasNotifications;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct()
    {
        parent::__construct();

        $this->setCurrentSidebarItem('foundation::cms.categories');

        $this->addBreadcrumbParent();
        $this->addBreadcrumbRoute(__('Categories'), 'admin::cms.categories.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * List all the categories.
     *
     * @param  bool  $trash
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(bool $trash = false)
    {
        $this->authorize(CategoriesPolicy::ability('index'));

        return $this->view('cms.categories.index', compact('trash'));
    }

    /**
     * Datatable api response.
     *
     * @param  \Arcanesoft\Foundation\Cms\Http\Datatables\CategoriesDatatable  $datatable
     *
     * @return \Arcanesoft\Foundation\Cms\Http\Datatables\CategoriesDatatable
     */
    public function datatable(CategoriesDatatable $datatable)
    {
        $this->authorize(CategoriesPolicy::ability('index'));

        return $datatable;
    }

    /**
     * List all the deleted categories.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function metrics()
    {
        $this->authorize(CategoriesPolicy::ability('metrics'));

        $this->selectMetrics('arcanesoft.foundation.metrics.selected.cms.categories');

        return $this->view('cms.categories.metrics');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function tree()
    {
        $this->authorize(CategoriesPolicy::ability('index'));

        return $this->view('cms.categories.tree');
    }

    /**
     * Create a new category.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(CategoriesRepository $repo)
    {
        $this->authorize(CategoriesPolicy::ability('create'));

        $this->addBreadcrumb(__('New Category'));

        $categories = $repo->getSelectOptions();

        return $this->view('cms.categories.create', compact('categories'));
    }

    /**
     * Persist the new category.
     *
     * @param  \Arcanesoft\Foundation\Cms\Http\Requests\Categories\CreateCategoryRequest  $request
     * @param  \Arcanesoft\Foundation\Cms\Repositories\CategoriesRepository               $categoriesRepo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCategoryRequest $request, CategoriesRepository $categoriesRepo)
    {
        $this->authorize(CategoriesPolicy::ability('create'));

        $category = $categoriesRepo->createOne($request->validated());

        static::notifySuccess(
            'Category Created',
            'A new category has been successfully created!'
        );

        return redirect()->route('admin::cms.categories.show', [$category]);
    }

    /**
     * Show the category's details.
     *
     * @param  \Arcanesoft\Foundation\Cms\Models\Category  $category
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Category $category)
    {
        $this->authorize(CategoriesPolicy::ability('show'), [$category]);

        $this->addBreadcrumbRoute(__("Category's details"), 'admin::cms.categories.show', [$category]);

        $parentCategory = $category->parent;
        $subCategories  = $category->children->loadCount(['children']);

        return $this->view(
            'cms.categories.show',
            compact('category', 'parentCategory', 'subCategories')
        );
    }

    /**
     * Edit the category.
     *
     * @param  \Arcanesoft\Foundation\Cms\Models\Category  $category
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Category $category, CategoriesRepository $repo)
    {
        $this->authorize(CategoriesPolicy::ability('update'), [$category]);

        $this->addBreadcrumbRoute(__('Edit Category'), 'admin::cms.categories.edit', [$category]);

        $categories = $repo->getSelectOptions();

        return $this->view('cms.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the category.
     *
     * @param  \Arcanesoft\Foundation\Cms\Models\Category                                 $category
     * @param  \Arcanesoft\Foundation\Cms\Http\Requests\Categories\UpdateCategoryRequest  $request
     * @param  \Arcanesoft\Foundation\Cms\Repositories\CategoriesRepository               $repo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Category $category, UpdateCategoryRequest $request, CategoriesRepository $repo)
    {
        $this->authorize(CategoriesPolicy::ability('update'), [$category]);

        $repo->updateOne($category, $request->validated());

        static::notifySuccess(
            'Category Updated',
            'The category has been successfully updated!'
        );

        return redirect()->route('admin::cms.categories.show', [$category]);
    }

    /**
     * Delete a category.
     *
     * @param  \Arcanesoft\Foundation\Cms\Models\Category                   $category
     * @param  \Arcanesoft\Foundation\Cms\Repositories\CategoriesRepository  $categoriesRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Category $category, CategoriesRepository $categoriesRepo)
    {
        $this->authorize(CategoriesPolicy::ability($category->trashed() ? 'force-delete' : 'delete'), [$category]);

        $categoriesRepo->deleteOne($category);

        static::notifySuccess(
            'Category Deleted',
            'The category has been successfully deleted!'
        );

        return static::jsonResponseSuccess();
    }

    /**
     * Restore a deleted category.
     *
     * @param  \Arcanesoft\Foundation\Cms\Models\Category                   $category
     * @param  \Arcanesoft\Foundation\Cms\Repositories\CategoriesRepository  $categoriesRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(Category $category, CategoriesRepository $categoriesRepo)
    {
        $this->authorize(CategoriesPolicy::ability('restore'), [$category]);

        $categoriesRepo->restoreOne($category);

        static::notifySuccess(
            'Category Restored',
            'The category has been successfully restored!'
        );

        return static::jsonResponseSuccess();
    }
}
