<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Tests\Unit\Fortify\Rules;

use Arcanesoft\Foundation\Fortify\Rules\Password;
use Arcanesoft\Foundation\Tests\TestCase;

/**
 * Class     PasswordTest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PasswordTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_must_validate_password_with_default()
    {
        $rule = new Password;

        static::assertFalse($rule->passes('password', 'secret'));
        static::assertSame('must be at least 8 characters', $rule->message());

        static::assertTrue($rule->passes('password', 'password'));
    }

    /** @test */
    public function it_must_validate_password_with_a_min_length()
    {
        $rule = (new Password)->length(10);

        static::assertFalse($rule->passes('password', 'password'));
        static::assertSame('must be at least 10 characters', $rule->message());

        static::assertTrue($rule->passes('password', 'password11'));
    }

    /** @test */
    public function it_must_validate_password_at_least_one_uppercase_character()
    {
        $rule = (new Password)->requireUppercase();

        static::assertFalse($rule->passes('password', 'password'));
        static::assertSame('characters and contain at least one uppercase character', $rule->message());

        static::assertTrue($rule->passes('password', 'Password'));
    }

    /** @test */
    public function it_must_validate_password_with_at_least_one_number()
    {
        $rule = (new Password)->requireNumeric();

        static::assertFalse($rule->passes('password', 'Password'));
        static::assertSame('characters and contain at least one uppercase character and one number', $rule->message());

        static::assertTrue($rule->passes('password', 'Password1'));
    }

    /** @test */
    public function it_must_validate_a_password_with_a_required_special_character()
    {
        $rule = (new Password)->requireSpecialCharacter();

        static::assertFalse($rule->passes('password', 'password'));
        static::assertSame('special character', $rule->message());

        static::assertTrue($rule->passes('password', 'pa$$word'));
    }
}
