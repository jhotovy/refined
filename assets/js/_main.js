var setupForNonMobileView = function() {
    $('.card-sidebar').imagesLoaded(function() {
        $('.card-sidebar, .card-main').each(function() {
            var sidebarHeight = Math.max($('.card-sidebar').height(), $('.card-main').height());
            if (sidebarHeight > $(this).height())
            {
                $(this).height(sidebarHeight);
            }
        });
    });

    var middleCardHeight = Math.max($('#front-page-videos').height(), $('#bbpress-front-page').height());
    $('#front-page-videos').height(middleCardHeight);
    $('#bbpress-front-page').height(middleCardHeight);
};

var setupForMobileView = function() {
    // move sidebar to right side (after main content in DOM)
    $('.main').after($('.sidebar').remove());
};

$(document).ready(function() {
    $('.wp-menu').lavalamp({
        setOnClick: true,
    });
    $('#buddypress #item-nav ul').first().lavalamp({
        setOnClick: true,
        activeObj: '.selected',
    });
    $('.navbar-nav .dropdown').find('.dropdown-toggle')
        .removeClass('.dropdown-toggle')
        .removeAttr('data-toggle')
        .removeAttr('data-target');
    $('.navbar-nav .dropdown').hover(function() {
        $(this).find('.dropdown-menu').show();
    }, function() {
        $(this).find('.dropdown-menu').hide();
    });
    $('.navbar-nav .dropdown :not(#menu-about)').click(function() {
        $(this).find('.dropdown-menu').hide();
    });

    $(".refined-image-overlay").hover(function() {
        $(this).fadeTo(300, 0.33);
    }, function() {
        $(this).fadeTo(300, 0.0);
    });
    $('.refined-user-quote a').hover(function() {
        $(this).addClass('hover');
        $(this).find('.quote').addClass('hover');
    }, function() {
        $(this).removeClass('hover');
        $(this).find('.quote').removeClass('hover');
    });

    $('input[id=mce-EMAIL]').each(function() {
        $(this).attr('placeholder', $(this).attr('value')).removeAttr('value');
    });

    $('.masonry-container').each(function() {
        var container = $(this);
        container.imagesLoaded(function() {
            container.masonry({
                itemSelector: '.masonry-item',
                gutter: 15
            });
        });
    });

    $('.refined-video-container').fitVids();
    $('#bbpress-front-page .bbp-body ul').slice(10).remove();
    
    // 768 = @screen-sm-mid
    if ($(window).width() < 768) {
        setupForMobileView();
    } else {
        setupForNonMobileView();
    }
});