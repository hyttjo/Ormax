$(document).ready(function () {
    numeral.language('fi', {
        delimiters: {
            thousands: ' ',
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

    $('#tile_selection').change(function () {
        var to = $(this).find('option:selected').attr('data-to');

        var from = '';

        if (to == 'ormax') {
            from = 'ormax';
        }

        var tile = $(this).val();
        $(location).attr('href', 'index.php?from=' + from + '&tiili=' + tile);
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

        if (maintile_amount > max_tiles_without_pallet) { pallet_amount = Math.ceil(maintile_amount / pallet_size); }
        if (ridgetile_amount > 0) { pallet_amount = pallet_amount + Math.ceil(ridgetile_amount / ridge_pallet_size); }
        if (vergetile_amount > 0) { pallet_amount = pallet_amount + Math.ceil(vergetile_amount / verge_pallet_size); }
        pallet_amount = pallet_amount + Math.ceil(pipe_amount / 5);
        if (weight_for_pallet_products > 4) {
            pallet_amount = pallet_amount + Math.ceil(weight_for_pallet_products / 75);
        }

        $('input.Lava').val(pallet_amount);
        $('#main_table').calx();
    }

    $('input').change(function () {
        if ($(this).val() < 0) {
            $(this).val(0);
        }

        if ($(this).val() > 100 && $(this).attr("id") == "discount") {
            $(this).val(100);
        }

        if (!$(this).hasClass('Lava')) {
            calc_pallet_amount();
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
            }
        }

        calc_pallet_amount();
    });

    $('#calc_delivery_cost').click(function () {
        var tile = $('#tile_code').text();
        var postal_code = $('#postal_code').val();
        var product_price = calc_product_price();
        var pallet_amount = $('input.Lava').val();
        var tile_amount = calc_tile_amount();
        var other_product_weight = parseFloat($("td[data-cell='F100']").text());
        var insurance = $('#insurance_delivery').prop('checked');
        var lift = $('#lift_to_roof').prop('checked');

        if (postal_code.length == 5) {
            $.ajax({
                type: 'post',
                url: 'php/scripts/calc_delivery_cost.php',
                data: 'postal_code=' + postal_code + '&tile_amount=' + tile_amount + '&product_price=' + product_price + '&other_product_weight=' + other_product_weight + '&pallet_amount=' + pallet_amount + '&insurance=' + insurance + '&lift=' + lift,
                success: function (data) {
                    var result = $.parseJSON(data);

                    if (result[0] == null) {
                        $('#city').val(result[1]);
                        $('#delivery_cost').val(result[2]);
                        if (tile_amount < 1 && lift) {
                            alert('Katollenostoa ei laskettu toimituskuluihin koska kattotiilien yhteismäärä on 0');
                        }
                        if (tile == 'minster') {
                            alert('Huom. laskettu toimituskustannus koskee vain varastotuotteita:\n\nMinster tiilellä nämä ovat Tummanharmaa ja Antrasiitti värisävyt');
                        } else if (tile == 'turmalin') {
                            alert('Huom. laskettu toimituskustannus koskee vain varastotuotteita:\n\nTurmalin tiilellä nämä ovat Enkopoitu Antrasiitti ja Lasitettu Musta värisävyt');
                        } else if (tile == 'granat') {
                            alert('Huom. laskettu toimituskustannus koskee vain varastotuotteita:\n\nGranat tiilellä tämä on Savitiilenpunainen värisävy');
                        }
                    } else {
                        $('#city').val('');
                        $('#delivery_cost').val('');
                        alert(result[0]);
                    }

                    //alert("rahti: " + result[1] + " tiilet: " + result[2] + " muut: " + result[3] + " vakuutus: " + result[4] + " pakkaus: " + result[5] + " nosto: " + result[6] + " rahtialue: " + result[7] + " tiilimäärä: " + result[8] + " painoryhmä: " + result[9] + " lavamäärä: " + result[10] + " tuotteiden hinta: " + result[11]);
                    $('#main_table').calx();
                }
            });
        } else {
            alert('Postinumeron pitää olla 5 numeroa pitkä.');
        }
    });

    function empty_table() {
        $('#discount').val('');
        $('#postal_code').val('');
        $('#city').val('');
        $('#delivery_cost').val('');
        $('.C').find('input').val('');
        $('#main_table').calx();
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
        empty_table();
        empty_calc_amounts_table();
    });
});