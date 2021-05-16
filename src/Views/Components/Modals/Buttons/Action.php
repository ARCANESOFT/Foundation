<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Modals\Buttons;

use Illuminate\View\Component;
use InvalidArgumentException;

/**
 * Class     Action
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Action extends Component
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const ACTION_TYPE_ACTIVATE   = 'activate';
    const ACTION_TYPE_DEACTIVATE = 'deactivate';
    const ACTION_TYPE_DELETE     = 'delete';
    const ACTION_TYPE_DETACH     = 'detach';
    const ACTION_TYPE_RESTORE    = 'restore';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * @var string
     */
    public $type;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Action constructor.
     *
     * @param  string  $type
     */
    public function __construct(string $type)
    {
        $this->setType($type);
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the action type.
     *
     * @param  string  $type
     *
     * @return $this
     *
     * @throws \Exception
     */
    protected function setType(string $type)
    {
        throw_unless(
            in_array($type, $this->getAllowedTypes()),
            new InvalidArgumentException("Invalid datatable action type: {$type}")
        );

        $this->type = $type;

        return $this;
    }

    /**
     * Get the action name.
     *
     * @return string
     */
    public function actionName(): string
    {
        return __($this->actionNames()[$this->type]);
    }

    /**
     * Get the action css class.
     *
     * @return string
     */
    public function actionClass(): string
    {
        return $this->actionClasses()[$this->type];
    }

    /**
     * Get the action icon.
     *
     * @return string
     */
    public function actionIcon(): string
    {
        return $this->actionIcons()[$this->type];
    }

    /**
     * Get the allowed types.
     *
     * @return string[]
     */
    protected function getAllowedTypes(): array
    {
        return [
            static::ACTION_TYPE_ACTIVATE,
            static::ACTION_TYPE_DEACTIVATE,
            static::ACTION_TYPE_DELETE,
            static::ACTION_TYPE_DETACH,
            static::ACTION_TYPE_RESTORE,
        ];
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view()->make('foundation::_components.modals.buttons.action');
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the action's titles.
     *
     * @return string[]
     */
    protected function actionNames(): array
    {
        return [
            static::ACTION_TYPE_ACTIVATE   => 'Activate',
            static::ACTION_TYPE_DEACTIVATE => 'Deactivate',
            static::ACTION_TYPE_DELETE     => 'Delete',
            static::ACTION_TYPE_DETACH     => 'Detach',
            static::ACTION_TYPE_RESTORE    => 'Restore',
        ];
    }

    /**
     * Get the action's icons.
     *
     * @return string[]
     */
    protected function actionIcons(): array
    {
        return [
            static::ACTION_TYPE_ACTIVATE   => 'far fa-fw fa-check-circle',
            static::ACTION_TYPE_DEACTIVATE => 'fas fa-fw fa-ban',
            static::ACTION_TYPE_DELETE     => 'far fa-fw fa-trash-alt',
            static::ACTION_TYPE_DETACH     => 'fas fa-fw fa-unlink',
            static::ACTION_TYPE_RESTORE    => 'fas fa-fw fa-recycle',
        ];
    }

    /**
     * Get the action's classes.
     *
     * @return string[]
     */
    protected function actionClasses(): array
    {
        return [
            static::ACTION_TYPE_ACTIVATE   => 'btn btn-success',
            static::ACTION_TYPE_DEACTIVATE => 'btn btn-secondary',
            static::ACTION_TYPE_DELETE     => 'btn btn-danger',
            static::ACTION_TYPE_DETACH     => 'btn btn-danger',
            static::ACTION_TYPE_RESTORE    => 'btn btn-primary',
        ];
    }
}
