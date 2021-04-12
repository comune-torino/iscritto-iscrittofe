jQuery(document).ready(function($) {
	$('#back-to-top').click(function(){
		jQuery("html, body").animate({scrollTop: 0}, 500);
		return false;
	});

// migration affix boostrap 4
  var toggleAffix = function(affixElement, scrollElement, wrapper) {
    var height = affixElement.outerHeight(),
        top = wrapper.offset().top;
    if (scrollElement.scrollTop() >= top){
        wrapper.height(height);
        affixElement.addClass("affix");
				affixElement.parent().parent().addClass("affix-body");
				affixElement.parent().parent().children(".back-to-top").addClass("affix-top");
    }
    else {
        affixElement.removeClass("affix");
        wrapper.height('auto');
				affixElement.parent().parent().removeClass("affix-body");
				affixElement.parent().parent().children(".back-to-top").removeClass("affix-top");
    }
  };
  $('[data-toggle="affix"]').each(function() {
    var ele = $(this),
        wrapper = $('<div></div>');
    ele.before(wrapper);
    $(window).on('scroll resize', function() {
        toggleAffix(ele, $(this), wrapper);
    });
    toggleAffix(ele, $(window), wrapper);
  });
});
