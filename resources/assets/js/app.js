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


// TODO: make jquery function to HOVER [hey user] button
$(document).ready(function(){
    $('button.dropdown').hover(function(e){
        $(this).toggleClass('is-open');
    });
});

// TODO: Fetch AJAX to send more comments counter.
$(document).ready(function () {
    $('nav.level>div.level-left>a.level-item').click(function (e) {
       $.ajax({
            url: '{{ url("posts.create") }}',
            method: 'POST',
            data: {
                comment_count: $('{{comment_count}}').val() +1
            },
           success: function (result) {
               console.log(result);
           }
       });
    });
});

require('./manage')