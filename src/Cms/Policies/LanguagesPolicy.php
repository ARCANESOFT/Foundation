<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Policies;

use Arcanesoft\Foundation\Authorization\Models\Administrator;
use Arcanesoft\Foundation\Cms\Models\Language;

/**
 * Class     LanguagesPolicy
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LanguagesPolicy extends AbstractPolicy
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
        return 'admin::cms.languages.';
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
            'category' => 'Languages',
        ]);

        return [

            // admin::cms.languages.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the languages',
                'description' => 'Ability to list all the languages'
            ]),

            // admin::cms.languages.metrics
            $this->makeAbility('metrics')->setMetas([
                'name'        => 'Show the metrics',
                'description' => 'Ability to show the language\'s metrics',
            ]),

            // admin::cms.languages.show
            $this->makeAbility('show')->setMetas([
                'name'        => 'Show a language',
                'description' => 'Ability to show the language\'s details',
            ]),

            // admin::cms.languages.create
            $this->makeAbility('create')->setMetas([
                'name'        => 'Create a new language',
                'description' => 'Ability to create a new language',
            ]),

            // admin::cms.languages.activate
            $this->makeAbility('activate')->setMetas([
                'name'        => 'Activate a language',
                'description' => 'Ability to activate a language',
            ]),

            // admin::cms.languages.deactivate
            $this->makeAbility('deactivate')->setMetas([
                'name'        => 'Deactivate a language',
                'description' => 'Ability to deactivate a language',
            ]),

            // admin::cms.languages.delete
            $this->makeAbility('delete')->setMetas([
                'name'        => 'Delete a language',
                'description' => 'Ability to delete a language',
            ]),

        ];
    }

    /* -----------------------------------------------------------------
     |  Abilities
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the languages.
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
     * Allow to show the language's metrics.
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
     * Allow to show a language details.
     *
     * @param \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param \Arcanesoft\Foundation\Cms\Models\Language|null                  $language
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function show(Administrator $administrator, Language $language = null)
    {
        //
    }

    /**
     * Allow to create a language.
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
     * Allow to delete a language.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $administrator
     * @param  \Arcanesoft\Foundation\Cms\Models\Language|null                  $language
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function delete(Administrator $administrator, Language $language = null)
    {
        if ( ! is_null($language))
            return $language->isDeletable();
    }
}
