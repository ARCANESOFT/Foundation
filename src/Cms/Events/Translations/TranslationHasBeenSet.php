<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Events\Translations;

/**
 * Class     TranslationHasBeenSet
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TranslationHasBeenSet
{
    /** @var  mixed */
    private $model;

    /** @var  string */
    private $key;

    /** @var  string */
    public $locale;

    /** @var  mixed */
    public $oldValue;

    /** @var  mixed */
    public $newValue;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * @param  mixed   $model
     * @param  string  $key
     * @param  string  $locale
     * @param  mixed   $oldValue
     * @param  mixed   $newValue
     */
    public function __construct($model, string $key, string $locale, $oldValue, $newValue)
    {
        $this->model    = $model;
        $this->key      = $key;
        $this->locale   = $locale;
        $this->oldValue = $oldValue;
        $this->newValue = $newValue;
    }
}
