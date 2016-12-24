<?php namespace Arcanesoft\Foundation\Services\RoutesViewer\Entities;

/**
 * Class     Route
 *
 * @package  Arcanesoft\Foundation\Services\RoutesViewer\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Route
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var array */
    public $methods = [];

    /** @var string */
    public $uri;

    /** @var array */
    public $params = [];

    /** @var string */
    public $name;

    /** @var string */
    public $action;

    /** @var array */
    public $middleware;

    /** @var string|null */
    public $domain;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Route constructor.
     *
     * @param  array        $methods
     * @param  string       $uri
     * @param  string|null  $name
     * @param  string|null  $action
     * @param  array        $middleware
     * @param  string|null  $domain
     */
    public function __construct(array $methods, $uri, $action, $name, array $middleware, $domain)
    {
        $this->methods    = $methods;
        $this->setUri($uri);
        $this->name       = $name;
        $this->action     = $action;
        $this->middleware = $middleware;
        $this->domain     = $domain;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set the route URI.
     *
     * @param  string  $uri
     *
     * @return self
     */
    private function setUri($uri)
    {
        $this->uri = $uri;

        preg_match_all('/({[^}]+})/', $this->uri, $matches);
        $this->params = $matches[0];

        return $this;
    }

    /**
     * Get the action namespace.
     *
     * @return string
     */
    public function getActionNamespace()
    {
        return $this->isClosure() ? '' : explode('@', $this->action)[0];
    }

    /**
     * Get the action method.
     *
     * @return string
     */
    public function getActionMethod()
    {
        return $this->isClosure() ? '' : explode('@', $this->action)[1];
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check if the route has name.
     *
     * @return bool
     */
    public function hasName()
    {
        return ! is_null($this->name);
    }

    /**
     * Check if the route has domain.
     *
     * @return bool
     */
    public function hasDomain()
    {
        return ! is_null($this->domain);
    }

    /**
     * Check if the action is a closure function.
     *
     * @return bool
     */
    public function isClosure()
    {
        return $this->action === 'Closure';
    }
}
