<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Models;

use Arcanesoft\Foundation\Cms\Cms;
use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * Class     Model
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Model extends BaseModel
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
        $this->setConnection(Cms::config('database.connection'));

        parent::__construct($attributes);
    }
}
