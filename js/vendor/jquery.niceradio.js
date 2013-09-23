(function($)
{
    $.fn.niceRadio = function()
    {
        this.each(function(index, element)
        {
            var $element = $(element);
            if(!$element.is(':radio'))
            {
                return;
            }
            $element.css({
                'position': 'absolute',
                'left': '-9999px'
            });
            var replacement = $('<span class="e-radio-replacement" />');
            replacement.data('radio-name', $element.attr('name'));
            var checkedClass = 'e-radio-replacement_checked';
            if($element.is(':checked'))
            {
                replacement.addClass(checkedClass);
            }
            $element.change(function(e)
            {
                $('.e-radio-replacement').each(function(index, replacement)
                {
                    var $replacement = $(replacement);
                    var $element = $replacement.prev();
                    $replacement.toggleClass(checkedClass, $element.is(':checked'));
                });
            });
            $element.after(replacement);
            replacement.click(function(e)
            {
                $element.click();
                $element.blur();
            });
        });
    };
})(jQuery);