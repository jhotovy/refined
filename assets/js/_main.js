$(document).ready(function() {
    $('.wp-menu').lavalamp({
        setOnClick: true,
    });

    $(".refined-image-overlay").hover(function() {
        $(this).fadeTo(300, 0.33);
    }, function() {
        $(this).fadeTo(300, 0.0);
    });

    $('#mce-EMAIL').attr('placeholder', $('#mce-EMAIL').attr('value')).removeAttr('value');

    var sidebarHeight = Math.max($('.card-sidebar').height(), $('.card-main').height());
    if (sidebarHeight > $('.card-sidebar').height())
    {
		$('.card-sidebar').height(sidebarHeight);
    }
});