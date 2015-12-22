/**
 * packages from node_modules
 **/
window.$ = window.jQuery = require('jquery');
window.MediumEditor = require('medium-editor');

require('bootstrap/dist/js/bootstrap');
require('lazysizes/lazysizes');

/**
 * project components
 **/
require('./components/compasshb-editor');
require('./components/compasshb-search');
require('./components/compasshb-serviceworker');
