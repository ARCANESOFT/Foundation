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

    /** @var  mixed|string */
    public $value;

    /** @var  string */
    public $label;

    /** @var  string|null */
    public $help;

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
     * @param  string|null  $help
     */
    public function __construct(
        string $type = 'text',
        string $name,
        string $id = null,
        $value = null,
        ?string $label = null,
        ?string $help = null
    ) {
        parent::__construct($type, $name, $id, $value);

        $this->label = $label ?: $name;
        $this->help = $help;
    }
}