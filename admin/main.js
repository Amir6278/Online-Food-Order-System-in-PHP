$(document).ready(function() {


    $(".mybtn").click(function() {

        $(".sidebar").toggle();
        //  $(".fa-align-justify").toggle();
        $(".mybtn").toggleClass("mx-5");


    });




    $('.sidelink').click(function(e) {


        $(e).addClass('active');
    });

    // $('.sidebar > li').removeClass('active');

});