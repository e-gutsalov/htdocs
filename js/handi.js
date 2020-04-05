$( document ).ready( function()
{
    $( 'button' ).on( 'click', function () {
        window.location.href = $( this ).attr( 'href' );
    } );

    $( '[data-new="new"]' ).removeClass( 'hidden' );

    $( '.add-to-cart' ).click( function () {
        let id = $( this ).data( 'id' );
        $.post( $( this ).attr( 'href' )+id, {}, data => {
            $( '#cart-count' ).html( data );
        } );
        return false;
    } );

    $( '.del-to-cart' ).click( function () {
        let id = $( this ).data( 'id' );
        $.post( $( this ).attr( 'href' )+id, {}, data => {
            data = $.parseJSON( data );
            $( this ).closest( '.cart-del' ).detach();
            $( '#totalPrice' ).html( data.totalPrice );
            $( '#cart-count' ).html( data.count );
        } );
        return false;
    } );
} );
