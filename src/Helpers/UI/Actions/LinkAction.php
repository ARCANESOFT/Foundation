<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Helpers\UI\Actions;

use Arcanedev\Html\Elements\{A, I};
use Arcanesoft\Foundation\Helpers\UI\Actions\Concerns\{HasConfig, HasTooltip};
use Illuminate\Support\Arr;

/**
 * Class     LinkAction
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LinkAction extends A
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
     * @param  string  $url
     * @param  bool    $withText
     *
     * @return \Arcanesoft\Foundation\Helpers\UI\Actions\LinkAction
     */
    public static function action(string $name, string $url = '#', bool $withText = true)
    {
        $action = static::getActionConfig($name);
        $icon   = $action['icon'] ? I::make()->class($action['icon'])->toHtml() : '';
        $text   = __($action['text']);

        return static::make()->href($url)->class($action['class'])
            ->html($withText ? $icon.' '.$text : $icon)
            ->unless($withText, function (LinkAction $link) use ($text) {
                return $link->tooltip($text);
            });
    }

    /**
     * Set the size.
     *
     * @param  string  $size
     *
     * @return \Arcanesoft\Foundation\Helpers\UI\Actions\LinkAction
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
        return $this->if($disabled, function (LinkAction $link) {
            return $link->href('#')
                ->class('btn btn-sm btn-outline-secondary disabled');
        });
    }
}
