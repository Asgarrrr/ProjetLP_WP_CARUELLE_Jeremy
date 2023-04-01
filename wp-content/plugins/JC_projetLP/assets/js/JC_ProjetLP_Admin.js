// When page is loaded; check if the user check / uncheck the checkbox

jQuery( document ).ready( function( $ ) {

    $( 'input[name="majorOnly"]' ).on( 'change', function () {

        const data = {
            action      : "JC_ProjetLP_majorOnly",
            countryID   : this.id,
            majorOnly   : this.checked,
            nonce       : JC_ProjetLP_Admin.nonce
        };

        console.log( data );

        $.ajax({
            url: JC_ProjetLP_Admin.ajax_url,
            xhrFields: {
                withCredentials: true
            },
            data: data,
            type: 'POST',
            success: ( response ) => {
                $( this ).parent().parent().fadeOut( 500, function() {
                    $( this ).fadeIn( 500 );
                });
            }
        });


    });


    $( 'select[name="notation"]' ).on( 'change', function ( ) {

        const data = {
            action      : "JC_ProjetLP_notation",
            countryID   : this.id,
            notation    : this.value,
            nonce       : JC_ProjetLP_Admin.nonce
        };

        $.ajax({
            url: JC_ProjetLP_Admin.ajax_url,
            xhrFields: {
                withCredentials: true
            },
            data: data,
            type: 'POST',
            success: ( response ) => {
                $( this ).parent().parent().fadeOut( 500, function() {
                    $( this ).fadeIn( 500 );
                });
            }
        });

    });

    $( '#countryconfig' ).on( 'change', function ( ) {

        const data = {
            action      : "JC_ProjetLP_enabled",
            countryID   : $( this ).map( ( i, el ) => $( el ).val() ).get(),
            nonce       : JC_ProjetLP_Admin.nonce
        };

        $.ajax({
            url: JC_ProjetLP_Admin.ajax_url,
            xhrFields: {
                withCredentials: true
            },
            data: data,
            type: 'POST',
            success: ( response ) => {
                console.log( response );
            }
        });

    });

});