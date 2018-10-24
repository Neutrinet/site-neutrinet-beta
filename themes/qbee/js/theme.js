/*******************************************************************
  QBee. Grav-theme
    
    Copyright (c) 2018, Jorge Tite.
	  License: MIT
*******************************************************************/

(function($) {
    jQuery(document).ready(function() {

        let win = $(window);

        // single page navigation
        $("#onpage-menu").onePageNav({
            currentClass: 'active',
            filter: ':not(.external)'
        });

        // enable paralllax 
        $("[data-paroller-factor]").paroller();
    });
})(jQuery);