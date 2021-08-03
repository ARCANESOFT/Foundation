<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms\Inputs;

use Arcanesoft\Foundation\Views\Components\Component as BaseComponent;

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

    /** @var  string */
    public $name;

    /** @var  string|null */
    public $id;

    /** @var  mixed|null */
    public $value;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * @param  string       $type
     * @param  string       $name
     * @param  string|null  $id
     */
    public function __construct(string $type, string $name, string $id = null, $value = null)
    {
        $this->type = $type;
        $this->name = $name;
        $this->id = $id ?: $name;
        $this->value = $value;
    }
}
