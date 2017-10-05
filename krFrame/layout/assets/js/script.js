jQuery(document).ready(function($) {
    var $krClick = $('#widgets-right'),
        toShow = $('.krFrameWidgetsOptions'),
        $close = $('.krFrameWidgetsClose');

    $krClick.on('click','.krFrameWidgetsHeader', function(){
        $(this).siblings(toShow).toggleClass('active');
    });
    $krClick.on('click','.krFrameWidgetsButtonClose, .krFrameWidgetsClose', function(){
        $(this).parent().parent().parent().toggleClass('active');
    });

    $krClick.on('click','.krOpenTab .krSubTitle',function() {
        $(this).siblings('.krShowTab').toggleClass('active');
    });
});

jQuery(document).ready(function($) {
    var $click = $('.krPosition .krTop').find('i');

    $click.click(function(event) {
        $click.parent().siblings().removeClass('active');
        $(this).parent().siblings().toggleClass('active');
    });
});
