<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Services\TwoFactorAuthentication;

use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\Fill;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

/**
 * Class     QrCode
 *
 * @package  Arcanesoft\Foundation\Fortify\Services\TwoFactorAuthentication
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class QrCode
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * @param  string  $content
     *
     * @return string
     */
    public function svg(string $content): string
    {
        $fill     = Fill::uniformColor(new Rgb(255, 255, 255), new Rgb(45, 55, 72));
        $renderer = new ImageRenderer(
            new RendererStyle(192, 0, null, null, $fill),
            new SvgImageBackEnd
        );

        return (new Writer($renderer))->writeString($content);
    }
}
