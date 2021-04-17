let colorDiv = document.getElementById('json-color')
let examplesDiv = document.getElementById('examples')
let change = document.getElementById('change')
let header = document.getElementById('header')
let nav = document.getElementById('nav')


const examplesTextBackground = [
    'base',
    'base_without_alpha',
    'complementary',
    'complementary_without_alpha',
    'grayscale',
    'grayscale_without_alpha',
]
const examplesTextColor = [
    'base_without_alpha_contrasted_text',
    'base_without_alpha_contrasted_text',
    'complementary_without_alpha_contrasted_text',
    'complementary_without_alpha_contrasted_text',
    'grayscale_without_alpha_contrasted_text',
    'grayscale_without_alpha_contrasted_text',
]

if (php_result !== 'error404') {
    colorize(php_result)
    // let myInterval = setInterval(getColors, 2000);

    change.addEventListener('click', () => {
        change.classList.toggle('on')
        if (change.classList.contains('on')) {
            change.innerHTML = 'Stop color change'
            myInterval = setInterval(getColors, 2000);
        } else {
            change.innerHTML = 'Restart color change'
            clearInterval(myInterval)
        }
    })
} else {
    nav.style.backgroundColor = '#FF000088'
}


function getColors()
{
    return fetch('https://racocote.serialif.com/rest')
        .then(response => response.json())
        .then(response => colorize(response))
        .catch(error => console.error('error:', error));
}


function colorize(result)
{
    const baseWithoutAlpha = result['base_without_alpha']['hex']['value']
    const complementaryWithoutAlpha = result['complementary_without_alpha']['hex']['value']

    const baseWithoutAlphaText = result['base_without_alpha_contrasted_text']['hex']['value']
    const complementaryWithoutAlphaText = result['complementary_without_alpha_contrasted_text']['hex']['value']
    
    if (baseWithoutAlphaText === '#000000') {
        header.style.color = complementaryWithoutAlpha
        header.style.backgroundColor = '#eeeeee'

        nav.style.color = baseWithoutAlpha
        nav.style.backgroundColor = '#111111'
    } else {
        header.style.color = baseWithoutAlpha
        header.style.backgroundColor = '#eeeeee'

        nav.style.color = complementaryWithoutAlpha
        nav.style.backgroundColor = '#111111'
    }

    document.getElementById('examples').style.width =
        getComputedStyle(document.getElementById('last-pre')).width

    for (let i = 0; i < examplesDiv.children.length; i++) {
        examplesDiv.children[i].firstElementChild.nextElementSibling.style.backgroundColor =
            result[examplesTextBackground[i]]['hex']['value']
        examplesDiv.children[i].firstElementChild.nextElementSibling.style.color =
            result[examplesTextColor[i]]['hex']['value']
    }
}

