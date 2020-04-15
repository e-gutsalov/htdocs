$( document ).ready( function() {

    $( 'form' ).submit( function ( event ) {
        event.preventDefault();

        $( this ).find( '.form-control' ).each( function () {
            if ( $( this ).val().length < 1 ){
                $( this ).closest( '.form-group' ).addClass( 'has-error' );
            } else {
                $( this ).closest( '.form-group' ).addClass( 'has-success' );
            }
        } );

        let form = $( 'form' ).serialize();
        $.ajax({
            type: 'POST',
            url: '/callback/send',
            data: form
        } )
            .done( function ( data ) {
                data = $.parseJSON( data );
                if ( data.success ){
                    $( '#myModalLabel' ).html( data.title );
                    $( '#results' ).removeClass( 'alert-danger' ).addClass( 'alert-success' ).html( data.message );
                } else {
                    $( '#myModalLabel' ).html( data.title );
                    $( '#results' ).removeClass( 'alert-success' ).addClass( 'alert-danger' ).html( data.message );
                }
            } )
            .fail( function ( xhr, str ) {
                alert( 'Возникла ошибка: ' + xhr.responseCode );
            } );

    } );

    $( '.form-group' ).focusin( function () {
        $( this ).removeClass( 'has-error' );
        }
    )

} );
