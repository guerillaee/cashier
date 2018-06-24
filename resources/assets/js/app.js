
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



var adds = $(".add_operations"),
dispanses  = $(".dispense_operations");

$(document).ready(function(){
  $('.noncash_list').hide();
  dispanses.attr('disabled', true);

  $('#expense_operation').on('click', () => {
    disable_list();
  });
  $('#add_operation').on('click', () => {
    enable_list();
  });

  $('input[name="account_id"]').on('change', () => {
    $('select').val('');

    if($('input[name="account_id"]:checked').val() == 1){
      $('.cash_list').show();
      $('.noncash_list').hide();
    } else {
      $('.noncash_list').show();
      $('.cash_list').hide();
    }
  });

  $('.refund').on('click', function() {
    var data = {};
    data.id = $(this).data('id');
    $('.alert').removeClass('alert-danger');

    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
    });

    $.ajax({
      url: '/transactions/refund',
      type: 'POST',
      data: data,
      dataType: "json",
      success:function(json) {
          if(json['error']){
            $('#notification').addClass('alert-danger').html(json['error']);
          }
          if(json['success']){
            $('#notification').addClass('alert-success').html(json['success']);
            setTimeout(() => {
              location.reload();
            }, 2000);
          }
      }
    });
  });
});

function disable_list() {
    adds.attr('disabled', true);
    dispanses.attr('disabled', false);
}
function enable_list() {
  adds.attr('disabled', false);
  dispanses.attr('disabled', true);
}
