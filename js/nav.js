$("#btn-nav").click(function () {
    $('#side').removeClass('hide');
    $('#side').addClass('show');
});

$("#btn-fecha").click(function () {
    $('#side').removeClass('show');
    $('#side').addClass('hide');
});

// $("#sub-menu").click(function(){
//     $('.sub-menu').css('display', 'block')
// })
function menuFecha(){
    $('#side').removeClass('show');
    $('#side').addClass('hide');
}