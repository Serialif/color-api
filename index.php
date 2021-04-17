<?php


use App\Config\Regex;
use App\Router\Router;

require 'vendor/autoload.php';

$router = new Router($_GET['url']);


$router->get('/', 'home');

$router->get('/:color', 'keyword')->with('color', Regex::KEYWORD);
$router->get('/:color', 'hex')->with('color', Regex::HEX);
$router->get('/:color', 'rgb')->with('color', Regex::RGB);
$router->get('/:color', 'rgb')->with('color', Regex::RGBA);

$router->get('/keyword=:color', 'keyword')->with('color', Regex::KEYWORD);

$router->get('/hex=:color', 'hex')->with('color', Regex::HEX);

$router->get('/rgb=:color', 'rgb')->with('color', Regex::RGB);
$router->get('/rgb=:color', 'rgba')->with('color', Regex::RGBA);
$router->get('/rgba=:color', 'rgba')->with('color', Regex::RGBA);

$router->get('/hsl=:color', 'hsl')->with('color', Regex::HSL);
$router->get('/hsl=:color', 'hsla')->with('color', Regex::HSLA);
$router->get('/hsla=:color', 'hsla')->with('color', Regex::HSLA);

$router->get('/:type=:color', 'wrongColor')
    ->with('type','(hex|rgba?|hsla?|keyword)')
    ->with('color', Regex::EVERYTHING_ELSE);

$router->match();