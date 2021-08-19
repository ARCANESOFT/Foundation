<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Tests\Feature\Authentication;

use Arcanesoft\Foundation\Authentication\Guard;
use Arcanesoft\Foundation\Authentication\Http\Routes\LoginRoutes;
use Arcanesoft\Foundation\Core\Http\Routes\Web\DashboardRoutes;
use Arcanesoft\Foundation\Tests\Concerns\Factories\CanCreateAdministrators;
use Arcanesoft\Foundation\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;

/**
 * Class     LoginTest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LoginTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use CanCreateAdministrators;
    use RefreshDatabase;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    protected $guard = Guard::WEB_ADMINISTRATOR;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrations();

        $this->app->instance('path.public', __DIR__.'/../../fixtures/public');
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_access_login_form(): void
    {
        $this->get(static::loginCreateUrl())
             ->assertSuccessful()
             ->assertViewIs('foundation::authentication.login');
    }

    /** @test */
    public function it_must_hide_login_form_when_administrator_is_authenticated(): void
    {
        $admin = static::createAdministrator();

        $this->actingAs($admin, $this->guard)
             ->get(static::loginCreateUrl())
             ->assertRedirect(url('home'));

        $this->assertAuthenticatedAs($admin);
    }

    /** @test */
    public function it_can_authenticate(): void
    {
        $admin = static::createAdministrator();

        $this->from(static::loginCreateUrl())
             ->post(static::loginStoreUrl(), [
                 'email'    => $admin->email,
                 'password' => 'password',
             ])
             ->assertRedirect(static::adminDashboardUrl());

        $this->assertAuthenticatedAsAdmin($admin);
    }

    /** @test */
    public function it_can_authenticate_with_remember_me_functionality(): void
    {
        $admin = static::createAdministrator();

        $resp = $this
            ->from(static::loginCreateUrl())
            ->post(static::loginStoreUrl(), [
                'email'    => $admin->email,
                'password' => 'password',
                'remember' => 'on',
            ])
            ->assertRedirect(static::adminDashboardUrl());

        $admin = $admin->fresh();

        $this->assertHasRememberMeCookie($resp, $admin);

        $this->assertAuthenticatedAsAdmin($admin);
    }

    /** @test */
    public function it_cannot_let_administrator_login_with_incorrect_email(): void
    {
        $resp = $this
            ->from(static::loginCreateUrl())
            ->post(static::loginStoreUrl(), [
                'email'    => 'nobody@example.com',
                'password' => 'invalid-password',
            ])
            ->assertRedirect(static::loginCreateUrl())
            ->assertSessionHasErrors('email')
            ->assertSessionHasInput('email', 'nobody@example.com');

        static::assertFalse($resp->getSession()->hasOldInput('password'));
        $this->assertGuest($this->guard);
    }

    /** @test */
    public function it_cannot_let_administrator_login_with_incorrect_password(): void
    {
        $admin = static::createAdministrator();

        $resp = $this
            ->from(static::loginCreateUrl())
            ->post(static::loginStoreUrl(), [
                'email'    => $admin->email,
                'password' => 'invalid-password',
            ])
            ->assertRedirect(static::loginStoreUrl())
            ->assertSessionHasErrors('email')
            ->assertSessionHasInput('email', $admin->email);

        static::assertFalse($resp->getSession()->hasOldInput('password'));
        $this->assertGuest($this->guard);
    }

    /** @test */
    public function it_can_logout(): void
    {
        $admin = static::createAdministrator();

        $this->actingAs($admin, $this->guard)
             ->assertAuthenticatedAs($admin);

        $this->delete(static::logoutUrl())
             ->assertRedirect(static::indexPageUrl());

        $this->assertGuest($this->guard);
    }

    /** @test */
    public function it_can_logout_as_json_request(): void
    {
        $admin = static::createAdministrator();

        $this->actingAs($admin, $this->guard)
            ->assertAuthenticatedAs($admin);

        $this->deleteJson(static::logoutUrl())
             ->assertSuccessful()
             ->assertExactJson([
                 'success' => 'Successfully logged out of application',
             ]);

        $this->assertGuest($this->guard);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Assert the given user is authenticated as admin.
     *
     * @param  mixed  $user
     */
    protected function assertAuthenticatedAsAdmin($user): void
    {
        $this->assertAuthenticatedAs($user, $this->guard);
    }

    /**
     * Assert has remember me cookie.
     *
     * @param  \Illuminate\Testing\TestResponse        $resp
     * @param  \Illuminate\Foundation\Auth\User|mixed  $user
     */
    protected function assertHasRememberMeCookie(TestResponse $resp, $user)
    {
        $name = $this->app->make('auth')->guard($this->guard)->getRecallerName();

        $resp->assertCookie($name, vsprintf('%s|%s|%s', [
            $user->getKey(),
            $user->getRememberToken(),
            $user->getAuthPassword(),
        ]));
    }

    /**
     * Get the index page URL.
     *
     * @return string
     */
    protected static function indexPageUrl(): string
    {
        return route('public::index');
    }

    /**
     * Get the admin dashboard url.
     *
     * @return string
     */
    protected static function adminDashboardUrl(): string
    {
        return route(DashboardRoutes::INDEX);
    }

    /**
     * Get the login form url.
     *
     * @return string
     */
    protected static function loginCreateUrl(): string
    {
        return route(LoginRoutes::LOGIN_CREATE);
    }

    /**
     * Get the login post url.
     *
     * @return string
     */
    protected static function loginStoreUrl(): string
    {
        return route(LoginRoutes::LOGIN_STORE);
    }

    /**
     * Get the logout url.
     *
     * @return string
     */
    protected static function logoutUrl(): string
    {
        return route(LoginRoutes::LOGOUT);
    }
}
