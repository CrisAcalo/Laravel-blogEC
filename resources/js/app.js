import './bootstrap';

import Alpine from 'alpinejs';
import 'flowbite';

window.Alpine = Alpine;

Alpine.start();


/* Aside Mobile toggle */

// Array.from(document.getElementsByClassName('mobile-aside-button')).forEach(el => {
//     el.addEventListener('click', e => {
//         const dropdownIcon = e.currentTarget
//             .getElementsByClassName('icon')[0]
//             .getElementsByClassName('mdi')[0]

//         document.documentElement.classList.toggle('aside-mobile-expanded')
//         dropdownIcon.classList.toggle('mdi-forwardburger')
//         dropdownIcon.classList.toggle('mdi-backburger')
//     })
// })
