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
require('./assets/support_css');

if (!SupportsCSS('display', 'flex')) {
    document.location.replace('/support_browser');
}
