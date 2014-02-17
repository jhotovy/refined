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

    $('.masonry-container').each(function() {
        var container = $(this);
        container.imagesLoaded(function() {
            container.masonry({
                itemSelector: '.masonry-item',
                gutter: 15
            });
        });
    });

    var sidebarHeight = Math.max($('.card-sidebar').height(), $('.card-main').height());
    if (sidebarHeight > $('.card-sidebar').height())
    {
		$('.card-sidebar').height(sidebarHeight);
    }

    var middleCardHeight = Math.max($('#front-page-videos').height(), $('#bbpress-front-page').height());
    $('#front-page-videos').height(middleCardHeight);
    $('#bbpress-front-page').height(middleCardHeight);
});