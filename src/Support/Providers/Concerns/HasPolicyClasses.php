<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Providers\Concerns;

use Arcanedev\LaravelPolicies\Contracts\PolicyManager;

/**
 * Trait     HasPolicyClasses
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasPolicyClasses
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Policy's classes.
     *
     * @var array
     */
    protected $policyClasses = [];

    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get policy's classes.
     *
     * @return iterable
     */
    public function policyClasses(): iterable
    {
        return $this->policyClasses;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the policy's classes.
     */
    protected function registerPolicyClasses(): void
    {
        $manager = $this->app->make(PolicyManager::class);

        foreach ($this->policyClasses() as $class) {
            $manager->registerClass($class);
        }
    }
}
