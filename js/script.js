$(document).ready(function() {
    $('#main_table').calx({
	    autocalculate: false
    });
	    
    $('#empty_table').click(function(){
	    $('#main_table').calx('update');
    });

    $('#calc_delivery_cost').click(function () {
        $('#main_table').calx('refresh');
        $('#main_table').calx('update');
    });

    $('#discount').on('keyup', function(){
        var regex = /^[a-zA-z]+$/;
           if(!regex.test(this.value)){
              alert(this.id + ' is a required field.');
           }
    });
});