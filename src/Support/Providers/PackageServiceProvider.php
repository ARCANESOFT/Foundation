<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Providers;

use Arcanedev\Support\Providers\PackageServiceProvider as ServiceProvider;

/**
 * Class     PackageServiceProvider
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class PackageServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The vendor name.
     *
     * @var  string
     */
    protected $vendor = 'arcanesoft';
}
