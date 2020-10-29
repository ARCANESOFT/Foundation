<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation;

use Illuminate\Foundation\PackageManifest;
use Illuminate\Support\Collection;

/**
 * Class     ModuleManifest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ModuleManifest extends PackageManifest
{
    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the ARCANESOFT Modules.
     *
     * @return array
     */
    public function modules(): array
    {
        return $this->getManifest();
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Pluck module's config by the given key.
     *
     * @param  string  $key
     *
     * @return array
     */
    public function pluck(string $key): array
    {
        return Collection::make($this->modules())
            ->filter(function ($module) use ($key) {
                return isset($module[$key]);
            })
            ->mapWithKeys(function ($module, $name) use ($key) {
                return [$name => $module[$key]];
            })
            ->toArray();
    }
    /**
     * Build the manifest and write it to disk.
     *
     * @return void
     */
    public function build(): void
    {
        $packages = [];

        if ($this->files->exists($path = $this->vendorPath.'/composer/installed.json')) {
            $installed = json_decode($this->files->get($path), true);

            $packages = $installed['packages'] ?? $installed;
        }

        $ignoreAll = in_array('*', $ignore = $this->packagesToIgnore());

        $this->write(
            Collection::make($packages)
                ->mapWithKeys(function ($package) {
                    return [$this->format($package['name']) => $package['extra']['arcanesoft'] ?? []];
                })
                ->each(function ($configuration) use (&$ignore) {
                    $ignore = array_merge($ignore, $configuration['dont-discover'] ?? []);
                })
                ->reject(function ($configuration, $package) use ($ignore, $ignoreAll) {
                    return $ignoreAll || in_array($package, $ignore);
                })
                ->filter()
                ->all()
        );
    }
}
