<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Helpers\UI\Actions;

use Arcanedev\Html\Elements\{Button as BaseButton, I};
use Arcanesoft\Foundation\Helpers\UI\Actions\Concerns\{HasConfig, HasTooltip};
use Illuminate\Support\Arr;

/**
 * Class     ButtonAction
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ButtonAction extends BaseButton
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasTooltip,
        HasConfig;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * @param  string  $name
     * @param  bool    $withText
     *
     * @return \Arcanesoft\Foundation\Helpers\UI\Actions\ButtonAction|mixed
     */
    public static function action(string $name, bool $withText = true)
    {
        $action = static::getActionConfig($name);
        $icon   = $action['icon'] ? I::make()->class($action['icon'])->toHtml() : '';
        $text   = __($action['text']);

        return static::make()->class($action['class'])
            ->html($withText ? $icon.' '.$text : $icon)
            ->unless($withText, function (ButtonAction $link) use ($text) {
                return $link->tooltip($text);
            });
    }

    /**
     * Set the size.
     *
     * @param  string  $size
     *
     * @return \Arcanesoft\Foundation\Helpers\UI\Actions\ButtonAction
     */
    public function size(string $size)
    {
        $sizes = [
            'xs' => 'btn-xs',
            'sm' => 'btn-sm',
            'md' => '',
            'lg' => 'btn-sm',
            'xl' => 'btn-xl',
        ];

        return $this->pushClass(Arr::get($sizes, $size, ''));
    }

    /**
     * Set the disabled state.
     *
     * @param  bool  $disabled
     *
     * @return $this
     */
    public function setDisabled(bool $disabled)
    {
        if ( ! $disabled)
            return $this;

        return $this->attribute('disabled')->class('btn btn-sm btn-outline-secondary');
    }
}
