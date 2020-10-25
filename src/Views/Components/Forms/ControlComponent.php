<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms;

/**
 * Class     ControlComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class ControlComponent extends InputComponent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    public $type;

    public $value;

    public $label;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * ControlComponent constructor.
     *
     * @param  string       $name
     * @param  string|null  $id
     * @param  string       $type
     * @param  string|null  $value
     * @param  string|null  $label
     */
    public function __construct(
        string $name,
        string $id = null,
        string $type = 'text',
        ?string $value = null,
        ?string $label = null
    ) {
        parent::__construct($name, $id);

        $this->type = $type;
        $this->value = $value ?: old($name);
        $this->label = __($label ?: $name);
    }
}
