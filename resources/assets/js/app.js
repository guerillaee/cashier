
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    // el: '#app'
});



var cashSelect = $("#cash_type"),
nonCashSelect  = $("#noncash_type");

$(document).ready(function(){
  nonCashSelect.attr('disabled', true);

  $('#expense_operation').on('click', () => {
    disable_cash();
  });
  $('#add_operation').on('click', () => {
    disable_noncash();
  });
});

function disable_cash() {
    cashSelect.attr('disabled', true);
    nonCashSelect.attr('disabled', false);
}
function disable_noncash() {
  cashSelect.attr('disabled', false);
  nonCashSelect.attr('disabled', true);
}
