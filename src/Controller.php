<?php

namespace App;

use App\Color\ColorUtilities;
use function SSNepenthe\ColorUtils\color;
use function SSNepenthe\ColorUtils\hsl;
use function SSNepenthe\ColorUtils\hsla;
use function SSNepenthe\ColorUtils\rgb;
use function SSNepenthe\ColorUtils\rgba;

class Controller
{
    /**
     * Home
     */
    public function home()
    {
        $randomColor = ColorUtilities::randomColor();
        $response = JsonResponse::getArray($randomColor);
        $json = json_encode($response, JSON_PRETTY_PRINT);
        require 'views/home.php';
    }

    /**
     * Convert a color passed to keyword format
     * @param string $colorValue
     */
    public function keyword(string $colorValue)
    {
        if (!ColorUtilities::keywordExists($colorValue)) {
            self::wrongColor('keyword', $colorValue);
        } else {
            $color = color($colorValue);
            JsonResponse::displayJSON($color);
        }
    }

    /**
     * Convert a color passed to HEX format
     * @param string $colorValue
     */
    public function hex(string $colorValue)
    {
        $color = color('#' . $colorValue);
        JsonResponse::displayJSON($color);
    }

    /**
     * Convert a color passed to RGB format
     * @param string $colorValue
     */
    public function rgb(string $colorValue)
    {
        $colorValue = explode(',', $colorValue);
        $color = rgb($colorValue[0], $colorValue[1], $colorValue[2]);
        JsonResponse::displayJSON($color);
    }

    /**
     * Convert a color passed to RGBA format
     * @param string $colorValue
     */
    public function rgba(string $colorValue)
    {
        $colorValue = str_replace(',.', ',0.', $colorValue);
        $colorValue = explode(',', $colorValue);
        $color = rgba($colorValue[0], $colorValue[1], $colorValue[2], $colorValue[3]);
        JsonResponse::displayJSON($color);
    }

    /**
     * Convert a color passed to HSL format
     * @param string $colorValue
     */
    public function hsl(string $colorValue)
    {
        $colorValue = explode(',', $colorValue);
        $color = hsl($colorValue[0], $colorValue[1], $colorValue[2]);
        JsonResponse::displayJSON($color);
    }

    /**
     * Convert a color passed to HSLA format
     * @param string $colorValue
     */
    public function hsla(string $colorValue)
    {
        $colorValue = str_replace(',.', ',0.', $colorValue);
        $colorValue = explode(',', $colorValue);
        $color = hsla($colorValue[0], $colorValue[1], $colorValue[2], $colorValue[3]);
        JsonResponse::displayJSON($color);
    }

    /**
     * Returns a JSON indicating that the color format is not valid
     * @param string $type
     * @param string $color
     */
    public function wrongColor(string $type, string $color)
    {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'error' => [
                'type' => 'wrong color format',
                'value' => $color,
                'message' => 'not a valid ' . strtoupper($type) . ' color'
            ]
        ], JSON_PRETTY_PRINT);
    }

    /**
     * Returns a JSON indicating that the API format is not valid
     * @param string $else
     */
    public function wrongApiFormat(string $else)
    {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'error' => [
                'type' => 'wrong API request',
                'value' => $else,
                'message' => 'not a valid API request'
            ]
        ], JSON_PRETTY_PRINT);
    }

    /**
     * Refers to page 404 (no longer used)
     */
    public function error404()
    {
        require 'views/error404.php';
    }
}
