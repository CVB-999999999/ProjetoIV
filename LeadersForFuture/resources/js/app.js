require('./bootstrap');

import Alpine from 'alpinejs'
import focus from '@alpinejs/focus'
import collapse from '@alpinejs/collapse'

Alpine.plugin(collapse)
Alpine.plugin(focus)

window.Alpine = Alpine

Alpine.start()
