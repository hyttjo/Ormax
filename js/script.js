$('#ormax_laskentataulukko').calx({
	autocalculate: false
});
	    
$('#tyhjenna').click(function(){
	$('#ormax_laskentataulukko').calx('update');
});


$(document).ready("#laske_toimituskustannukset").click(function () {
    $("#ormax_laskentataulukko").calx('refresh');
    $("#ormax_laskentataulukko").calx('update');
});