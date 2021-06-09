require('./bootstrap');
require('alpinejs');

document.querySelector('#type').addEventListener('change', function (e) {
    if (e.target.value === 'select') {
        document.querySelector('#options').style.display = 'block';
        document.querySelector('#multiple-choice-info').style.display = 'block';
    } else {
        document.querySelector('#options').style.display = 'none';
        document.querySelector('#multiple-choice-info').style.display = 'none';
    }
});

window.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('#type').value === 'select') {
        document.querySelector('#options').style.display = 'block';
        document.querySelector('#multiple-choice-info').style.display = 'block';
    } else {
        document.querySelector('#options').style.display = 'none';
        document.querySelector('#multiple-choice-info').style.display = 'none';
    }
});
