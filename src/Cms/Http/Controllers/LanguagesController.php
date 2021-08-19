<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Http\Controllers;

use Arcanesoft\Foundation\Cms\Http\Datatables\LanguagesDatatable;
use Arcanesoft\Foundation\Cms\Http\Requests\Languages\CreateLanguagesRequest;
use Arcanesoft\Foundation\Cms\Models\Language;
use Arcanesoft\Foundation\Cms\Policies\LanguagesPolicy;
use Arcanesoft\Foundation\Cms\Repositories\LanguagesRepository;
use Arcanesoft\Foundation\Support\Traits\HasNotifications;

/**
 * Class     LanguagesController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LanguagesController extends Controller
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

    /**
     * LanguagesController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setCurrentSidebarItem('foundation::cms.languages');

        $this->addBreadcrumbParent();
        $this->addBreadcrumbRoute(__('Languages'), 'admin::cms.languages.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * List all the languages.
     *
     * @param  bool  $trash
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(bool $trash = false)
    {
        $this->authorize(LanguagesPolicy::ability('index'));

        return $this->view('cms.languages.index', compact('trash'));
    }

    /**
     * Datatable api response.
     *
     * @param  \Arcanesoft\Foundation\Cms\Http\Datatables\LanguagesDatatable  $datatable
     *
     * @return \Arcanesoft\Foundation\Cms\Http\Datatables\LanguagesDatatable
     */
    public function datatable(LanguagesDatatable $datatable)
    {
        $this->authorize(LanguagesPolicy::ability('index'));

        return $datatable;
    }

    /**
     * Show the languages metrics.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function metrics()
    {
        $this->authorize(LanguagesPolicy::ability('metrics'));

        $this->selectMetrics('arcanesoft.foundation.metrics.selected.cms.languages');

        return $this->view('cms.languages.metrics');
    }

    /**
     * Create a new language.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(LanguagesRepository $repo)
    {
        $this->authorize(LanguagesPolicy::ability('create'));

        $this->addBreadcrumb(__('New Languages'));

        $languages = $repo->getAvailableLanguages();

        return $this->view('cms.languages.create', compact('languages'));
    }

    /**
     * Persist the new language.
     *
     * @param  \Arcanesoft\Foundation\Cms\Http\Requests\Languages\CreateLanguagesRequest  $request
     * @param  \Arcanesoft\Foundation\Cms\Repositories\LanguagesRepository                $languagesRepo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateLanguagesRequest $request, LanguagesRepository $languagesRepo)
    {
        $this->authorize(LanguagesPolicy::ability('create'));

        $language = $languagesRepo->createOne($request->validated());

        static::notifySuccess(
            'Language Created',
            'A new language has been successfully created!'
        );

        return redirect()->route('admin::cms.languages.show', [$language]);
    }

    /**
     * Show the language's details.
     *
     * @param  \Arcanesoft\Foundation\Cms\Models\Language  $language
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Language $language)
    {
        $this->authorize(LanguagesPolicy::ability('show'), [$language]);

        $this->addBreadcrumbRoute(__("Languages details"), 'admin::cms.languages.show', [$language]);

        return $this->view('cms.languages.show', compact('language'));
    }

    /**
     * Delete a language.
     *
     * @param  \Arcanesoft\Foundation\Cms\Models\Language                   $language
     * @param  \Arcanesoft\Foundation\Cms\Repositories\LanguagesRepository  $languagesRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Language $language, LanguagesRepository $languagesRepo)
    {
        $this->authorize(LanguagesPolicy::ability('delete'), [$language]);

        $languagesRepo->deleteOne($language);

        static::notifySuccess(
            'Language Deleted',
            'The language has been successfully deleted!'
        );

        return static::jsonResponseSuccess();
    }
}
