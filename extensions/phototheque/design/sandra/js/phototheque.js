$(document).ready(function(){

    $(".previ").each( function()
    {
        var rNum = ( Math.random() * 8 ) - 2;
        $(this).css(
        {
            '-webkit-transform': 'rotate('+rNum+'2deg)',
            '-moz-transform': 'rotate('+rNum+'2deg)'  
        });
    });

});
