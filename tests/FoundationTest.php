<?php namespace Arcanesoft\Foundation\Tests;

use Arcanesoft\Foundation\Foundation;

/**
 * Class     FoundationTest
 *
 * @package  Arcanesoft\Foundation\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FoundationTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var \Arcanesoft\Foundation\Foundation */
    private $foundation;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->foundation = app('arcanesoft.foundation');
    }

    public function tearDown()
    {
        unset($this->foundation);

        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(Foundation::class, $this->foundation);
    }

    /** @test */
    public function it_can_get_version()
    {
        $version = Foundation::VERSION;

        $this->assertEquals($version, $this->foundation->version());
        $this->assertEquals($version, foundation()->version());
    }
}
