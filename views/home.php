<?php use App\Config\TableRequests;

require 'templates/_header.php' ?>

<?php require 'templates/_nav.php' ?>

<div class="change on" id="change">Stop color change</div>

<div class="container">

    <div class="separation"></div>
    <div class="title section">
        <div class="subTitle">What's this?</div>
        This is an REST API to get a requested color, its complementary and its grayscale in different formats
        and the corresponding black or white text according to their brightness.
    </div>

    <div class="separation"></div>
    <div class="title section">
        <div class="subTitle">Color formats</div>
        <div>Keyword</div>
        <div>HEX</div>
        <div>RGB / RGBA</div>
        <div>HSL / HSLA</div>
    </div>

    <div class="separation" id="anchor-request"></div>
    <div class="json-request section">
        <div class="subTitle">Request</div>
        You can use Keyword, HEX(3,4,6 or 8 characters), RGB or RGBA and HSL or HSLA formats to send your color.
        <div class="json-color" id="json-color">
            <div class="type">
            </div>
            <table>
                <thead>
                <tr>
                    <th class="request-th-type">Type</th>
                    <th class="request-th-value">Example value</th>
                    <th class="request-th-note">Note</th>
                    <th class="request-th-uri">Possible requests</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach (TableRequests::COLOR_TYPE as $nameType => $colorTypes) : ?>
                    <?php foreach ($colorTypes as $colorType) : ?>
                        <tr>
                            <?php if ($colorType['row'] !== 0): ?>
                                <td rowspan="<?= $colorType['row'] ?>"><?= $colorType['type'] ?></td>
                                <td rowspan="<?= $colorType['row'] ?>"><?= $colorType['value'] ?></td>
                                <td rowspan="<?= $colorType['row'] ?>"><?= $colorType['note'] ?></td>
                            <?php endif ?>

                            <td class="request-td-uri"><?= $colorType['request'] ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="separation" id="anchor-colors"></div>
    <div class="return section">
        <div class="subTitle">Returned colors</div>
        <div class="examples" id="examples">
            <div class="examples--base">
                <div>Base (requested)</div>
                <div></div>
            </div>
            <div class="examples--base_without_alpha">
                <div>Base (requested) without alpha</div>
                <div>Contrasted text</div>
            </div>

            <div class="examples--complementary">
                <div>Complementary</div>
                <div></div>
            </div>
            <div class="examples--complementary_without_alpha">
                <div>Complementary without alpha</div>
                <div>Contrasted text</div>
            </div>

            <div class="examples--grayscale">
                <div>Grayscale</div>
                <div></div>
            </div>
            <div class="examples--grayscale_without_alpha">
                <div>Grayscale without alpha</div>
                <div>Contrasted text</div>
            </div>
        </div>
    </div>

    <div class="separation"></div>
    <div class="json-response section">
        <div class="subTitle">Returned colors in JSON</div>
        <div class="json-color" id="json-color">
            <pre>
                <code class="language-json">
                    {
                        "base": {...},
                        "base_without_alpha": {...},
                        "base_without_alpha_contrasted_text": {...},
                        "complementary": {...},
                        "complementary_without_alpha": {...},
                        "complementary_without_alpha_contrasted_text": {...},
                        "grayscale": {...},
                        "grayscale_without_alpha": {...},
                        "grayscale_without_alpha_contrasted_text": {...}
                    }
                </code>
            </pre>
        </div>
    </div>

    <div class="separation" id="anchor-data"></div>
    <div class="json-response section"
    ">
    <div class="subTitle">Data for each color in JSON</div>
    <div class="json-color" id="json-color">
            <pre>
                <code class="language-json">
                    {
                        "keyword": "aquamarine",
                        "hex": {
                            "value": "#7fffd4",
                            "composition": {
                            "red": "7f",
                            "green": "ff",
                            "blue": "d4"
                            }
                        },
                        "rgb": {
                            "value": "rgb(127, 255, 212)",
                            "composition": {
                            "red": 127,
                            "green": 255,
                            "blue": 212
                            }
                        },
                        "hsl": {
                            "value": "hsl(160, 100%, 75%)",
                            "composition": {
                            "hue": 160,
                            "saturation": 100,
                            "lightness": 75
                            }
                        },
                        "hsl_raw": {
                            "value": "hsl(159.84375, 100%, 74.90196%)",
                            "composition": {
                            "hue": 159.84375,
                            "saturation": 100,
                            "lightness": 74.90196
                            }
                        }
                    }
                </code>
            </pre>
    </div>
</div>

<div class="separation" id="anchor-response"></div>
<div class="json-response section">
    <div class="subTitle">Example error API response</div>
    <div class="json-color" id="json-color">
            <pre id="last-pre">
                <code class="language-json">
                {
                    "status": "error",
                    "error": {
                        "type": "wrong color format",
                        "value": "yellou",
                        "message": "not a valid KEYWORD color"
                    }
                }
                </code>
            </pre>
    </div>
</div>

<div class="separation"></div>
<div class="json-response section">
    <div class="subTitle">Example success API response</div>
    <div class="json-color" id="json-color">
            <pre id="last-pre">
                <code class="language-json">
                <?= $json ?>
                </code>
            </pre>
    </div>
</div>

</div>
<div id="bottom"></div>

<script>let php_result = <?= $json ?></script>

<?php require 'templates/_footer.php' ?>


