<?php namespace Arcanesoft\Foundation\Services\RoutesViewer;

use Illuminate\Contracts\Routing\Registrar as RouterContract;

/**
 * Class     Manager
 *
 * @package  Arcanesoft\Foundation\Services
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Manager
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var  \Illuminate\Routing\Router */
    protected $router;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Manager constructor.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar  $router
     */
    public function __construct(RouterContract $router)
    {
        $this->router = $router;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function all()
    {
        return Entities\RouteCollection::load(
            $this->router->getRoutes()->getRoutes(),
            $this->getExcludedUris(),
            $this->getExcludedMethods(),
            $this->getMethodColors()
        );
    }

    public function getExcludedUris()
    {
        return $this->getConfig('uris.excluded', []);
    }

    public function getExcludedMethods()
    {
        return $this->getConfig('methods.excluded', ['HEAD']);
    }

    private function getMethodColors()
    {
        return $this->getConfig('methods.colors', [
            'GET'    => 'success',
            'HEAD'   => 'default',
            'POST'   => 'primary',
            'PUT'    => 'warning',
            'PATCH'  => 'info',
            'DELETE' => 'danger',
        ]);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function getConfig($key, $default = null)
    {
        return config("arcanesoft.foundation.routes-viewer.{$key}", $default);
    }
}
