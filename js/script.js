$(document).ready(function () {
    $('#main_table').calx();

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

    function calc_pallet_amount() {
        var pallet_amount = 0;
        maintile_amount = parseInt($('input.Lapetiili').val());
        ridgetile_amount = parseInt($('input.Harjatiili').val());
        vergetile_amount = parseInt($('input.Päätyreunatiili').val());
        var pipe_amount = calc_pipe_amount();
        var weight_for_pallet_products = calc_weight_for_pallet_products();

        if (maintile_amount > 42) { pallet_amount = Math.ceil(maintile_amount / 252); }
        if (ridgetile_amount > 0) { pallet_amount = pallet_amount + Math.ceil(ridgetile_amount / 50); }
        if (vergetile_amount > 0) { pallet_amount = pallet_amount + Math.ceil(vergetile_amount / 60); }
        pallet_amount = pallet_amount + Math.ceil(pipe_amount / 5);
        pallet_amount = pallet_amount + Math.ceil(weight_for_pallet_products / 75);

        $('input.Lava').val(pallet_amount);
        $('#main_table').calx();
    }

    $('input').change(function () {
        if (!$(this).hasClass('Lava')) {
            calc_pallet_amount();
        }
    });

    $('#calc_delivery_cost').click(function () {
        var postal_code = $('#postal_code').val();
        var pallet_amount = $('input.Lava').val();
        var tile_amount = calc_tile_amount();

        var other_product_weight = parseFloat($("td[data-cell='F100']").text());

        $.ajax({
            type: 'post',
            url: 'php/scripts/calc_delivery_cost.php',
            data: 'postal_code=' + postal_code + '&tile_amount=' + tile_amount + '&other_product_weight=' + other_product_weight + '&pallet_amount=' + pallet_amount,
            success: function (data) {
                var result = $.parseJSON(data);
                $('#city').val(result[0]);
                $('#delivery_cost').val(result[1]);
                alert("rahti: " + result[1] + " tiilet: " + result[2] + " muut: " + result[3] + " vakuutus: " + result[4] + " pakkaus: " + result[5] + " nosto: " + result[6] + " rahtialue: " + result[7] + " tiilimäärä: " + result[8] + " painoryhmä: " + result[9] + " lavamäärä: " + result[10]);
                $('#main_table').calx();
            }
        });
    });

    $('#empty_table').click(function () {
        $('#discount').val('');
        $('#postal_code').val('');
        $('#city').val('');
        $('#delivery_cost').val('');
        $('.C').find('input').val('');
        $('#main_table').calx();
    });
});