<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Tests\Unit\Fortify\Rules;

use Arcanesoft\Foundation\Fortify\Rules\Password as Password;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\ValidationServiceProvider;
use Illuminate\Validation\Validator;
use PHPUnit\Framework\TestCase;

/**
 * Class     PasswordTest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PasswordTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    protected function setUp(): void
    {
        $container = Container::getInstance();

        $container->bind('translator', function () {
            return new Translator(
                new ArrayLoader, 'en'
            );
        });

        Facade::setFacadeApplication($container);

        (new ValidationServiceProvider($container))->register();
    }

    protected function tearDown(): void
    {
        Container::setInstance(null);

        Facade::clearResolvedInstances();

        Facade::setFacadeApplication(null);
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_must_validate_password_with_default(): void
    {
        $rule = Password::make();

        static::fails($rule, [null], [
            'validation.required',
        ]);

        static::fails($rule, [true], [
            'validation.string',
            'validation.min.string',
        ]);

        static::fails($rule, ['secret'], [
            'validation.min.string',
        ]);

        static::passes($rule, ['password']);
    }

    /** @test */
    public function it_must_validate_password_with_a_min_length(): void
    {
        static::fails(new Password(8), ['a', 'ff', '12'], [
            'validation.min.string',
        ]);

        static::fails(Password::min(3), ['a', 'ff', '12'], [
            'validation.min.string',
        ]);

        static::passes(Password::min(3), ['333', 'abcd']);
        static::passes(new Password(8), ['88888888']);
    }

    /** @test */
    public function it_requires_using_mixed_cases(): void
    {
        $rules = Password::min(2)->mixedCase();

        static::fails($rules, ['nn', 'MM'], [
            'The my password must contain at least one uppercase and one lowercase letter.',
        ]);

        static::passes($rules, ['Nn', 'Mn', 'âA']);
    }

    /** @test */
    public function it_requires_using_letters(): void
    {
        $rule = Password::min(2)->letters();

        static::fails($rule, ['11', '22', '^^', '``', '**'], [
            'The my password must contain at least one letter.',
        ]);

        static::passes($rule, ['1a', 'b2', 'â1', '1 京都府']);
    }

    /** @test */
    public function it_requires_using_numbers(): void
    {
        $rule = Password::min(2)->numbers();

        static::fails($rule, ['aa', 'bb', '  a', '京都府'], [
            'The my password must contain at least one number.',
        ]);

        static::passes($rule, ['1a', 'b2', '00', '京都府 1']);
    }

    /** @test */
    public function it_requires_using_symbols(): void
    {
        $rule = Password::min(2)->symbols();

        static::fails($rule, ['ab', '1v'], [
            'The my password must contain at least one symbol.',
        ]);

        static::passes($rule, ['n^d', 'd^!', 'âè$', '金廿土弓竹中；']);
    }

    /** @test */
    public function it_can_check_if_password_was_uncompromised(): void
    {
        static::fails(Password::min(2)->uncompromised(), [
            '123456',
            'password',
            'welcome',
            'ninja',
            'abc123',
            '123456789',
            '12345678',
            'nuno',
        ], [
            'The given my password has appeared in a data leak. Please choose a different my password.',
        ]);

        static::passes(Password::min(2)->uncompromised(9999999), [
            'nuno',
        ]);

        static::passes(Password::min(2)->uncompromised(), [
            '手田日尸Ｚ難金木水口火女月土廿卜竹弓一十山',
            '!p8VrB',
            '&xe6VeKWF#n4',
            '%HurHUnw7zM!',
            'rundeliekend',
            '7Z^k5EvqQ9g%c!Jt9$ufnNpQy#Kf',
            'NRs*Gz2@hSmB$vVBSPDfqbRtEzk4nF7ZAbM29VMW$BPD%b2U%3VmJAcrY5eZGVxP%z%apnwSX',
        ]);
    }

    /** @test */
    public function it_can_order_messages(): void
    {
        $makeRule = function () {
            return Password::min(8)->mixedCase()->numbers();
        };

        static::fails($makeRule(), [null], [
            'validation.required',
        ]);

        static::fails($makeRule(), ['foo', 'azdazd', '1231231'], [
            'validation.min.string',
        ]);

        static::fails($makeRule(), ['4564654564564'], [
            'The my password must contain at least one uppercase and one lowercase letter.',
        ]);

        static::fails($makeRule(), ['aaaaaaaaa', 'TJQSJQSIUQHS'], [
            'The my password must contain at least one uppercase and one lowercase letter.',
            'The my password must contain at least one number.',
        ]);

        static::passes($makeRule(), ['4564654564564Abc']);

        $makeRule = function () {
            return ['nullable', 'confirmed', Password::min(8)->letters()->symbols()->uncompromised()];
        };

        static::passes($makeRule(), [null]);

        static::fails($makeRule(), ['foo', 'azdazd', '1231231'], [
            'validation.min.string',
        ]);

        static::fails($makeRule(), ['aaaaaaaaa', 'TJQSJQSIUQHS'], [
            'The my password must contain at least one symbol.',
        ]);

        static::fails($makeRule(), ['4564654564564'], [
            'The my password must contain at least one letter.',
            'The my password must contain at least one symbol.',
        ]);

        static::fails($makeRule(), ['abcabcabc!'], [
            'The given my password has appeared in a data leak. Please choose a different my password.',
        ]);

        $v = static::makeValidator(
            ['my_password' => 'Nuno'],
            ['my_password' => ['nullable', 'confirmed', Password::min(3)->letters()]]
        );

        static::assertFalse($v->passes());

        static::assertSame(
            ['my_password' => ['validation.confirmed']],
            $v->messages()->toArray()
        );
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * @param  mixed  $rules
     * @param  array  $values
     */
    protected static function passes($rules, array $values): void
    {
        static::testValidationRules($rules, $values, true, []);
    }

    /**
     * @param  mixed  $rules
     * @param  array  $values
     * @param  array  $messages
     */
    protected static function fails($rules, array $values, array $messages): void
    {
        static::testValidationRules($rules, $values, false, $messages);
    }

    /**
     * @param  mixed  $rules
     * @param  array  $values
     * @param  bool   $result
     * @param  array  $messages
     */
    protected static function testValidationRules($rules, array $values, bool $result, array $messages): void
    {
        foreach ($values as $value) {
            $v = static::makeValidator(
                ['my_password' => $value, 'my_password_confirmation' => $value],
                ['my_password' => is_object($rules) ? (clone $rules)->rules() : $rules]
            );

            static::assertSame($result, $v->passes());

            static::assertSame(
                $result ? [] : ['my_password' => $messages],
                $v->messages()->toArray()
            );
        }
    }

    /**
     * @param  array  $data
     * @param  array  $rules
     *
     * @return \Illuminate\Validation\Validator
     */
    private static function makeValidator(array $data, array $rules): Validator
    {
        return new Validator(resolve('translator'), $data, $rules);
    }
}
