$(document).ready(function () {
    $(".slider-container").hover(function () {
            $('.nav')
            .css("display", "flex")
            .hide()
            .fadeIn(1000);
            $(".navigation-btns")
            .css("display", "flex")
            .hide()
            .fadeIn(1000);
            $('.captions-container').animate(
                {
                    "bottom": "60px"
                }, 1000
            );
        }, function () {
            $('.nav').fadeOut(1000);
            $(".navigation-btns").fadeOut(1000);
            $('.captions-container').animate(
                {
                    "bottom": "0px"
                }, 1500
            );
        }
    );    
});

var slides = $('.slider-images').children();
var dots = $(".navigation-btns").children();

var currentIndex = 0;
slideIt(0);

$('#arrow-next').click(
    function(){
        if(currentIndex+1==slides.length)
            currentIndex = 0;
        else
            currentIndex++;
        slideIt(currentIndex);
    }
);

$('#arrow-prev').click(
    function(){
        if(currentIndex==0)
            currentIndex = slides.length-1;
        else
            currentIndex--;
        slideIt(currentIndex);
    }
);

function slideIt(n) { 
    currentIndex=n;
    for (i = 0; i < dots.length; i++) {
        $('#slide-dots-'+i).removeClass("slides-button-active");
    }
    $('#slide-dots-'+n).addClass("slides-button-active");
    for (i = 0; i < slides.length; i++) {
        $('#slide-'+i).css("display", "none");
    }
    $('#slide-'+n).fadeIn("slow");
    $('#caption-container').text($('#slide-'+n).data("caption"));
}

function autoSlide(slideTimeInterval) {
    setInterval(
        function(){
             $("#arrow-next").trigger("click");
         }, 
    slideTimeInterval);
}

