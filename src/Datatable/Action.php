<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Datatable;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\{Arrayable, Jsonable};
use JsonSerializable;

/**
 * Class     Action
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Action implements Arrayable, Jsonable, JsonSerializable
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var \Closure
     */
    protected $action;

    /**
     * @var bool
     */
    protected $allowed = true;

    /**
     * @var \Closure
     */
    protected $condition;

    /**
     * @var string
     */
    protected $type;

    /**
     * Show only the action's icon.
     *
     * @var bool
     */
    protected $icon = false;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Action constructor.
     *
     * @param  string       $name
     * @param  string|null  $label
     */
    public function __construct(string $name, ?string $label)
    {
        $this->name = $name;
        $this->label($label ?: $name);
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the action's name.
     *
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Set the action's label.
     *
     * @param  string  $label
     *
     * @return $this
     */
    public function label(string $label)
    {
        $this->label = __($label);

        return $this;
    }

    /**
     * Set the action's type.
     *
     * @param  string  $type
     *
     * @return $this
     */
    protected function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the type.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Show this action as icon only.
     *
     * @return $this
     */
    public function asIcon(): self
    {
        $this->icon = true;

        return $this;
    }

    /**
     * Set the action's executable.
     *
     * @param  \Closure  $action
     *
     * @return $this
     */
    protected function setAction(Closure $action): self
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get the action's label.
     *
     * @return string
     */
    protected function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Get the action's icon.
     *
     * @return string|null
     */
    protected function getIcon(): ?string
    {
        return $this->getIcons()[$this->name] ?: null;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make a new action instance.
     *
     * @param  string       $name
     * @param  string|null  $label
     *
     * @return $this
     */
    public static function make(string $name, ?string $label = null): self
    {
        return new static($name, $label);
    }

    /**
     * Make a link action.
     *
     * @param  string    $name
     * @param  string    $label
     * @param  \Closure  $action
     *
     * @return $this
     */
    public static function link(string $name, string $label, Closure $action): self
    {
        return static::make($name, $label)
            ->setType('link')
            ->setAction($action);
    }

    /**
     * Make a button action.
     *
     * @param  string    $name
     * @param  string    $label
     * @param  \Closure  $action
     *
     * @return $this
     */
    public static function button(string $name, string $label, Closure $action): self
    {
        return static::make($name, $label)
            ->setType('button')
            ->setAction($action);
    }

    /**
     * Set the allowed condition.
     *
     * @param  \Closure  $condition
     *
     * @return $this
     */
    public function can(Closure $condition): self
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * Convert the fluent instance to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return with(app(), function (Application $app) {
            $allowed = $app->call($this->condition);

            return [
                'name'    => $this->name,
                'type'    => $this->getType(),
                'label'   => $this->getLabel(),
                'icon'    => $this->icon ? $this->getIcon() : null,
                'action'  => $allowed ? (string) $app->call($this->action) : null,
                'allowed' => $allowed,
            ];
        });
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * Get the collection of items as JSON.
     *
     * @param  int  $options
     *
     * @return string
     */
    public function toJson($options = 0): string
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the action's icons.
     *
     * @return string[]
     */
    protected function getIcons(): array
    {
        return (array) config('arcanesoft.foundation.datatable.actions.icons', []);
    }
}
