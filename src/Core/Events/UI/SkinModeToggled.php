<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Events\UI;

/**
 * Class     SkinModeToggled
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SkinModeToggled
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
     * SkinModeToggled constructor.
     *
     * @param  array  $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }
}
