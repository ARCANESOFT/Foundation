<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Models;

use Arcanesoft\Foundation\Cms\Cms;
use Illuminate\Support\Str;
use Symfony\Component\Intl\Locales;

/**
 * Class     Locale
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  int                         id
 * @property  string                      code
 * @property  \Illuminate\Support\Carbon  created_at
 * @property  \Illuminate\Support\Carbon  updated_at
 * @property  \Illuminate\Support\Carbon  activated_at
 *
 * @property-read  string  name
 */
class Language extends Model
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** {@inheritdoc}  */
    protected $fillable = [
        'code',
    ];

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setTable(Cms::table('languages', 'languages'));

        parent::__construct($attributes);
    }

    /* -----------------------------------------------------------------
     |  Accessors & Mutators
     | -----------------------------------------------------------------
     */

    /**
     * Get the `name` attribute.
     *
     * @return string
     */
    public function getNameAttribute(): string
    {
        $name = Locales::getName($this->code, Cms::getLocale());

        return Str::ucfirst($name);
    }
}
