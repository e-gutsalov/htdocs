$( document ).ready( function() {

    $( 'button' ).on( 'click', function () {
        document.location.href = $( this ).attr( 'href' );
    });

    $( '[data-new="new"]' ).removeClass( 'hidden' );

});
