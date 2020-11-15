<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;

/**
 * Class     PackageManifest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PackageManifest
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    public $files;

    /**
     * The base path.
     *
     * @var string
     */
    public $basePath;

    /**
     * The vendor path.
     *
     * @var string
     */
    public $vendorPath;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create a new package manifest instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  string                             $basePath
     */
    public function __construct(Filesystem $files, string $basePath)
    {
        $this->files = $files;
        $this->basePath = $basePath;
        $this->vendorPath = "{$basePath}/vendor";
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get installed packages.
     *
     * @return \Illuminate\Support\Collection
     */
    public function installed(): Collection
    {
        $packages = [];

        if ($this->files->exists($path = $this->vendorPath.'/composer/installed.json')) {
            $installed = json_decode($this->files->get($path), true); // Transform the installed packages into an entity or class

            $packages = $installed['packages'] ?? $installed;
        }

        return Collection::make($packages);
    }
}
