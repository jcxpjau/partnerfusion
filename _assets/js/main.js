var $j = jQuery.noConflict();

$j( window ).load( function() {

});

$j( document ).ready( function() {


});

function trigger( sel, fn )
{
    if ( $j( document ).find( sel ).length ) {
        var f = window[ fn ];
        if ( typeof f === "function" ) f();
    }
}
