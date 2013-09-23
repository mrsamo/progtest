$(document).ready(function()
{
    /*
     * Front promo block
     */
    (function()
    {
        var $serviceCarousels = $('.b-slider');
        $serviceCarousels.each(function(index, element)
        {
            var $serviceCarousel = $(element);
            var $serviceClip = $serviceCarousel.find('.b-slider-clip');
            var $serviceItems = $serviceCarousel.find('.b-slider-items');
            var $servicePrev = $serviceCarousel.find('.b-slider-action_prev');
            var $serviceNext = $serviceCarousel.find('.b-slider-action_next');
            var serviceOffset = 291;
            $servicePrev.on('click', function(e)
            {
                e.preventDefault();

                var currentOffset = $serviceItems.position().left;
                var targetOffset = 0;
                if (currentOffset + serviceOffset >= 0)
                {
                    targetOffset = 0;
                }
                else
                {
                    targetOffset = currentOffset + serviceOffset;
                }
                $serviceItems.animate({
                    'left': targetOffset + 'px'
                });
            });
            $serviceNext.on('click', function(e)
            {
                e.preventDefault();

                var currentOffset = $serviceItems.position().left;
                var targetOffset = currentOffset - serviceOffset;
                var hiddenPartWidth = $serviceItems.outerWidth() - $serviceClip.width();
                if (hiddenPartWidth < -targetOffset)
                {
                    targetOffset = -hiddenPartWidth;
                }

                $serviceItems.animate({
                    'left': targetOffset + 'px'
                });
            });
        });
    })();

    $('.b-promo-menu-items-item').on('click', function(e)
    {
        e.preventDefault();

        var $self = $(this);
        var $container = $self.closest('.b-promo');
        var $parent = $self.parent();
        var selectedClass = 'b-promo-menu-items-item_active';
        var $promoActionButton = $('#promo-menu-action');
        $parent.children().removeClass(selectedClass);
        $container.find('.b-promo-pages-item').hide();
        $($self.attr('href')).show();
        $self.addClass(selectedClass);
        $promoActionButton.attr('href', '/catalog/' + $self.data('scope'));
    });

    /*
     * Forms elements stylize
     */
    $('.e-nice-checkbox').niceCheckbox();
    $('.e-nice-radio').niceRadio();
    $('select').selectBox();
    $('[placeholder]').placeholder();

    /*
     * Formms popup
     */
    var showPopup = function(selector)
    {
        var $popup = $(selector);
        if ($popup.length == 1)
        {
            $popup
                    .show()
                    .css({
                'margin-top': -$popup.outerHeight() / 2 + 'px',
                'margin-left': -$popup.outerWidth() / 2 + 'px'
            });
            $('#overlay')
                    .show();
        }
    };
    $('.e-popup-trigger').on('click', function(e)
    {
        e.preventDefault();

        var popupId = $(this).attr('href');
        showPopup(popupId);
    });
    $('#overlay, .b-popup-close').on('click', function(e)
    {
        e.preventDefault();
        $form = $('.b-popup:visible').find('form');
        $('.b-popup').hide();
        $('#overlay').hide();
        clear_form($form);
    });

    // find all images in content and replace it on cool border image
    $('.b-text-block img').each(function() {
        $(this).wrap('<figure class="float-left"></figure>');
        // add float
        if ($(this).attr('align') == 'right' || $(this).css('float') == 'right')
            $(this).parent().addClass('float-right');
        else
            $(this).parent().addClass('float-left');
    });

    // change content tabs in product cart
    $('.b-object-desc-head-link').click(function(event) {
        event.preventDefault();

        if (!$(this).hasClass('b-object-desc-head-link_active'))
        {
            $('.b-object-desc-head-link').removeClass('b-object-desc-head-link_active');
            $(this).addClass('b-object-desc-head-link_active');
            $content = $('#' + $(this).data('content-id'));
            $('.b-object-desc-content').hide();
            $content.fadeIn(300);
        }
    });

});

// function for clear form
function clear_form($form)
{
    $form.trigger('reset');
    $form.find('label.form-validate-error').remove();
    $form.find('input.form-validate-error').removeClass('.form-validate-error');

    // checkboxes
    $form.find('input[type="checkbox"]').removeAttr('checked');
    $form.find('.e-checkbox-replacement_checked').removeClass('e-checkbox-replacement_checked');

    // selectboxes
    $('.b-form-select_reqbuysell').selectBox('value', '');
    $('.b-form-select_reqviewer').selectBox('value', '');

    qaptcha_generate();
}

// function qaptcha generate
function qaptcha_generate()
{
    $('.qaptcha').empty();
    $('.qaptcha').QapTcha({
        txtLock: 'Переместите ползунок слева направо',
        txtUnlock: 'Форма успешно разблокирована',
        disabledSubmit: false,
        autoRevert: true,
        PHPfile: '/feedback/ajax/qaptcha'
    });
}