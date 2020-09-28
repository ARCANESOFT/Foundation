<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views;

use Arcanesoft\Foundation\Support\Providers\ServiceProvider;
use Arcanesoft\Foundation\Views\Contracts\Manager as ManagerContract;
use Illuminate\View\Compilers\BladeCompiler;
use Arcanesoft\Foundation\Views\Components;

/**
 * Class     ViewsServiceProvider
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ViewsServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Package name.
     *
     * @var string|null
     */
    protected $package = 'components';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        parent::register();

        $this->singleton(ManagerContract::class, Manager::class);
    }

    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        $this->registerBladeComponents();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register blade components.
     */
    private function registerBladeComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade) {
            $blade->components([
                // Form
                'arc:form'             => Components\Forms\Form::class,

                // Form Inputs
                'arc:password'         => Components\Forms\Inputs\Password::class,

                // Form Controls
                'arc:checkbox-control' => Components\Forms\Controls\Checkbox::class,
                'arc:input-control'    => Components\Forms\Controls\Input::class,
                'arc:password-control' => Components\Forms\Controls\Password::class,

                // Support
                'arc:card'             => Components\Support\Cards\Card::class,
                'arc:card-header'      => Components\Support\Cards\Header::class,
                'arc:card-body'        => Components\Support\Cards\Body::class,
                'arc:card-footer'      => Components\Support\Cards\Footer::class,
            ]);
        });
    }
}
