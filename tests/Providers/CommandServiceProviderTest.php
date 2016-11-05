<?php namespace Arcanesoft\Foundation\Tests\Providers;

use Arcanesoft\Foundation\Providers\CommandServiceProvider;
use Arcanesoft\Foundation\Tests\TestCase;

/**
 * Class     CommandServiceProviderTest
 *
 * @package  Arcanesoft\Foundation\Tests\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CommandServiceProviderTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var CommandServiceProvider */
    private $provider;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->provider = $this->app->getProvider(CommandServiceProvider::class);
    }

    public function tearDown()
    {
        unset($this->provider);

        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Illuminate\Support\ServiceProvider::class,
            \Arcanedev\Support\ServiceProvider::class,
            \Arcanesoft\Foundation\Providers\CommandServiceProvider::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->provider);
        }
    }

    /** @test */
    public function it_can_provides()
    {
        $expected = [
            \Arcanesoft\Foundation\Console\PublishCommand::class,
            \Arcanesoft\Foundation\Console\SetupCommand::class,
            \Arcanesoft\Foundation\Console\ClearCommand::class,
        ];

        $this->assertEquals($expected, $this->provider->provides());
    }
}
