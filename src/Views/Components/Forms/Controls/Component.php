<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms\Controls;

use Arcanesoft\Foundation\Views\Components\Forms\Inputs\Component as BaseComponent;

/**
 * Class     Component
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Component extends BaseComponent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  string */
    public $type;

    /** @var  mixed|string */
    public $value;

    /** @var  string */
    public $label;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * @param  string       $name
     * @param  string|null  $id
     * @param  string       $type
     * @param  mixed|null   $value
     * @param  string|null  $label
     */
    public function __construct(
        string $name,
        string $id = null,
        string $type = 'text',
        $value = null,
        ?string $label = null
    ) {
        parent::__construct($name, $id);

        $this->type = $type;
        $this->value = $value;
        $this->label = $label ?: $name;
    }
}
