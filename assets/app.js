import './styles/app.css';

import Filter from './modules/Filter';
new Filter(document.querySelector('.js-filter'));
 
console.log('app.js fonctionne !'); 
import noUiSlider from 'nouislider';
import 'nouislider/dist/nouislider.css';



var priceSlider = document.getElementById('price-slider');
var kmsSlider = document.getElementById('kms-slider');
var yearSlider = document.getElementById('year-slider');
// console.log('priceslider :' + priceSlider);

if (priceSlider) {
    const minPrice = document.getElementById('minPrice');
    const maxPrice = document.getElementById('maxPrice');
    // console.log('prix min : ' + priceSlider.dataset.minPrice);
    const range = noUiSlider.create(priceSlider, {
        start: [minPrice.value || 1000 , maxPrice.value || 10000],
        connect: true,
        step: 200,
        range: {
         /*    'min': parseInt(priceSlider.dataset.minPrice, 10),
            'max': parseInt(priceSlider.dataset.maxPrice, 10)  */
            /* 'min': priceSlider.dataset.minPrice,
            'max': priceSlider.dataset.maxPrice */
            'min': 1000,
            'max': 10000
        } 
    }); 
  
    range.on('slide', function (values, handle) {
        if (handle === 0) {
            minPrice.value = Math.round(values[0])
        }
        if (handle === 1) {
            maxPrice.value = Math.round(values[1])
        }

    })
 
    range.on('end', function (value, handle) {
        minPrice.dispatchEvent(new Event('change'))
    }) 
}

if (kmsSlider) {
    const minKms = document.getElementById('minKms');
    const maxKms = document.getElementById('maxKms');
    const range = noUiSlider.create(kmsSlider, {
        start: [minKms.value || 10000 , maxKms.value || 500000],
        connect: true,
        step: 200,
        range: {
            'min': 10000,
            'max': 500000
        }
    }); 
  
    range.on('slide', function (values, handle) {
        if (handle === 0) {
            minKms.value = Math.round(values[0])
        }
        if (handle === 1) {
            maxKms.value = Math.round(values[1])
        }

    })
    range.on('end', function (value, handle) {
        minKms.dispatchEvent(new Event('change'))
    }) 
}

if (yearSlider) {
    const minYear = document.getElementById('minYear');
    const maxYear = document.getElementById('maxYear');
    const range = noUiSlider.create(yearSlider, {
        start: [minYear.value || 1970 , maxYear.value || 2023],
        connect: true,
        step: 1,
        range: {
            'min': 1970,
            'max': 2023
        }
    }); 
  
    range.on('slide', function (values, handle) {
        if (handle === 0) {
            minYear.value = Math.round(values[0])
        }
        if (handle === 1) {
            maxYear.value = Math.round(values[1])
        }

    })

    range.on('end', function (value, handle) {
        minYear.dispatchEvent(new Event('change'))
    }) 
}