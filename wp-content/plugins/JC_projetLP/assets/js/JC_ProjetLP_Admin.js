// When page is loaded; check if the user check / uncheck the checkbox

jQuery( document ).ready(function($) {

    $('input[name="majorOnly"]').on('change', function() {

        // If the checkbox is checked
        if ( this.checked ) {
            console.log( 'checked')
        } else {
            console.log( 'unchecked')
        }

    });


});