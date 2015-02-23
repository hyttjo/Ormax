$(document).ready(function () {
    $('#main_table').calx();

    $('#calc_delivery_cost').click(function () {
        var postal_code = $('#postal_code').val();

        $.ajax({
            type: 'post',
            url: 'php/scripts/calc_delivery_cost.php',
            data: 'postal_code=' + postal_code,
            success: function (data) {
                var result = $.parseJSON(data);
                $('#city').val(result[0]);
                $('#delivery_cost').val(result[1]);
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