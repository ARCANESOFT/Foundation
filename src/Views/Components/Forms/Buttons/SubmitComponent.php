<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms\Buttons;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;
use InvalidArgumentException;

/**
 * Class     SubmitComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SubmitComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const ACTION_TYPE_ACTIVATE   = 'activate';
    const ACTION_TYPE_DEACTIVATE = 'deactivate';
    const ACTION_TYPE_RESTORE    = 'restore';
    const ACTION_TYPE_SAVE       = 'save';
    const ACTION_TYPE_DELETE     = 'delete';

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
     * Submit constructor.
     *
     * @param  string  $type
     */
    public function __construct(string $type)
    {
        $this->type = $type;
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
        $this->checkType($type);

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

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * {@inheritDoc}
     */
    public function render(): View
    {
        return $this->view('forms.buttons.submit');
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check the given type.
     *
     * @param  string  $type
     */
    protected function checkType(string $type)
    {
        throw_unless(
            $this->isAllowedType($type),
            new InvalidArgumentException("Invalid action type: {$type}")
        );
    }

    /**
     * Check is allowed type.
     *
     * @param  string  $type
     *
     * @return bool
     */
    protected function isAllowedType(string $type): bool
    {
        return in_array($type, $this->getAllowedTypes());
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

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
            static::ACTION_TYPE_RESTORE,
            static::ACTION_TYPE_SAVE,
            static::ACTION_TYPE_DELETE,
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
            static::ACTION_TYPE_RESTORE    => 'fas fa-fw fa-recycle',
            static::ACTION_TYPE_SAVE       => 'far fa-fw fa-save',
            static::ACTION_TYPE_DELETE     => 'far fa-fw fa-trash-alt',
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
            static::ACTION_TYPE_RESTORE    => 'Restore',
            static::ACTION_TYPE_SAVE       => 'Save',
            static::ACTION_TYPE_DELETE     => 'Delete',
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
            static::ACTION_TYPE_ACTIVATE   => 'btn btn-sm btn-success',
            static::ACTION_TYPE_DEACTIVATE => 'btn btn-sm btn-secondary',
            static::ACTION_TYPE_RESTORE    => 'btn btn-sm btn-primary',
            static::ACTION_TYPE_SAVE       => 'btn btn-sm btn-primary',
            static::ACTION_TYPE_DELETE     => 'btn btn-sm btn-danger',
        ];
    }
}
