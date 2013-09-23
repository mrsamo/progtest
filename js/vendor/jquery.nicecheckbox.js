(function($)
{
	$.fn.niceCheckbox = function()
	{
		this.each(function(index, element)
		{
			var $element = $(element);
			if(!$element.is(':checkbox'))
			{
				return;
			}
			$element.css({
				'position': 'absolute',
				'left': '-9999px'
			});
			var replacement = $('<span class="e-checkbox-replacement" />');
            var checkedClass = 'e-checkbox-replacement_checked';
			if($element.is(':checked'))
			{
				replacement.addClass(checkedClass);
			}
			$element.change(function(e)
			{
				if($element.is(':checked'))
				{
					replacement.addClass(checkedClass);
				}
				else
				{
					replacement.removeClass(checkedClass);
				}
			});
			$element.after(replacement);
			replacement.click(function(e)
			{
				e.preventDefault();
				e.stopPropagation();
				$element.attr('checked', !$element.is(':checked'));
				replacement.toggleClass(checkedClass);
			});
		});
	};
})(jQuery);