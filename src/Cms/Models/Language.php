<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Models;

use Arcanesoft\Foundation\Cms\Cms;
use Arcanesoft\Foundation\Cms\Models\Presenters\LanguagePresenter;
use Arcanesoft\Foundation\Support\Traits\Deletable;

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
 */
class Language extends Model
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use LanguagePresenter;
    use Deletable;

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
     * {@inheritDoc}
     */
    public function __construct(array $attributes = [])
    {
        $this->setTable(Cms::table('languages', 'languages'));

        parent::__construct($attributes);
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * {@inheritDoc}
     */
    public function isDeletable(): bool
    {
        return true;
    }
}
