<?php


namespace App\Config;

class TableRequests
{
    public const COLOR_TYPE = [
        'KEYWORD' => [
            [
                'row' => 2,
                'type' => 'Keyword',
                'value' => '<span class="request-value">aquamarine</span>',
                'note' => '',
                'request' => '<a href="aquamarine">' .
                    '<span class="muted">https://color.serialif.com/</span>' .
                    '<span class="request-value">aquamarine</span>' .
                    '</a>'
            ],
            [
                'row' => 0,
                'type' => 'Keyword',
                'value' => '<span class="request-value">aquamarine</span>',
                'note' => '',
                'request' => '<a href="keyword=aquamarine">' .
                    '<span class="muted">https://color.serialif.com/</span>' .
                    '<span class="request-type">keyword</span>' .
                    '<span class="request-equals">=</span>' .
                    '<span class="request-value">aquamarine</span>' .
                    '</a>'
            ]
        ],
        'HEX' => [
            [
                'row' => 2,
                'type' => 'HEX',
                'value' => '#<span class="request-value">55667788</span>',
                'note' => 'without #',
                'request' => '<a href="55667788">' .
                    '<span class="muted">https://color.serialif.com/</span>' .
                    '<span class="request-value">55667788</span>' .
                    '</a>'
            ],
            [
                'row' => 0,
                'type' => 'HEX',
                'value' => '#<span class="request-value">55667788</span>',
                'note' => 'without #',
                'request' => '<a href="hex=55667788">' .
                    '<span class="muted">https://color.serialif.com/</span>' .
                    '<span class="request-type">hex</span>' .
                    '<span class="request-equals">=</span>' .
                    '<span class="request-value">55667788</span>' .
                    '</a>'
            ]
        ],
        'RGB' => [
            [
                'row' => 2,
                'type' => 'RGB',
                'value' => 'rgb(<span class="request-value">85,</span> <span class="request-value">102,</span>
                    <span class="request-value">119</span>)',
                'note' => 'without rgb, ( ), or spaces',
                'request' => '<a href="85,102,119">' .
                    '<span class="muted">https://color.serialif.com/</span>' .
                    '<span class="request-value">85,102,119</span>' .
                    '</a>'
            ],
            [
                'row' => 0,
                'type' => 'RGB',
                'value' => 'rgb(<span class="request-value">85,</span> <span class="request-value">102,</span>
                    <span class="request-value">119</span>)',
                'note' => 'without rgb, ( ), or spaces',
                'request' => '<a href="rgb=85,102,119">' .
                    '<span class="muted">https://color.serialif.com/</span>' .
                    '<span class="request-type">rgb</span>' .
                    '<span class="request-equals">=</span>' .
                    '<span class="request-value">85,102,119</span>' .
                    '</a>'
            ]],
        'RGBA' => [
            [
                'row' => 3,
                'type' => 'RGBA',
                'value' => 'rgba(<span class="request-value">85,</span> <span class="request-value">102,</span>
                    <span class="request-value">119,</span> <span class="request-value">0.53</span>)',
                'note' => 'without rgba, ( ), or spaces',
                'request' => '<a href="85,102,119,0.53">' .
                    '<span class="muted">https://color.serialif.com/</span>' .
                    '<span class="request-value">85,102,119,0.53</span>' .
                    '</a>'
            ],
            [
                'row' => 0,
                'type' => 'RGBA',
                'value' => 'rgba(<span class="request-value">85,</span> <span class="request-value">102,</span>
                    <span class="request-value">119,</span> <span class="request-value">0.53</span>)',
                'note' => 'without rgba, ( ), or spaces',
                'request' => '<a href="rgb=85,102,119,0.53">' .
                    '<span class="muted">https://color.serialif.com/</span>' .
                    '<span class="request-type">rgb</span>' .
                    '<span class="request-equals">=</span>' .
                    '<span class="request-value">85,102,119,0.53</span>' .
                    '</a>'
            ],
            [
                'row' => 0,
                'type' => 'RGBA',
                'value' => 'rgba(<span class="request-value">85,</span> <span class="request-value">102,</span>
                    <span class="request-value">119,</span> <span class="request-value">0.53</span>)',
                'note' => 'without rgba, ( ), or spaces',
                'request' => '<a href="rgba=85,102,119,0.53">' .
                    '<span class="muted">https://color.serialif.com/</span>' .
                    '<span class="request-type">rgba</span>' .
                    '<span class="request-equals">=</span>' .
                    '<span class="request-value">85,102,119,0.53</span>' .
                    '</a>'
            ]],
        'HSL' => [
            [
                'row' => 1,
                'type' => 'HSL',
                'value' => 'hsl(<span class="request-value">85,</span> <span class="request-value">102,</span>
                    <span class="request-value">119</span>)',
                'note' => 'without hsl, ( ), or spaces',
                'request' => '<a href="hsl=85,102,119">' .
                    '<span class="muted">https://color.serialif.com/</span>' .
                    '<span class="request-type">hsl</span>' .
                    '<span class="request-equals">=</span>' .
                    '<span class="request-value">85,102,119</span>' .
                    '</a>'
            ]],
        'HSLA' => [
            [
                'row' => 2,
                'type' => 'HSLA',
                'value' => 'hsla(<span class="request-value">85,</span> <span class="request-value">102,</span>
                    <span class="request-value">119,</span> <span class="request-value">0.53</span>)',
                'note' => 'without hsla, ( ), or spaces',
                'request' => '<a href="hsl=85,102,119,0.53">' .
                    '<span class="muted">https://color.serialif.com/</span>' .
                    '<span class="request-type">hsl</span>' .
                    '<span class="request-equals">=</span>' .
                    '<span class="request-value">85,102,119,0.53</span>' .
                    '</a>'
            ],
            [
                'row' => 0,
                'type' => 'HSLA',
                'value' => 'hsla(<span class="request-value">85,</span> <span class="request-value">102,</span>
                    <span class="request-value">119,</span> <span class="request-value">0.53</span>)',
                'note' => 'without hsla, ( ), or spaces',
                'request' => '<a href="hsla=85,102,119,0.53">' .
                    '<span class="muted">https://color.serialif.com/</span>' .
                    '<span class="request-type">hsla</span>' .
                    '<span class="request-equals">=</span>' .
                    '<span class="request-value">85,102,119,0.53</span>' .
                    '</a>'
            ]
        ]
    ];
}
