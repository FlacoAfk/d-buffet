$(document).ready(main);
 
var contador = 1;
 
function main () {
	$('.icon-list2').click(function(){
		if (contador == 1) {
			$('nav').animate({
				left: '0'
			});
			contador = 0;
		} else {
			contador = 1;
			$('nav').animate({
				left: '-150%'
			});
		}
	});

	$('.ingre').click(function(){
		contador = 1;
		$('nav').animate({
				left: '-150%'
			});
	});
 
	// Mostramos y ocultamos submenus
	$('.submenu').click(function(){
		$(this).children('.children').slideToggle();
	});
}