<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Models;

use Arcanesoft\Foundation\Authorization\Auth;
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
        $this->setConnection(Auth::config('database.connection'));

        parent::__construct($attributes);
    }
}
