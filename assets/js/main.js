$(function () {
    $('.traveler-paymob-admin .container button').click(function (e) { 
        e.preventDefault();
        $('.traveler-paymob-admin #traveler-paymob-signin').submit();
    });
});