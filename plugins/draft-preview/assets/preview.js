(function(win, doc) {
    'use strict';

    if ( location.pathname.includes( 'pages' ) && document.querySelector( '#titlebar-save' ) )
    {
        // define preview URL and neighbour
        let route = ( typeof draft_preview_route == 'string' ) ? draft_preview_route : '/preview';
        let lang = ( typeof draft_preview_language == 'string' ) ? draft_preview_language : '';
        const previewPath = lang + route + '?slug=/' + GravAdmin.config.route;
        const ancestor = document.querySelector( '#titlebar-button-delete' );

        // create button (clone of the original preview btn)
        let button = doc.createElement( 'a' );
        button.href = previewPath;
        button.id = 'titlebar-button-preview';
        button.target = "_blank";
        button.classList.add( 'button' );
        button.innerHTML = '<i class="fa fa-eye"></i>';

        // insert button
        ancestor.insertAdjacentElement( 'beforebegin', button );
        // no CSS flex, so we need a space for spacing…
        doc.querySelector( '.button-bar' ).insertBefore( doc.createTextNode( ' ' ), ancestor );
    }

})(window, document);
