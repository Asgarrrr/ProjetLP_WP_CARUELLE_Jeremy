jQuery( document ).ready( function ( $ ) {

    // Get page url
    const url = window.location.href;

    if ( url.endsWith( "/choix-voyage/" ) ) {

        // Get local storage data
        const data = JSON.parse( localStorage.getItem( "data" ) );

        // If data exists
        if ( data ) {

            // Add new script tag
            const script = document.createElement( "script" );
            script.src = "https://www.gstatic.com/charts/loader.js";
            document.body.appendChild( script );

            script.onload = () => {

                google.charts.load( 'current', { 'packages': [ 'geochart' ] } );
                google.charts.setOnLoadCallback( ( ) => {

                    const test = [];
                    for ( let i = 1; i <= 5; i++ )
                        if ( data[ `country${i}` ] !== "" )
                            test.push( [ data[ `country${i}Name` ] ] );

                    var dataChart = google.visualization.arrayToDataTable( [ [ 'Country' ], ...test ] );

                    var options = {};
                    var chart = new google.visualization.GeoChart( document.getElementById('regions_div'));
                    chart.draw(dataChart, options);

                } );


            };

            $( "#register" ).hide();
            $( "#prevData" ).show();

            $( "#prevData" ).html( $( "#prevData" ).html() + `
                <form id="commandResume" action="./select" method="post">
                    <input type="hidden" name="gender" value="${ data.gender }">
                    <input type="hidden" name="lastname" value="${ data.lastname }">
                    <input type="hidden" name="firstname" value="${ data.firstname }">
                    <input type="hidden" name="email" value="${ data.email }">
                    <input type="hidden" name="birthdate" value="${ data.birthdate }">
                    <button type="submit" id="prevDataBtn" class="float-right">Modifier mes données du ${ new Date( data.timestamp ).toLocaleDateString() }</button>
                </form>
            ` );

        } else {

            $( "#register" ).show();
            $( "#prevData" ).hide();

        }

    }

    if ( url.endsWith( "/select" ) ) {

        // hide all country2+ selects
        for ( let i = 2; i <= 6; i++ )
            $( `#country${i}Div` ).hide();

        // show/hide country selects based on user selection
        for (let i = 1; i <= 5; i++) {
            $( `#country${i}` ).on( "change", function () {

                if ( this.value !== "" ) {
                    $( `#country${ i + 1 }Div` ).show();

                    // Get the selected country
                    const selectedCountry = $( this ).val();

                    // Remove the selected country from the other selects
                    for ( let j = i + 1; j <= 5; j++ ) {
                        $( `#country${j} option[value="${selectedCountry}"]` ).remove();
                    }

                } else {
                    for ( let j = i + 1; j <= 5; j++ ) {
                        $( `#country${j}`).val( "" );
                        $( `#country${j}Div` ).hide();
                    }
                }
            });
        }

    }

    $( "#validate" ).on( "click", function () {

        console.log( "validate" );

        console.log( $( '#commandResume input[name="gender"]' ).val() );

        const data = {
            action      : "JC_ProjetLP_validate",
            nonce       : JC_ProjetLP_Front.nonce,
            gender      : $( '#commandResume input[name="gender"]' ).val(),
            name        : $( '#commandResume input[name="lastname"]' ).val(),
            birthdate   : $( '#commandResume input[name="birthdate"]' ).val(),
            firstname   : $( '#commandResume input[name="firstname"]' ).val(),
            email       : $( '#commandResume input[name="email"]' ).val(),
            country1    : $( '#commandResume input[name="country1"]' ).val(),
            country2    : $( '#commandResume input[name="country2"]' ).val(),
            country3    : $( '#commandResume input[name="country3"]' ).val(),
            country4    : $( '#commandResume input[name="country4"]' ).val(),
            country5    : $( '#commandResume input[name="country5"]' ).val(),
        };

        $.ajax({
            url: JC_ProjetLP_Front.ajax_url,
            xhrFields: {
                withCredentials: true
            },
            data: data,
            type: 'POST',
            success: ( response ) => {

                jQuery( "#modal" ).html( response );
                let hbs = jQuery( "#scriptModal" ).attr( "src" );

                jQuery.get( hbs, function( hdata ) {

                    localStorage.setItem( "data", JSON.stringify( {
                        firstname   : data.firstname,
                        lastname    : data.name,
                        email       : data.email,
                        birthdate   : data.birthdate,
                        gender      : data.gender,
                        country1Name: $( '#commandResume input[name="country1"]' ).attr( "data-country" ),
                        country2Name: $( '#commandResume input[name="country2"]' ).attr( "data-country" ),
                        country3Name: $( '#commandResume input[name="country3"]' ).attr( "data-country" ),
                        country4Name: $( '#commandResume input[name="country4"]' ).attr( "data-country" ),
                        country5Name: $( '#commandResume input[name="country5"]' ).attr( "data-country" ),
                        timestamp   : new Date().getTime()
                    } ) );

                    var template = Handlebars.compile( hdata );

                    $( "#modal" ).show();
                    $( "#modal" ).html( template({
                        gender: data.gender === "male" ? "Monsieur" : "Madame",
                        firstname: data.firstname,
                        lastname: data.name
                    }) );

                }, 'text' );

            }
        });

    });

});
