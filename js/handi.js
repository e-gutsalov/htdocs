$( document ).ready( function()
{
    $( 'button' ).on( 'click', function () {
        window.location.href = $( this ).attr( 'href' );
    } );

    $( '[data-new="new"]' ).removeClass( 'hidden' );

    $( '.add-to-cart' ).on( 'click', function () {
        let id = $( this ).data( 'id' );
        $.post( $( this ).attr( 'href' )+id, {}, data => {
            $( '#cart-count' ).html( data );
        } );
        return false;
    } );

    $( '.del-to-cart' ).on( 'click', function () {
        let id = $( this ).data( 'id' );
        $.post( $( this ).attr( 'href' )+id, {}, data => {
            data = $.parseJSON( data );
            $( this ).closest( '.cart-del' ).detach();
            $( '#totalPrice' ).html( data.totalPrice );
            $( '#cart-count' ).html( data.count );
        } );
        return false;
    } );

    $( '.s-image' ).on( 'click', function (event) {
        event.preventDefault();
        let s = $( this ).attr( 'src' );
        $( '.p-image' ).attr( 'src', s );
        $( '.image' ).attr( 'href', s );
    } );
} );
