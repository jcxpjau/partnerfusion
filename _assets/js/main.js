var $j = jQuery.noConflict();

$j( window ).load( function() {

    trigger( '.btn-delete' , confirm_delete() );

});

$j( document ).ready( function() {

    $j('.phone-number').focusout(function(){
        var phone, element;
        element = $j(this);
        element.unmask();
        phone = element.val().replace(/\D/g, '');
        if(phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    }).trigger('focusout');

    $j('.date').focusout(function(){
        var date, element;
        element = $j(this);
        element.unmask();
        date = element.val().replace(/\D/g, '');
        element.mask("99/99/9999");
    }).trigger('focusout');


});

function trigger( sel, fn )
{
    if ( $j( document ).find( sel ).length ) {
        var f = window[ fn ];
        if ( typeof f === "function" ) f();
    }
}

function confirm_delete()
{
    $j( '.btn-delete').click( function( e ) {
        var r = confirm( "Você realmente deseja deletar este item? " );
        if ( r !== true ) {
            e.preventDefault();
        }
    });
}
