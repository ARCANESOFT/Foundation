<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Events\UI;

/**
 * Class     SidebarToggled
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SidebarToggled
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /** @var array */
    public $options = [];

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * SidebarToggled constructor.
     *
     * @param  array  $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }
}
