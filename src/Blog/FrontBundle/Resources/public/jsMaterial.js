$(document).ready(function () {
    $(".button-collapse").sideNav();
    $('.modal-trigger').leanModal({
        dismissible: true, // Modal can be dismissed by clicking outside of the modal
        opacity: .5, // Opacity of modal background
        in_duration: 300, // Transition in duration
        out_duration: 200, // Transition out duration
        ready: function () {
            //alert('Ready');
        }, // Callback for Modal open
        complete: function () {
            //alert('Closed');
        } // Callback for Modal close
    });
    $('.slider').slider({full_width: true});
    $('select').material_select();
    $('.carousel').carousel();
    $('.parallax').parallax();
    $('.tooltipped').tooltip({delay: 50});
});

$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
});

$('.btn_flow-toggle').click(function () {
    console.log("clicked");
    if ($('.showFlow').hasClass('flow-text'))
        $('.showFlow').removeClass('flow-text');
    else {
        $('.showFlow').addClass('flow-text');
    }

});

