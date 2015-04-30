var setupAds = function(isMobile) {
    $('.refined-ad').each(function() {
        var type = $(this).data('type');
        var adWidth = 320;
        var adHtml = '';
        if (type === 'header') {
            if (isMobile) {
                adHtml = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><!-- RTM Mobile --><ins class="adsbygoogle" style="display:inline-block;width:320px;height:50px" data-ad-client="ca-pub-3142110604181885" data-ad-slot="8553396931"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>';
                adWidth = 320;
            } else {
                adHtml = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><!-- RTM BOTTOM 2 --><ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-3142110604181885" data-ad-slot="2477804133"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>';
                adWidth = 728;
            }
        } else if (type === 'in-post') {
            adHtml = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><!-- RTM Text Ads --><ins class="adsbygoogle" style="display:inline-block;width:300px;height:250px" data-ad-client="ca-pub-3142110604181885" data-ad-slot="4997528132"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>';
            adWidth = 300;
        } else if (type === 'sidebar') {
            adHtml = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><!-- RTM Text Ads --><ins class="adsbygoogle" style="display:inline-block;width:300px;height:250px" data-ad-client="ca-pub-3142110604181885" data-ad-slot="4997528132"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>';
            adWidth = 300;
        }
        $(this).width(adWidth);
        $(this).html(adHtml);
    });
    // (adsbygoogle = window.adsbygoogle || []).push({});
};

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
    setupAds(false);
};

var setupForMobileView = function() {
    // move sidebar to right side (after main content in DOM)
    $('.main').after($('.sidebar').remove());
    setupAds(true);
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