$(document).ready(function()
{
	var myDiv = document.getElementById("slider");
	var sliderHeight = myDiv.clientHeight;	
	var sliderWidth = myDiv.clientWidth;
	//alert(sliderWidth);
	
	var slider = new Slider($('#slider'));
	slider.setSize(sliderWidth, 400);
	slider.fetchJson('../../include/modules/getPhotos.php');
	slider.setTransitionDuration(3000);
	slider.setTransition('transition-zoomin');
	
	$('.orbit-bullets').hide();
	$('.orbit-slide-number').remove();
	$('.orbit-timer').hide();
	$('.orbit-prev').hide();
	$('.orbit-next').hide();
	
});