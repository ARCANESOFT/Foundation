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

    /** @var  string|null */
    public $id;

    /** @var  string */
    public $name;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * @param  string       $name
     * @param  string|null  $id
     */
    public function __construct(string $name = 'password', string $id = null)
    {
        $this->name = $name;
        $this->id = $id ?: $name;
    }
}
