<?php


namespace App;

use App\Color\ColorUtilities;
use SSNepenthe\ColorUtils\Colors\Color;
use function SSNepenthe\ColorUtils\grayscale;
use function SSNepenthe\ColorUtils\invert;

class JsonResponse
{
    /**
     * Display the JSON
     * @param Color $color
     */
    public static function displayJSON(Color $color):void{
        $jsonResponse = self::getArray($color);
        header('Content-Type: application/json');
        echo json_encode($jsonResponse, JSON_PRETTY_PRINT);
    }

    /**
     * Return the full array to return the JSON
     * @param Color $color
     * @return array
     */
    public static function getArray(Color $color): array
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

    /**
     * Returns all color formats
     * @param Color $color
     * @return array
     */
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

    /**
     * Returns the color in HEX format
     * @param Color $color
     * @return array
     */
    private static function hex(Color $color): array
    {
        $value = $color->getRgb()->toHexString();
        $composition = $color->getRgb()->toHexArray();

        return self::colorJson($value, $composition);
    }

    /**
     * Returns the color in RGB/RGBA format
     * @param Color $color
     * @return array
     */
    private static function rgb(Color $color): array
    {
        $value = $color->getRgb()->toString();
        $composition = $color->getRgb()->toArray();

        return self::colorJson($value, $composition);
    }

    /**
     * Returns the color in HSL/HSLA format
     * @param Color $color
     * @return array
     */
    private static function hsl(Color $color): array
    {
        $value = self::hslRoundedString($color->getHsl()->toArray());
        $composition = $color->getHsl()->toArray();

        return self::colorJson($value, $composition, true);
    }

    /**
     * Returns the color in HSL format with rounded values
     * @param array $hsl
     * @return string
     */
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

    /**
     * Returns the color in HSL format without rounding values
     * @param Color $color
     * @return array
     */
    private static function hslRaw(Color $color): array
    {
        $value = $color->getHsl()->toString();
        $composition = $color->getHsl()->toArray();

        return self::colorJson($value, $composition);
    }

    /**
     * Returns the value and composition of a color
     * @param string $value
     * @param array $composition
     * @param bool $rounded
     * @return array
     */
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
}
