$( document ).on( 'keydown', function ( e ) {
	if ( e.keyCode === 27 ) { // ESC
    	$('#toggle-search').hide();
	    $("body").removeClass('search-mode');
	}
});

$( '#toggle-search-show' ).click(function () {
    $('#toggle-search').show();
    $('.search-panel__form').focus();
    $("body").addClass('search-mode');
    return false;
});

$( '.search-panel__close' ).click(function () {
    $('#toggle-search').hide();
    $("body").removeClass('search-mode');
    return false;
});



