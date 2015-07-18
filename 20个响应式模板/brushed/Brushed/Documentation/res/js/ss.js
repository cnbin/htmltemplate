var SS = window.SS || {};

SS.slideClose = function(){
	$("#activity-home").removeClass("normal").addClass("collapsed");
	$("#right-panel").addClass("open");
	$("#slide-toggle span").removeClass("arrow-slide-left").addClass("arrow-slide-right");
}

SS.slideOpen = function(){
	$("#activity-home").removeClass("collapsed").addClass("normal");
	$("#right-panel").removeClass("open");
	$("#slide-toggle span").removeClass("arrow-slide-right").addClass("arrow-slide-left");
}

SS.panel = function(){
	$("#slide-toggle").click(function(){
		
		if ($('#activity-home').hasClass("collapsed")) {
            SS.slideOpen();
        }
		
        else if ($('#activity-home').hasClass("normal")) {
            SS.slideClose();
        }
		
		return false
	});
}

SS.navigation = function(){
	$('.box-post').hide();
	$('.box-post').eq(0).show();
	$('nav#menu ul li').eq(0).addClass('active');

	$("nav#menu ul li a").live('click', function(){
		$target = $($(this).attr('href'));
		$('nav#menu ul li').removeClass('active');
		$(this).parent('li').addClass('active');
		
		$('.box-post').hide();
		$target.fadeIn(400);
	

		if ($('#activity-home').hasClass("collapsed")) {
			SS.slideOpen();
		}
		return false;
	});
	
	$("nav#menu ul li").live('click', function(){
		$(this).find('a').click();	
	});
}

SS.scrollCustomizeBar = function(){
	$(".panel-content").mCustomScrollbar({
		scrollAmount:400,
		scrollInertia:100, 
		scrollEasing:"easeOutCirc", 
		mouseWheel:"auto",

		advanced:{
			updateOnBrowserResize:true, 
			updateOnContentResize:true, 
			autoExpandHorizontalScroll:false 
		}
	});
}

SS.init = function(){
	this.navigation();
	this.panel();
	this.scrollCustomizeBar();
	this.syntax();
}

$(function(){
	SS.init();
});

	SyntaxHighlighter.all()

