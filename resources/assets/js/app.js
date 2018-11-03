require('./bootstrap');

window.Vue = require('vue');
window.Slug = require('slug');
Slug.defaults.mode = 'rfc3986';

import Buefy from 'buefy';

/**
 * These buefy components are " Vue components ", and
 * they can only be used with a " Vue Object ".
 */
Vue.use(Buefy);

Vue.component('slugWidget', require('./components/slugWidget.vue'));
Vue.component('commentCount', require('./components/commentCount.vue'));


// TODO: make jquery function to HOVER [hey user] button
$(document).ready(function(){
    $('button.dropdown').hover(function(e){
        $(this).toggleClass('is-open');
    });
});

require('./manage')