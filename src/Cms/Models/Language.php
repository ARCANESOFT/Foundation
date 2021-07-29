<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Models;

use Arcanesoft\Foundation\Cms\Cms;

/**
 * Class     Locale
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Language extends Model
{
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
}
