<?php namespace Arcanesoft\Foundation\Bases;

use Arcanedev\Support\Bases\Controller as BaseController;

/**
 * Class     Controller
 *
 * @package  Arcanesoft\Foundation\Bases
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Controller extends BaseController
{
    /* ------------------------------------------------------------------------------------------------
     |  Traits
     | ------------------------------------------------------------------------------------------------
     */
    use \Arcanedev\Breadcrumbs\Traits\BreadcrumbsTrait,
        \Arcanedev\SeoHelper\Traits\Seoable,
        \Arcanedev\Support\Traits\Templatable;

    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The view namespace.
     *
     * @var string
     */
    protected $viewNamespace;
}
