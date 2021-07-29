<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Models;

use Arcanesoft\Foundation\Cms\Cms;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\{NestedSet, NodeTrait};

/**
 * Class     Category
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  int                  $id
 * @property  string               $slug
 * @property  array                $name
 * @property  array                $description
 * @property  int                  $_lft
 * @property  int                  $_rgt
 * @property  int                  $parent_id
 * @property  \Carbon\Carbon|null  $created_at
 * @property  \Carbon\Carbon|null  $updated_at
 * @property  \Carbon\Carbon|null  $deleted_at
 *
 * @property-read  \Kalnoy\Nestedset\Collection|\Arcanesoft\Foundation\Cms\Models\Category[]  $children
 * @property-read  \Arcanesoft\Foundation\Cms\Models\Category|null                            $parent
 */
class Category extends Model
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use NodeTrait;
    use SoftDeletes;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'slug',
        'name',
        'description',
        NestedSet::LFT,
        NestedSet::RGT,
        NestedSet::PARENT_ID,
    ];

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'id'                 => 'integer',
        NestedSet::LFT       => 'integer',
        NestedSet::RGT       => 'integer',
        NestedSet::PARENT_ID => 'integer',
        'deleted_at'         => 'datetime',
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
        $this->setTable(Cms::table('categories', 'categories'));

        parent::__construct($attributes);
    }
}

