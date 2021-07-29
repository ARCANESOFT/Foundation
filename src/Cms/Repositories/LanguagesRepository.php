<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Repositories;

use Arcanesoft\Foundation\Cms\Cms;
use Arcanesoft\Foundation\Cms\Models\Language;

/**
 * Class     LanguagesRepository
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LanguagesRepository extends Repository
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
        return Cms::model('language', Language::class);
    }

    /**
     * Create a new language.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Foundation\Cms\Models\Language
     */
    public function createOne(array $attributes): Language
    {
        dd($attributes);
    }

    /**
     * Delete the given language.
     *
     * @param  \Arcanesoft\Foundation\Cms\Models\Language  $language
     */
    public function deleteOne(Language $language)
    {
        //
    }
}
