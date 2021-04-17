<?php

namespace App\Color;

use App\Config\Colors;
use SSNepenthe\ColorUtils\Colors\Color;
use function SSNepenthe\ColorUtils\color;
use function SSNepenthe\ColorUtils\rgb;

class ColorUtilities
{
    /**
     * Generate random Color
     * @return Color
     */
    public static function randomColor(): Color
    {
        $color = [];

        for ($i = 0; $i < 4; $i++) {
            $color[$i] = dechex(rand(0, 255));
            if (strlen($color[$i]) === 1) {
                $color[$i] = '0' . $color[$i];
            }
        }
        return color('#' . implode('', $color));
    }

    /**
     * Checks if a keyword matches a color
     * @param string $keyword
     * @return bool
     */
    public static function keywordExists(string $keyword): bool
    {
        return in_array($keyword, Colors::KEYWORDS);
    }

    /**
     * Get black or white depending on a color to have the best contrast
     * @param array $hex
     * @param int $brightnessScale
     * @return Color
     */
    public static function contrastedColor(array $hex, int $brightnessScale = 150): Color
    {
        $r = hexdec($hex['red']);
        $g = hexdec($hex['green']);
        $b = hexdec($hex['blue']);
        $brightness = sqrt(
        //        pow($r, 2) * .299 +
        //        pow($g, 2) * .587 +
        //        pow($b, 2) * .114
            pow($r, 2) * .241 +
            pow($g, 2) * .691 +
            pow($b, 2) * .068
        );

        if ($brightness < $brightnessScale) {
            return color('#FFFFFF');
        } else {
            return color('#000000');
        }
    }

    /**
     * Remove the alpha component from a color
     * @param array $hex
     * @return Color
     */
    public static function withoutAlpha(array $hex): Color
    {
        if (isset($hex['alpha'])) {
            unset($hex['alpha']);
        }
        return color('#' . implode('', $hex));
    }
}
