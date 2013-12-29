$(document).ready(function() {
    $('.wp-menu').lavalamp({
        setOnClick: true,
    });

    $(".front-post").hover(function() {
        $('#overlay', this).fadeTo(300, 0.33);
    }, function() {
        $('#overlay', this).fadeTo(300, 0.0);
    });

    $('#mce-EMAIL').attr('placeholder', $('#mce-EMAIL').attr('value')).removeAttr('value');
});