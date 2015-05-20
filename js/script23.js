$.noConflict();
jQuery(document).ready(function ($) {
    function cookiesEnabled() {
        return $.cookie('check', 'valid', { expires: 1 }) && $.cookie('check') == 'valid';
    }

    if (!cookiesEnabled()) {
        $('#cookies_message').show();
    }

    numeral.language('fi', {
        delimiters: {
            thousands: '',
            decimal: '.'
        },
        abbreviations: {
            thousand: 't.',
            million: 'milj.',
            billion: 'mrd.',
            trillion: 'trilj.'
        },
        ordinal: function (number) {
            return '';
        },
        currency: {
            symbol: '€'
        }
    });

    numeral.language('fi');

    $('#main_table').calx();
    change_delivery_prices_to_line();

    $('#tile_selection a').click(function () {
        $('#colour_selection ul').hide();
        $('#tile_selection ul').toggle();
    });

    $('#colour_selection a').click(function () {
        $('#tile_selection ul').hide();
        $('#colour_selection ul').toggle();
    });

    $('.dropdown li a').click(function () {
        $('body').css('cursor', 'progress');
        var html = $(this).html();
        var text = $(this).text();
        var parent = $(this).closest('.dropdown');
        if (parent.attr('id') == 'tile_selection') {
           parent.find('a:first').text(text); 
        } else {
            parent.find('a:first').html(html); 
        }   
        parent.find('a:first').append('<img src="img/icons/arrow_icon.png" alt="lista_nuoli"></img>');
        $('.dropdown ul').hide();
    });

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass('dropdown')) {
            $('.dropdown ul').hide();
        }
    });

    function calc_tile_amount() {
        var tile_sum = 0;
        $('input.Kattotiilet').each(function (i, e) {
            var v = parseInt($(e).val());
            if (!isNaN(v)) {
                tile_sum += v;
            }
        });
        return tile_sum;
    }

    function calc_metal_product_amount() {
        var metal_sum = 0;
        $('input.Peltituotteet').each(function (i, e) {
            var v = parseInt($(e).val());
            if (!isNaN(v)) {
                metal_sum += v;
            }
        });
        return metal_sum;
    }

    function calc_pipe_amount() {
        var pipe_sum = 0;
        $('input.Läpiviennit').each(function (i, e) {
            var v = parseInt($(e).val());
            if (!isNaN(v)) {
                pipe_sum += v;
            }
        });
        return pipe_sum;
    }

    function calc_weight_for_pallet_products() {
        var product_weight = 0;
        $('td.Erikoistiilet, td.Kiinnikkeet, td.Peltituotteet, td.Sisätaitetuotteet, td.Tiivisteet, td.Aluskatteet, td.Kattoturvat').each(function (i, e) {
            var v = parseFloat($(e).text());
            if (!isNaN(v)) {
                product_weight += v;
            }
        });
        return product_weight;
    }

    function calc_product_price() {
        var product_price = parseFloat($("td[data-cell='D100']").text());
        var pallet_price = parseFloat($('input.Lava').parent().next().text());

        return product_price - pallet_price;
    }

    function calc_pallet_amount() {
        var pallet_amount = 0;
        var maintile_amount = parseInt($('input.Lapetiili').val());
        var ridgetile_amount = parseInt($('input.Harjatiili').val());
        var vergetile_amount = parseInt($('input.Päätyreunatiili').val());
        var pipe_amount = calc_pipe_amount();
        var weight_for_pallet_products = calc_weight_for_pallet_products();
        var pallet_size = $('#tile_pallet_size').text();
        var ridge_pallet_size = $('#ridge_pallet_size').text();
        var verge_pallet_size = $('#verge_pallet_size').text();
        var max_tiles_without_pallet = $('#max_tiles_without_pallet').text();
        var combined_tile_amount = maintile_amount + ridgetile_amount + vergetile_amount;
        var maintiles_and_ridge = maintile_amount + ridgetile_amount;
        var maintiles_and_verge = maintile_amount + vergetile_amount;

        if (maintile_amount > max_tiles_without_pallet || combined_tile_amount > max_tiles_without_pallet || maintiles_and_ridge > max_tiles_without_pallet || maintiles_and_verge > max_tiles_without_pallet) {
            pallet_amount = Math.ceil(maintile_amount / pallet_size);
        }
        if (ridgetile_amount > 10) {
            pallet_amount = pallet_amount + Math.ceil(ridgetile_amount / ridge_pallet_size);
        }
        if (vergetile_amount > 10) {
            pallet_amount = pallet_amount + Math.ceil(vergetile_amount / verge_pallet_size);
        }
        pallet_amount = pallet_amount + Math.ceil(pipe_amount / 5);
        if (weight_for_pallet_products > 4) {
            pallet_amount = pallet_amount + Math.ceil(weight_for_pallet_products / 75);
        }
        $('input.Lava').val('');
        $('input.Lava').val(pallet_amount);
        $('#main_table').calx();
    }

    function change_delivery_prices_to_line() {
        $("td[data-cell='H4']").text('-');
        $("td[data-cell='H6']").text('-');
    }

    function request_to_update_delivery_cost() {
        $('#delivery_cost').val('');
        $('#main_table').calx();
        $("td[data-cell='H4']").text('Päivitä rahti');
        $("td[data-cell='H6']").text('Päivitä rahti');
    }

    $('input').change(function () {
        var floatValue = $(this).val();
        var stringValue = $(this).val().toString();

        if (stringValue.indexOf('.') != -1) {
            stringValue = stringValue.replace('.', ',');
        }

        if (stringValue.indexOf(',') != -1) {
            $(this).val(stringValue.replace(',', '.'));
        }

        if ($(this).hasClass('product_input')) {
            $(this).val(Math.ceil(floatValue));
        }

        if (floatValue < 0) {
            $(this).val(0);
        }

        if (floatValue > 100 && $(this).attr("id") == "discount") {
            $(this).val(100);
        }

        if (!$(this).hasClass('Lava')) {
            $('#main_table').calx();
            if ($(this).hasClass('product_input')) {
                calc_pallet_amount();
            }
        }

        if ($('#delivery_cost').val() > 0) {
            if ($(this).hasClass('product_input')) {
                request_to_update_delivery_cost();
            }
        } else {
            change_delivery_prices_to_line();
        }
    });

    $('#calc_amounts').click(function () {
        var tile = $('#tile_code').text();
        var roof_shape = $('#roof_shape').val();
        var roof_area = $('#roof_area').val();
        var ridge_length = $('#ridge_length').val();
        var ridge_tightening_material = $('#ridge_tightening_material').val();
        var verge_material = $('#verge_material').val();
        var verge_length = $('#verge_length').val();
        var underlayer = $('#underlayer').val();
        var min_sold_size = parseFloat($('#min_sold_size').text());
        var square_meter_demand = parseFloat($('#square_meter_demand').text());
        var ridge_demand = parseFloat($('#ridge_demand').text());
        var verge_demand = parseFloat($('#verge_demand').text());
        var tile_fixing_demand = parseFloat($('#tile_fixing_demand').text());
        var ridge_fixing_demand = parseFloat($('#ridge_fixing_demand').text());
        var verge_fixing_demand = parseFloat($('#verge_fixing_demand').text());

        empty_table();

        // Lapetiili ja kiinnikkeiden laskenta
        if (roof_area != '') {
            $('input.Lapetiili').val(Math.ceil(square_meter_demand * roof_area * 1.05 / min_sold_size) * min_sold_size);
            $('input.Lapetiilinaula').val(Math.ceil(roof_area / tile_fixing_demand));
            $('input.Lapetiilen_kiinnike').val(Math.ceil(roof_area / tile_fixing_demand));
            $('input.U-koukku').val(Math.ceil(roof_area / tile_fixing_demand));
        }

        // Harjatiili ja kiinnikkeiden laskenta
        if (ridge_length != '') {
            if (roof_shape == 'Harjakatto') {
                var ridge_tile_amount = Math.ceil(ridge_length * ridge_demand);
                $('input.Harjatiili').val(Math.ceil(ridge_tile_amount * 1.05));
                $('input.Harjatiilen_kiinnike').val(Math.ceil(ridge_tile_amount / ridge_fixing_demand));
                $('input.Harjatiilinaula').val(Math.ceil(ridge_tile_amount / ridge_fixing_demand));

                if (verge_material == 'Pelti') {
                    $('input.Päätykappale').val(2);
                } else {
                    $('input.Aloitusharjatiili').val(1);
                    $('input.Lopetusharjatiili').val(1);
                }

                $('input.Päätyharjatiili').val(2);
                $('input.Liitosharjatiili').val(1);

                if (roof_area != '') { // Lintuesteiden ja tippapeltien laskenta
                    $('input.Lintueste_5m').val(Math.ceil(ridge_length * 2 / 5));
                    $('input.Tippapelti_2m').val(Math.ceil(ridge_length * 2 / 1.9));
                }

                if (tile == 'minster' || tile == 'turmalin') {
                    $('input.Päätykappale').val(2);
                }
            } else {
                var monoridge_metal_amount = Math.ceil(ridge_length * 1.05 / 1.9);
                var metal_product_amount = calc_metal_product_amount();
                $('input.Pulpettikaton_yläräystäspelti_2m').val(monoridge_metal_amount);
                $('input.Listaruuvi').val(Math.ceil((metal_product_amount + monoridge_metal_amount) / 50));

                if (roof_area != '') { // Lintuesteiden ja tippapeltien laskenta
                    $('input.Lintueste_5m').val(Math.ceil(ridge_length / 5));
                    $('input.Tippapelti_2m').val(Math.ceil(ridge_length / 1.9));
                }
            }
        }

        // Harjatiivisteiden laskenta
        if (ridge_tightening_material != 'Ei mitään' && ridge_length != '') {
            if (ridge_tightening_material == 'Betoninen') {
                if (roof_shape == 'Pulpettikatto') {
                    $('input.Betoninen_harjatiiviste').val(Math.ceil(ridge_length * 3.35));
                } else {
                    $('input.Betoninen_harjatiiviste').val(Math.ceil(ridge_length * 6.7));
                }
            } else if (ridge_tightening_material == 'Muovinen') {
                if (roof_shape == 'Pulpettikatto') {
                    alert('Pulpettikatolla ei voi käyttää muovista harjatiivistettä');
                } else {
                    $('input.Muovinen_harjatiiviste').val(Math.ceil(ridge_length * 2.3));
                }
            } else if (ridge_tightening_material == 'Figaroll') {
                if (roof_shape == 'Pulpettikatto') {
                    alert('Pulpettikatolla ei voi käyttää Figaroll Plus harjatiivistettä');
                } else {
                    $('input.Figaroll_Plus').val(Math.ceil(ridge_length / 5));
                }
            } else if (ridge_tightening_material == 'Metalroll') {
                if (roof_shape == 'Pulpettikatto') {
                    alert('Pulpettikatolla ei voi käyttää Metalroll harjatiivistettä');
                } else {
                    $('input.Metalroll').val(Math.ceil(ridge_length / 5));
                }
            }
        }

        // Päätyjen laskenta
        if (verge_material != 'Ei mitään' && verge_length != '') {
            if (verge_material == 'Tiili') {
                var verge_tile_amount = verge_length * 1.05 * verge_demand;
                $('input.Päätyreunatiili').val(Math.ceil(verge_tile_amount));
                $('input.Tupla-aaltotiili').val(Math.ceil(verge_tile_amount));
                $('input.Reunatiiliruuvi').val(Math.ceil(verge_tile_amount / verge_fixing_demand));
                $('input.Päätytiili_vasen').val(Math.ceil(verge_tile_amount));
                $('input.Puolipäätytiili_vasen').val(Math.ceil(verge_tile_amount));
                $('input.Päätytiili_oikea').val(Math.ceil(verge_tile_amount));
                $('input.Puolipäätytiili_oikea').val(Math.ceil(verge_tile_amount));
            } else {
                var verge_metal_amount = verge_length * 1.05 / 1.9;
                var metal_product_amount = calc_metal_product_amount();
                $('input.Päätyräystäspelti_2m').val(Math.ceil(verge_metal_amount));
                $('input.Listaruuvi').val(Math.ceil((metal_product_amount + verge_metal_amount) / 50));
                $('input.Tiivistepala').val(Math.ceil(verge_length * 1.05 / 0.35 / 25));
            }
        }

        // Aluskate laskenta
        if (underlayer != 'Ei mitään' && roof_area != '') {
            if (underlayer == 'Universal') {
                $('input.Divoroll_Universal').val(Math.ceil(roof_area / 67.5));
            } else if (underlayer == 'Universal 2S') {
                $('input.Divoroll_Universal_2S').val(Math.ceil(roof_area / 67.5));
            } else if (underlayer == 'Top Ru') {
                $('input.Divoroll_Top_Ru').val(Math.ceil(roof_area / 67.5));
            } else if (underlayer == 'Span-Flex') {
                $('input.Span-Flex').val(Math.ceil(roof_area / 67.5));
            }
        }

        calc_pallet_amount();

        if ($('#delivery_cost').val() > 0) {
            request_to_update_delivery_cost();
        }
    });

    $('#calc_delivery_cost').click(function () {
        var tile = $('#tile_code').text();
        var postal_code = $('#postal_code').val();
        var product_price = calc_product_price();
        var pallet_amount = $('input.Lava').val();
        var tile_amount = calc_tile_amount();
        var pallet_size = $('#tile_pallet_size').text();
        var other_product_weight = parseFloat($("td[data-cell='F100']").text());
        var lift = $('#lift_to_roof').val();

        if (postal_code.length == 5) {
            $.ajax({
                type: 'post',
                url: 'php/scripts/calc_delivery_cost.php',
                data: 'postal_code=' + postal_code + '&tile_amount=' + tile_amount + '&product_price=' + product_price + '&other_product_weight=' + other_product_weight + '&pallet_amount=' + pallet_amount + '&pallet_size=' + pallet_size + '&lift=' + lift,
                success: function (data) {
                    var result = $.parseJSON(data);

                    if (result[0] == null) {
                        $('#city').val(result[1]);
                        $('#delivery_cost').val(result[2]);
                        if (tile_amount < 1 && lift == 'Kyllä') {
                            alert('Katollenostoa ei laskettu toimituskuluihin koska kattotiilien yhteismäärä on 0');
                        }
                    } else {
                        $('#city').val('');
                        $('#delivery_cost').val('');
                        alert(result[0]);
                    }
                    $('#main_table').calx();
                }
            });
        } else {
            alert('Postinumeron pitää olla 5 numeroa pitkä.');
        }
    });

    function empty_table() {
        $('.C').find('input').val('');
        $('#main_table').calx();
    }

    function empty_discount_and_delivery_cost_table() {
        $('#discount').val('');
        $('#postal_code').val('');
        $('#city').val('');
        $('#delivery_cost').val('');
    }

    function empty_calc_amounts_table() {
        $('#roof_shape').val('Harjakatto');
        $('#roof_area').val('');
        $('#ridge_length').val('');
        $('#ridge_tightening_material').val('Ei mitään');
        $('#verge_material').val('Ei mitään');
        $('#verge_length').val('');
        $('#underlayer').val('Ei mitään');
    }

    $('#empty_table').click(function () {
        empty_discount_and_delivery_cost_table();
        empty_calc_amounts_table();
        empty_table();
    });

    function create_JSON_data(type) {
        var json = [];

        var mail_address1 = $('#mail_address1').val();
        var mail_address2 = $('#mail_address2').val();
        var mail_address3 = $('#mail_address3').val();
        var mail_mark_identifier = $('#mail_mark_identifier').val();
        var download_mark_identifier = $('#download_mark_identifier').val();
        var print_mark_identifier = $('#print_mark_identifier').val();
        var mail_message = $('#mail_message').val();
        var tile = $.trim($('#tile_selection a:first').text());
        var colour = $.trim($('#colour_selection a:first').text());
        var discount = $('#discount').val();
        var lift_to_roof = $('#lift_to_roof').val();
        var postal_code = $('#postal_code').val();
        var city = $('#city').val();
        var delivery_cost = $('#delivery_cost').val();
        var total_price = parseFloat($("td[data-cell='H3']").text());
        var total_price_with_delivery = parseFloat($("td[data-cell='H4']").text());
        var total_price_tax = parseFloat($("td[data-cell='H5']").text());
        var total_price_with_delivery_tax = parseFloat($("td[data-cell='H6']").text());

        json.push({ 'type': type });
        json.push({ 'mail_address1': mail_address1 });
        json.push({ 'mail_address2': mail_address2 });
        json.push({ 'mail_address3': mail_address3 });
        json.push({ 'mail_message': mail_message });
        json.push({ 'mail_mark_identifier': mail_mark_identifier });
        json.push({ 'download_mark_identifier': download_mark_identifier });
        json.push({ 'print_mark_identifier': print_mark_identifier });
        json.push({ 'tile': tile });
        json.push({ 'colour': colour });
        json.push({ 'discount': discount });
        json.push({ 'lift_to_roof': lift_to_roof });
        json.push({ 'postal_code': postal_code });
        json.push({ 'city': city });
        json.push({ 'delivery_cost': delivery_cost });
        json.push({ 'total_price': total_price });
        json.push({ 'total_price_with_delivery': total_price_with_delivery });
        json.push({ 'total_price_tax': total_price_tax });
        json.push({ 'total_price_with_delivery_tax': total_price_with_delivery_tax });

        $('.A.product').each(function (i, e) {
            var product_number = $(e).text();
            var product_name = $(e).next().text();
            var input = $(e).next().next().find('input');
            var product_amount = input.val();
            var product_sumprice = parseFloat($(e).next().next().next().text());
            var product_price = (product_sumprice / product_amount).toFixed(2);
            var product_sumprice = product_sumprice.toFixed(2);
            var input_classes = input.attr('class');
            var category = input_classes.substr(0, input_classes.indexOf(' '));

            if (product_amount > 0) {
                json.push({ 'category': category, 'product_number': product_number, 'product_name': product_name, 'product_amount': product_amount, 'product_sumprice': product_sumprice, 'product_price': product_price });
            }
        });

        return json;
    }

    $("#send_mail_window").dialog({ autoOpen: false, modal: true, width: 400, closeText: "X", show: "fold", hide: "blind" });

    $('#open_send_mail_window').click(function () {
        $('#mail_loading_container').hide();
        $("#send_mail_window").dialog("open");
        return false;
    });

    $('#send_mail').click(function () {
        var email = $('#mail_address1').val();

        if (email.indexOf('@') > -1 && email.indexOf('.') > -1 && email.length > 5) {
            $('#mail_loading_container').show();
            var jsonData = create_JSON_data('mail');

            $.ajax({
                type: 'post',
                url: 'php/scripts/create_pdf.php',
                data: { json: jsonData },
                success: function (data) {
                    $("#send_mail_window").dialog("close");
                    $("#info_window_message").html(data);
                    $("#info_window").dialog("open");
                    $('#mail_mark_identifier').val('');
                }
            });

        } else {
            alert('Sähköpostiosoite on virheellinen.');
        }
    });

    $("#download_window").dialog({ autoOpen: false, modal: true, width: 300, closeText: "X", show: "fold", hide: "blind" });

    $('#open_download_window').click(function () {
        $('#download_loading_container').hide();
        $("#download_window").dialog("open");
        return false;
    });

    $('#download').click(function () {
        $('#download_loading_container').show();
        var jsonData = create_JSON_data('download');

        $.ajax({
            type: 'post',
            url: 'php/scripts/create_pdf.php',
            data: { json: jsonData },
            success: function (data) {
                $("#download_window").dialog("close");
                window.location = 'php/scripts/download.php?dir=pdf&filename=' + data;
                $('#download_mark_identifier').val('');
            }
        });
    });

    $("#print_window").dialog({ autoOpen: false, modal: true, width: 300, closeText: "X", show: "fold", hide: "blind" });

    $('#open_print_window').click(function () {
        $('#print_loading_container').hide();
        $("#print_window").dialog("open");
        return false;
    });

    $('#print').click(function () {
        $('#print_loading_container').show();
        var loading_message = 'Tarjousta valmistellaan tulostettavaksi...';

        var jsonData = create_JSON_data('print');
        var printWindow = window.open('php/scripts/loading.php?message=' + loading_message);

        $.ajax({
            type: 'post',
            async: false,
            url: 'php/scripts/create_pdf.php',
            data: { json: jsonData },
            success: function (data) {
                $("#print_window").dialog("close");
                printWindow.location = 'pdf/' + data;
                $('#print_mark_identifier').val('');
            }
        });
    });

    $('#info_pdf').click(function () {
        window.open('pdf/Tarjouslaskuri%20-%20Käyttöohje%20-%20Ormax%20Monier%20Oy.pdf');
        return false;
    });

    $("#info_window").dialog({ autoOpen: false, modal: true, width: 300, closeText: "X", show: "fold", hide: "blind" });

    $("#info_window_ok").click(function () {
        $("#info_window").dialog("close");
        return false;
    });

    $(".B.product a").click(function (e) {
        $("#product_window").dialog("close");
        $("#product_window").dialog({ title: 'Tuotetiedot' });
        $("#product_info_table").hide();
        $("#product_loading_container").show();
        $("#product_window").dialog("open");
        var product_number = $(this).parent().prev().text();

        $.ajax({
            type: "post",
            url: "php/scripts/get_product_information.php",
            data: "product_number=" + product_number,
            success: function (data) {
                var json = $.parseJSON(data);

                $("#product_window").dialog({ title: json.name });
                $("#product_info_number").html(product_number);
                $("#product_info_image img").attr("src", json.img_src);
                $("#product_info_price").html(json.price + ' €');
                $("#product_info_weight").html(json.weight + ' kg');
                $("#product_info_group").html(json.product_group);
                $("#product_info_class").html(json.product_class);
                $("#product_info_palletsize").html(json.palletsize);
                $("#product_info_packagesize").html(json.packagesize);
                $("#product_info_packageunit").html(json.packageunit);
                $("#product_info_ean").html(json.ean);
                $("#product_info_description").html(json.description);

                $("#product_loading_container").hide();
                $("#product_info_table").show();
            }
        });
    });

    $("#product_window").dialog({ autoOpen: false, modal: true, width: 400, closeText: "X", show: "fold", hide: "blind" });

    $("#product_window_close").click(function () {
        $("#product_window").dialog("close");
        return false;
    });
});