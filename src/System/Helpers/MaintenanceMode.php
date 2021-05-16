<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Helpers;

use Illuminate\Foundation\Exceptions\RegisterErrorViewPaths;

/**
 * Class     MaintenanceMode
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MaintenanceMode
{
    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the down file path.
     *
     * @return string
     */
    public function getDownPath(): string
    {
        return storage_path('framework/down');
    }

    /**
     * Get the maintenance file path.
     *
     * @return string
     */
    private function getMaintenancePath(): string
    {
        return storage_path('framework/maintenance.php');
    }

    /**
     * Get the default template.
     *
     * @return string
     */
    public function getDefaultTemplate(): string
    {
        return 'errors.503';
    }

    /**
     * Get the error templates.
     *
     * @return array
     */
    public function getTemplates(): array
    {
        return [
            null         => 'NULL',
            'errors.503' => '503',
            'errors.500' => '500',
            'errors.404' => '404',
        ];
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the down file data.
     *
     * @return array
     */
    public function data(): array
    {
        if ($this->isDisabled())
            return [];

        return json_decode(file_get_contents($this->getDownPath()), true);
    }

    /**
     * Enabled the maintenance mode.
     *
     * @param  string|null  $redirect
     * @param  int|null     $retry
     * @param  string|null  $secret
     * @param  int|null     $status
     * @param  string|null  $template
     */
    public function down(
        ?string $redirect = null,
        ?int $retry = null,
        ?string $secret = null,
        ?int $status = 503,
        ?string $template = null
    ) {
        $payload = [
            'redirect' => $this->redirectPath($redirect),
            'retry'    => $this->getRetryTime($retry),
            'secret'   => $secret,
            'status'   => $status,
            'template' => $this->renderTemplate($template),
        ];

        file_put_contents(
            $this->getDownPath(),
            json_encode($payload, JSON_PRETTY_PRINT)
        );

        file_put_contents(
            $this->getMaintenancePath(),
            file_get_contents(
                base_path('vendor/laravel/framework/src/Illuminate/Foundation/Console/stubs/maintenance-mode.stub')
            )
        );
    }

    /**
     * Render template.
     *
     * @param  string|null  $template
     *
     * @return string|null
     */
    protected function renderTemplate(?string $template): ?string
    {
        if (is_null($template))
            return null;

        (new RegisterErrorViewPaths)();

        return view($template)->render();
    }

    /**
     * Disable the maintenance mode.
     */
    public function up()
    {
        @unlink($this->getDownPath());
        @unlink($this->getMaintenancePath());
    }

    /**
     * @return bool
     */
    public function isDown(): bool
    {
        // TODO: Implement this method
    }

    /**
     * @return bool
     */
    public function isUp(): bool
    {
        return ! $this->isDown();
    }

    /**
     * Check if the maintenance mode is enabled.
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return is_file($this->getDownPath());
    }

    /**
     * Check if the maintenance mode is disabled.
     *
     * @return bool
     */
    public function isDisabled()
    {
        return ! $this->isEnabled();
    }

    /**
     * Get the number of seconds the client should wait before retrying their request.
     *
     * @param  int|string  $retry
     *
     * @return int|null
     */
    protected function getRetryTime($retry)
    {
        if (is_numeric($retry) && $retry > 0)
            return (int) $retry;

        return null;
    }

    /**
     * Get the path that users should be redirected to.
     *
     * @param  string|null  $redirect
     *
     * @return string|null
     */
    protected function redirectPath(?string $redirect)
    {
        if ($redirect && $redirect !== '/')
            return '/'.trim($redirect, '/');

        return $redirect;
    }
}
