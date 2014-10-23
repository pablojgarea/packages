$(document).ready(function(){
	var maxHeight = 0;

	$(".cuadro-subasta").each(function(){
	   if ($(this).height() > maxHeight) { 
	   		maxHeight = $(this).height() + $(this).find('.listado-enlaces').height(); 
	   }
	});

	$(".cuadro-subasta").height(maxHeight+10);

});