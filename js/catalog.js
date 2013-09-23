$(document).ready(function() {
    /*
     * Init slider
     */
    $('.b-filter-slider-element').each(function(index, element) {
        var $slider = $(element);
        var $min = $slider.next();
        var $max = $min.next();
        $slider.slider({
            range: true,
            min: $min.data('min'),
            max: $max.data('max'),
            step: 10,
            values: [$min.val(), $max.val()],
            slide: function(event, ui) {
                $min.val(ui.values[0]);
                $max.val(ui.values[1]);
            }
        });
    });

    $('input[name=filter_price_1]').keyup(function(event) {
        var reg_number = /[^0-9]/g;
        var $val_1 = $(this).val();
        var $val_1_min = parseInt($(this).data('min'));
        var $val_2 = parseInt($(this).next().val(), 10);
        var $slider = $('.b-filter-slider-element');

        $val_1 = $val_1.replace(reg_number, '');
        $val_1 = parseInt($val_1, 10);
        if ($val_1 > 0)
        {
            if ($val_1 >= $val_2)
            {
                $(this).val($val_2 - 1);
                $slider.slider('values', 0, $val_2 - 1);
            }
            else if ($val_1 < $val_1_min)
            {
                $(this).val($val_1_min);
                $slider.slider('values', 0, $val_1_min);
            }
            else
            {
                $(this).val($val_1);
                $slider.slider('values', 0, $val_1);
            }
        }
        else
        {
            $(this).val($val_1_min);
        }
    });
    $('input[name=filter_price_2]').keyup(function(event) {
        var reg_number = /[^0-9]/g;
        var $val_1 = parseInt($(this).prev().val(), 10);
        var $val_2 = $(this).val();
        var $val_2_max = parseInt($(this).data('max'));
        var $slider = $('.b-filter-slider-element');

        $val_2 = $val_2.replace(reg_number, '');
        $val_2 = parseInt($val_2, 10);
        if ($val_2 > 0)
        {
            if ($val_2 <= $val_1)
            {
                $(this).val($val_1 + 1)
                $slider.slider('values', 1, $val_1 + 1);
            }
            else if ($val_2 > $val_2_max)
            {
                $(this).val($val_2_max);
                $slider.slider('values', 1, $val_2_max);
            }
            else
            {
                $(this).val($val_2);
                $slider.slider('values', 1, $val_2);
            }
        }
        else
        {
            $(this).val($val_2_max);
        }
    });

    /*
     * Only integer content input
     */
    $('.js-integer').keyup(function(event) {
        var reg_number = /[^0-9]/g;
        $(this).val($(this).val().replace(reg_number, ''));
    });

    /*
     * Catalog filter tabs
     */
    $('.b-tabbed-head-item').on('click', function(e) {
        e.preventDefault();

        var $self = $(this);
        var $container = $self.closest('.b-tabbed');
        var $parent = $self.parent();
        var selectedClass = 'b-tabbed-head-item_active';
        $parent.children().removeClass(selectedClass);
        $container.find('.b-tabbed-pages-item').hide();
        $($self.attr('href')).show();
        $self.addClass(selectedClass);
    });

    /*
     * Filter form submit 
     */
    $('.b-filter').submit(function(event) {
        event.preventDefault();

        var $self = $(this);
        var $url = '';
        var $city_elem = $self.find('#filter-city');
        var $rooms_elem = $self.find('#filter-rooms');
        var $floor_compare_elem = $self.find('#filter-floor-compare');
        var $floor_elem = $self.find('#filter-floor');
        var $floors_1_elem = $self.find('#filter-floors-1');
        var $floors_2_elem = $self.find('#filter-floors-2');
        var $price_1_elem = $self.find('#filter-price-1');
        var $price_2_elem = $self.find('#filter-price-2');
        var $square_1_elem = $self.find('#filter-square-1');
        var $square_2_elem = $self.find('#filter-square-2');
        var $square_2_elem = $self.find('#filter-square-2');
        var $cat_id = $('.b-tabbed-head-item.b-tabbed-head-item_active').data('cat-id');

        // add catalog id        
        $url += '/catalog/' + $cat_id;

        // add city
        if ($city_elem.val() !== '')
            $url += '/city/' + Base64.encode($city_elem.val());

        // add rooms
        if ($rooms_elem.val() !== '')
            $url += '/rooms/' + $rooms_elem.val();

        // add floor
        console.log($floor_elem);
        if ($floor_elem.length && $floor_elem.val() !== '')
            $url += '/floor/' + $floor_compare_elem.val() + '_' + $floor_elem.val();

        // add floors
        if ($floors_1_elem.length && $floors_2_elem.length && ($floors_1_elem.val() !== '' || $floors_2_elem.val() !== ''))
            $url += '/floors/' + $floors_1_elem.val() + '_' + $floors_2_elem.val();

        // add prices
        if ($price_1_elem.val() !== '' || $price_2_elem.val() !== '')
            $url += '/price/' + $price_1_elem.val() + '_' + $price_2_elem.val();

        // add squares
        if ($square_1_elem.val() !== '' || $square_2_elem.val() !== '')
            $url += '/square/' + $square_1_elem.val() + '_' + $square_2_elem.val();

        document.location.href = $url;
//        console.log($url);
    });

});

/*
 * Functionencodes data with MIME base64
 */
var Base64 = {
    // private property
    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
    // public method for encoding
    encode: function(input) {
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0;

        input = Base64._utf8_encode(input);

        while (i < input.length) {

            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);

            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;

            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }

            output = output +
                    this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
                    this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

        }

        return output;
    },
    // public method for decoding
    decode: function(input) {
        var output = "";
        var chr1, chr2, chr3;
        var enc1, enc2, enc3, enc4;
        var i = 0;

        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

        while (i < input.length) {

            enc1 = this._keyStr.indexOf(input.charAt(i++));
            enc2 = this._keyStr.indexOf(input.charAt(i++));
            enc3 = this._keyStr.indexOf(input.charAt(i++));
            enc4 = this._keyStr.indexOf(input.charAt(i++));

            chr1 = (enc1 << 2) | (enc2 >> 4);
            chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
            chr3 = ((enc3 & 3) << 6) | enc4;

            output = output + String.fromCharCode(chr1);

            if (enc3 != 64) {
                output = output + String.fromCharCode(chr2);
            }
            if (enc4 != 64) {
                output = output + String.fromCharCode(chr3);
            }

        }

        output = Base64._utf8_decode(output);

        return output;

    },
    // private method for UTF-8 encoding
    _utf8_encode: function(string) {
        string = string.replace(/\r\n/g, "\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {

            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if ((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
    },
    // private method for UTF-8 decoding
    _utf8_decode: function(utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;

        while (i < utftext.length) {

            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            }
            else if ((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i + 1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            }
            else {
                c2 = utftext.charCodeAt(i + 1);
                c3 = utftext.charCodeAt(i + 2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }

        }

        return string;
    }

}