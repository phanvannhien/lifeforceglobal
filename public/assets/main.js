    var controller;
    $(function () {
        $('.footable').footable();
    });
  
    $.ajaxSetup({
    	headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
            $('#loading').fadeIn();
        },
        complete: function() {
            $('#loading').fadeOut();
        },
        success: function() {
            $('#loading').fadeOut();
        }
    });
    ( function ( $ ) {
        $('.parallax').parallax();

      // Create a new instance of Slidebars
       controller = new slidebars();
      // Initialize Slidebars
      controller.init();
       $( '.js-toggle-right-slidebar' ).on( 'click', function ( event ) {
          event.stopPropagation();
          controller.toggle( 'slidebar-cart' );
        });

        $( '.js-toggle-left-slidebar' ).on( 'click', function ( event ) {
          event.stopPropagation();
          controller.toggle( 'slidebar-nav' );
        });



        $( controller.events ).on( 'opened', function () {
                $( '[canvas="container"]' ).addClass( 'js-close-any-slidebar' );
            } );

            $( controller.events ).on( 'closed', function () {
                $( '[canvas="container"]' ).removeClass( 'js-close-any-slidebar' );
            } );



            $( 'body' ).on( 'click', '.js-close-any-slidebar', function ( event ) {
                event.stopPropagation();
                controller.close();
            } );

            $( controller.events ).on( 'opening', function ( event, id ) {
             	   refreshCart();
            });

    } ) ( jQuery );
function addcart(target){
    var $form = $(target).closest('form');

	$.ajax({
		url: '/cart',
		type: 'post',
		dataType: 'json',
		data: { 
            product_id: $($form).find('input[name="product_id"]').val(),
            qty: $($form).find('select[name="qty"]').val()
        },
		success: function(res){
			if( res.status == true ){
				controller.toggle( 'slidebar-cart' );
			}
		}
	})
}

function refreshCart(){
	$.ajax({
		url: '/cart',
		type: 'get',
		success:function(res){
			$('#render-cart').html(res);
		}
	});
}