$(document).ready(function () {


    $("#social-sticky-bar").floatingShare({
        place: "top-right",
        counter: true, 
        buttons: [
        "twitter",
        "linkedin",
        "facebook",
        "google-plus",
        "whatsapp"],
        title: "Gestión System",
        url: "www.gestionsystem.com.co",
        text: "Compartir en ",
        description: $("meta[name='description']").attr("Gestion System un servicio diferente para usted."),
        popup_width: 600,
        popup_height: 600
    });

    var pageTitle = document.title;
    var pageUrl = location.href;

    $('.share-btn-wrp li').click(function (event) {
        var shareName = $(this).attr('class').split(' ')[0];
        switch (shareName)
        {
            case 'facebook':
            OpenShareUrl('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle));
            break;
            case 'twitter':
            OpenShareUrl('http://twitter.com/home?status=' + encodeURIComponent(pageTitle + ' ' + pageUrl));
            break;
            case 'digg':
            OpenShareUrl('http://www.digg.com/submit?phase=2&amp;url=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle));
            break;
            case 'stumbleupon':
            OpenShareUrl('http://www.stumbleupon.com/submit?url=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle));
            break;
            case 'delicious':
            OpenShareUrl('http://del.icio.us/post?url=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle));
            break;
            case 'gplus':
            OpenShareUrl('https://plus.google.com/share?url=' + encodeURIComponent(pageUrl) + '&amp;title=' + encodeURIComponent(pageTitle));
            break;
            case 'email':
            OpenShareUrl('mailto:?subject=' + pageTitle + '&body=Found this useful link for you : ' + pageUrl);
            break;
        }

    });

function OpenShareUrl(openLink) {
    winWidth = 650;
    winHeight = 450;
    winLeft = ($(window).width() - winWidth) / 2,
    winTop = ($(window).height() - winHeight) / 2,
    winOptions = 'width=' + winWidth + ',height=' + winHeight + ',top=' + winTop + ',left=' + winLeft;
    window.open(openLink, 'Compartir este link.', winOptions);
    return false;
};


});