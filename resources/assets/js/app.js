require('./bootstrap');

window.Vue = require('vue');
import Buefy from 'buefy';

/**
 * These buefy components are " Vue components ", and
 * they can only be used with a " Vue Object ".
 */
Vue.use(Buefy);


// TODO: make jquery function to HOVER [hey user] button
$(document).ready(function(){
    $('button.dropdown').hover(function(e){
        $(this).toggleClass('is-open');
    });
});

require('./manage')