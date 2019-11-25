$(".desc").mouseover(function(){
    $('.desc').removeClass("bounceInLeft");
    $(".desc").addClass("animated tada");
})
$(".cor").mouseover(function(){
    $('.cor').removeClass("bounceInUp");
    $(".cor").addClass("animated tada");
})
$(".nor").mouseover(function(){
    $('.nor').removeClass("bounceInUp");
    $(".nor").addClass("animated tada");
})
$(".uni").mouseover(function(){
    $('.uni').removeClass("bounceInUp");
    $(".uni").addClass("animated tada");
})
$(".bin").mouseover(function(){
    $('.bin').removeClass("bounceInRight");
    $(".bin").addClass("animated tada");
})

$(".desc").mouseout(function(){
    $(".desc").removeClass("animated tada");
})
$(".cor").mouseout(function(){
    $(".cor").removeClass("animated tada");
})
$(".nor").mouseout(function(){
    $(".nor").removeClass("animated tada");
})
$(".uni").mouseout(function(){
    $(".uni").removeClass("animated tada");
})
$(".bin").mouseout(function(){;
    $(".bin").removeClass("animated tada");
})

$(".ver").mouseover(function(){
    $(".ver").addClass("animated pulse");
})

$(".ver").mouseout(function(){
    $(".ver").removeClass("animated pulse");
})