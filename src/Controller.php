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
    public function home()
    {
        $randomColor = ColorUtilities::randomColor();
        $response = JsonResponse::get($randomColor);
        $json = json_encode($response, JSON_PRETTY_PRINT);
        require 'views/home.php';
    }

    public function keyword(string $colorValue)
    {
        if (!ColorUtilities::keywordExists($colorValue)) {
            self::wrongColor('keyword', $colorValue);
        } else {
            $color = color($colorValue);
            $jsonResponse = JsonResponse::get($color);
            header('Content-Type: application/json');
            echo json_encode($jsonResponse, JSON_PRETTY_PRINT);
        }
    }

    public function hex(string $colorValue)
    {
        $color = color('#' . $colorValue);
        $jsonResponse = JsonResponse::get($color);
        header('Content-Type: application/json');
        echo json_encode($jsonResponse, JSON_PRETTY_PRINT);
    }

    public function rgb(string $colorValue)
    {
        $colorValue = explode(',', $colorValue);
        $color = rgb($colorValue[0], $colorValue[1], $colorValue[2]);

        dump($color);
    }

    public function rgba(string $colorValue)
    {
        $colorValue = str_replace(',.', ',0.', $colorValue);
        $colorValue = explode(',', $colorValue);
        $color = rgba($colorValue[0], $colorValue[1], $colorValue[2], $colorValue[3]);

        dump($color);
    }

    public function hsl(string $colorValue)
    {
        $colorValue = explode(',', $colorValue);
        $color = hsl($colorValue[0], $colorValue[1], $colorValue[2]);

        dump($color);
    }

    public function hsla(string $colorValue)
    {
        $colorValue = str_replace(',.', ',0.', $colorValue);
        $colorValue = explode(',', $colorValue);
        $color = hsla($colorValue[0], $colorValue[1], $colorValue[2], $colorValue[3]);

        dump($color);
    }

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

    public function error404()
    {
        require 'views/error404.php';
    }
}
