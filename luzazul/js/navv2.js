$(document).ready(main)
$(document).ready(esconder)
var contador = 1;

function main(){
    $('.menubar').click(function(){
        //$('nav').toggle();
        if(contador == 1){
            $('nav').animate({
                left: '0'
            });
            contador = 0
        }else{
            $('nav').animate({
                left: '-100%'
            });
            contador = 1
        }
    });
}
function esconder(){
    $('section').click(function(){
        $('nav').animate({
            left: '-100%'
        });
        contador = 1;
    });
}
