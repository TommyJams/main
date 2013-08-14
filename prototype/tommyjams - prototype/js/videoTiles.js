function initMonthWidget() {
	$("#monthWidgetContainer").hide();

	$("#monthWidgetBox").mouseover(function(){
		$("#monthWidgetContainer").fadeIn("500");
	});
	
	$("#monthWidgetContainer").mouseleave(function() {
		$("#monthWidgetContainer").fadeOut("500");
	});
	
	$("#monthWidgetContainer ul li").click(function() {
		listIndex = $(this).index() + 1;
		if(listIndex<10)
			innerPhplink = 'include/videoTiles.php?month=0'+listIndex;
		else
			innerPhplink = 'include/videoTiles.php?month='+listIndex;
		
		$("#loading-indicator").show();
		$("#videoTilesContainer").load(innerPhplink);
	});
}

function initCaptions() {
	$(".imageBoxCaption").mouseover(function(){
		$(this).next().animate({top: "50%"}, 200);
	});
	$(".imageDetails").mouseleave(function(){
		$(this).animate({top: "100%"}, 200);
	});
}

function initFancyBox() {
$('.fancybox-audio-mixcloud').bind('click',function() 
	{
		$.fancybox(
		{
			'padding'		: 10,
			'autoScale'		: false,
			'transitionIn'	: 'none',
			'transitionOut'	: 'none',
			'width'			: '80%',
			'height'		: '35%',
			'href'			: this.href,
			'type'			: 'iframe'
		});

		return false;
	});
}