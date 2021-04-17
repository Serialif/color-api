<?php


namespace App;

use App\Color\ColorUtilities;
use SSNepenthe\ColorUtils\Colors\Color;
use function SSNepenthe\ColorUtils\grayscale;
use function SSNepenthe\ColorUtils\invert;

class JsonResponse
{
    public static function get(Color $color): array
    {
        $contrastedText = ColorUtilities::contrastedColor($color->getRgb()->toHexArray());
        $colorWithoutAlpha = ColorUtilities::withoutAlpha($color->getRgb()->toHexArray());

        return [
            'status' => 'success',
            'base' => self::getAllColorFormats($color),
            'base_without_alpha' => self::getAllColorFormats($colorWithoutAlpha),
            'base_without_alpha_contrasted_text' => self::getAllColorFormats($contrastedText),
            'complementary' => self::getAllColorFormats(invert($color)),
            'complementary_without_alpha' => self::getAllColorFormats(invert($colorWithoutAlpha)),
            'complementary_without_alpha_contrasted_text' => self::getAllColorFormats(invert($contrastedText)),
            'grayscale' => self::getAllColorFormats(grayscale($color)),
            'grayscale_without_alpha' => self::getAllColorFormats(grayscale($colorWithoutAlpha)),
            'grayscale_without_alpha_contrasted_text' => self::getAllColorFormats(grayscale($contrastedText))
        ];
    }

    private static function getAllColorFormats(Color $color): array
    {
        $hasAlpha = $color->getRgb()->hasAlpha();
        $rgb = $hasAlpha ? 'rgba' : 'rgb';
        $hsl = $hasAlpha ? 'hsla' : 'hsl';
        return [
            'keyword' => $color->getRgb()->getName(),
            'hex' => self::hex($color),
            $rgb => self::rgb($color),
            $hsl => self::hsl($color),
            $hsl . '_raw' => self::hslRaw($color),
        ];
    }

    private static function hex(Color $color): array
    {
        $value = $color->getRgb()->toHexString();
        $composition = $color->getRgb()->toHexArray();

        return self::colorJson($value, $composition);
    }

    private static function rgb(Color $color): array
    {
        $value = $color->getRgb()->toString();
        $composition = $color->getRgb()->toArray();

        return self::colorJson($value, $composition);
    }

    private static function hsl(Color $color): array
    {
        $value = self::hslRoundedString($color->getHsl()->toArray());
        $composition = $color->getHsl()->toArray();

        return self::colorJson($value, $composition, true);
    }

    private static function hslRaw(Color $color): array
    {
        $value = $color->getHsl()->toString();
        $composition = $color->getHsl()->toArray();

        return self::colorJson($value, $composition);
    }

    private static function colorJson(string $value, array $composition, bool $rounded = false): array
    {
        $compo = [];
        foreach ($composition as $k => $v) {
            if ($rounded) {
                $v = round($v);
            }
            $compo[$k] = $v;
        }

        $return = [
            'value' => $value,
            'composition' =>
                $compo
        ];
        if (isset($composition['alpha'])) {
            $return['composition']['alpha'] = $composition['alpha'];
        }

        return $return;
    }


    private static function hslRoundedString(array $hsl): string
    {
        $type = isset($hsl['alpha']) ? 'hsla' : 'hsl';
        $hsl['hue'] = (string)round($hsl['hue']);
        $hsl['saturation'] = round($hsl['saturation']) . '%';
        $hsl['lightness'] = round($hsl['lightness']) . '%';
        $hsl['alpha'] = isset($hsl['alpha']) ? (string)round($hsl['alpha'], 2) : null;
        if (is_null($hsl['alpha'])) {
            unset($hsl['alpha']);
        }

        return $type . '(' . implode(', ', $hsl) . ')';
    }
}
