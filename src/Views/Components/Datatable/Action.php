<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Datatable;

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
    const ACTION_TYPE_EDIT       = 'edit';
    const ACTION_TYPE_RESTORE    = 'restore';
    const ACTION_TYPE_SHOW       = 'show';

    const ACTION_TAG_BUTTON     = 'button';
    const ACTION_TAG_LINK       = 'link';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  string */
    public $type;

    /** @var  string */
    public $action;

    /** @var  bool */
    public $allowed;

    /**
     * Allowed action's types.
     *
     * @var array
     */
    protected $allowedTypes = [
        self::ACTION_TYPE_ACTIVATE,
        self::ACTION_TYPE_DEACTIVATE,
        self::ACTION_TYPE_DELETE,
        self::ACTION_TYPE_DETACH,
        self::ACTION_TYPE_EDIT,
        self::ACTION_TYPE_RESTORE,
        self::ACTION_TYPE_SHOW,
    ];

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Link constructor.
     *
     * @param  string  $type
     * @param  string  $action
     * @param  bool    $allowed
     */
    public function __construct(string $type, string $action, bool $allowed = true)
    {
        $this->setType($type);
        $this->action = $action;
        $this->allowed = $allowed;
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
            in_array($type, $this->allowedTypes),
            new InvalidArgumentException("Invalid datatable action type: {$type}")
        );

        $this->type = $type;

        return $this;
    }

    /**
     * Get the action's icon.
     *
     * @return string
     */
    public function actionIcon(): string
    {
        return $this->actionIcons()[$this->type];
    }

    /**
     * Get the action's title.
     *
     * @return string
     */
    public function actionName(): string
    {
        return __($this->actionNames()[$this->type]);
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
        return view()->make('foundation::_components.datatable.action');
    }

    /**
     * Get the action's tag.
     *
     * @return string
     */
    public function actionTag(): string
    {
        return [
            static::ACTION_TYPE_ACTIVATE   => static::ACTION_TAG_BUTTON,
            static::ACTION_TYPE_DEACTIVATE => static::ACTION_TAG_BUTTON,
            static::ACTION_TYPE_DELETE     => static::ACTION_TAG_BUTTON,
            static::ACTION_TYPE_DETACH     => static::ACTION_TAG_BUTTON,
            static::ACTION_TYPE_EDIT       => static::ACTION_TAG_LINK,
            static::ACTION_TYPE_RESTORE    => static::ACTION_TAG_BUTTON,
            static::ACTION_TYPE_SHOW       => static::ACTION_TAG_LINK,
        ][$this->type];
    }

    /**
     * Determine if the action is destructive.
     *
     * @return bool
     */
    public function isDestructiveAction(): bool
    {
        return in_array($this->type, [
            static::ACTION_TYPE_DETACH,
            static::ACTION_TYPE_DELETE,
        ]);
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
    protected function actionIcons(): array
    {
        return [
            static::ACTION_TYPE_ACTIVATE   => 'far fa-fw fa-check-circle',
            static::ACTION_TYPE_DEACTIVATE => 'fas fa-fw fa-ban',
            static::ACTION_TYPE_DELETE     => 'far fa-fw fa-trash-alt',
            static::ACTION_TYPE_DETACH     => 'fas fa-fw fa-unlink',
            static::ACTION_TYPE_EDIT       => 'far fa-fw fa-edit',
            static::ACTION_TYPE_RESTORE    => 'fas fa-fw fa-recycle',
            static::ACTION_TYPE_SHOW       => 'far fa-fw fa-eye',
        ];
    }

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
            static::ACTION_TYPE_EDIT       => 'Edit',
            static::ACTION_TYPE_RESTORE    => 'Restore',
            static::ACTION_TYPE_SHOW       => 'Show',
        ];
    }
}
