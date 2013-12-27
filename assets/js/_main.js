$(document).ready(function() {
    $(".front-post").hover(function() {
        $("#overlay", this).fadeTo(300, 0.33);
    }, function() {
        $("#overlay", this).fadeTo(300, 0.0);
    });
});