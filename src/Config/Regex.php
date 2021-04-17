<?php


namespace App\Config;


class Regex
{
    /*
     * Constantes Regex des formats de couleurs passés dans l'URL
     */
    public const NB_0_TO_100 = '([1-9][0-9]?|100)';
    public const NB_0_TO_255 = '([1-9]?[0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])';
    public const OPACITY = '((0?\.\d{1,2})|([01]))';

    public const HEX = '[0-9a-f]{3,4}|[0-9a-f]{6}|[0-9a-f]{8}';

    public const RGB = '(' . self::NB_0_TO_255 . ')(,' . self::NB_0_TO_255 . '){2}';
    public const RGBA = self::RGB . '(,' . self::OPACITY . ')';

    public const HSL = '(' . self::NB_0_TO_255 . ')(,' . self::NB_0_TO_100 . '){2}';
    public const HSLA = self::RGB . '(,' . self::OPACITY . ')';

    public const KEYWORD = '[a-z]+';

    public const EVERYTHING_ELSE = '.*';
}