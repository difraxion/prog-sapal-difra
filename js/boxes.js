function init() {
  $('#overlay').click(function() { closeDialog(); })
}

function openDialog(element) {
    $('#overlay').css('height', $(document.body).height() + 'px');
    $('#overlay').show();
    $('#dialog').html($(element).html());
    centerMe('#dialog');
    $('#dialog').show();
}

function closeDialog() {
    $('#overlay').hide();
    $('#dialog').hide().html('');
}

function centerMe(element) {
    var pWidth = $(window).width();
    var pTop = $(window).scrollTop();
    var eWidth = $(element).width();
    var height = $(element).height();
    $(element).css('top', '130px');
    $(element).css('left', parseInt((pWidth / 2) - (eWidth / 2)) + 'px');
}