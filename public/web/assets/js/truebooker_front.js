jQuery(document).ready(function(){
setTimeout(function tba_user_insert_data() {
      jQuery( ".tba-popconfirm" ).hide();
    }, 4000);
    
});
jQuery(document).ready(function () {
        jQuery('#datepicker').datepicker({
            format: 'dd-mm-yyyy',
            startDate: '+1d',
            defaultDate: -1,
            minDate:'0',
            beforeShowDay: function(date) {
        var day = date.getDay();
        return [(day != 0), ''];
    }
        });

    jQuery("#timepicker").timepicker({
    timeFormat: "h:mm", 
    interval: 30, 
    minTime: "01",
    maxTime: "23:55pm", 
    startTime: "01:00", 
    dynamic: true, 
    dropdown: true, 
    scrollbar: false 
  });

jQuery(".truebooker-form #truebooker_user_phone").intlTelInput({
    initialCountry: "in",
    separateDialCode: true
});

    });

function myReset() {
  var form = document.querySelector('form');
  form.reset();
}
jQuery(document).ready(function(){
    jQuery(".iti__selected-flag").addClass("tbaphonecode");
    jQuery('.iti__selected-flag').on('DOMSubtreeModified', function(){
     var phone_code = jQuery('.iti__selected-dial-code').text();
        document.getElementById("truebooker_user_phonecode").value = phone_code;
    });
});

jQuery(document).on("click",".tba-close",function() {
    jQuery(".tba-mask-wrap").fadeOut(300);
});