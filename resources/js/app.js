/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./assets/header');
require('./assets/anchor');
require('./assets/switch');
require('./assets/message');
require('./assets/select');
require('./assets/mask');
require('./assets/specialty');
require('./assets/jquery.cookie');
require('./assets/support_css');
require('./assets/form');

// if (!SupportsCSS('display', 'flex')) {
//    document.location.replace('/support_browser');
//}

$(function() {
    if(!$.cookie('cookie_apply')) $('#cookie').fadeIn(200);
    $('#cookie .button').on('click', function() {
        $.cookie('cookie_apply', true);
        $('#cookie').fadeOut(200);
    });
});
