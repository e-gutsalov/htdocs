$( document ).ready( function() {

    $( 'button' ).on( 'click', function () {
        window.location.href = $( this ).attr( 'href' );
    });

    $( '[data-new="new"]' ).removeClass( 'hidden' );

    $( '.add-to-cart' ).click( function () {
        let id = $( this ).data( 'id' );
        $.post( $( this ).attr( 'href' )+id, {}, function ( data ) {
            $( '#cart-count' ).html( data );
        } );
        return false;
    } );

} );

/*
$(document).ready(function(){
    $(".add-to-cart").click(function () {
        var id = $(this).attr("data-id");
        $.post("/cart/addAjax/"+id, {}, function (data) {
            $("#cart-count").html(data);
        });
        return false;
    });
});

 */