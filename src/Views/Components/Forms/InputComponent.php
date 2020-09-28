<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms;

use Illuminate\View\Component;

/**
 * Class     InputComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class InputComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * @var string|null
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * InputComponent constructor.
     *
     * @param  string       $name
     * @param  string|null  $id
     */
    public function __construct(string $name = 'password', string $id = null)
    {
        $this->name = $name;
        $this->id = $id ?: $name;
    }
}
