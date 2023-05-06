class Cart {
    static update = ( cart_type = 'default') => {
        let rowIds = [];
        let qtys = [];

        let rows = $(".shoping__cart__table table tbody tr").each( (index, element) => {
            let id = $(element).attr('id');
            let new_qty = $(element).find(".shoping__cart__quantity .pro-qty input").val();
            qtys.push(new_qty);
            rowIds.push(id);
        });

        let formData = new FormData();
        let token = $("meta[name='_token']").attr('content');
        formData.append( 'cart_type', cart_type );
        formData.append( 'rows',  JSON.stringify( rowIds ) );
        formData.append( 'qtys',  JSON.stringify( qtys ) );
        formData.append( '_token', token );
        
        Ajax.send('/update_cart', formData, 'POST', (response) => {
            if( response.success )
            {
                let message = "<div class='alert alert-success ajax-message'>" + response.message + "</div>";
                $("body").append(message);

                $("#shoping_cart_tbody").load(location.href + " #shoping_cart_tbody tr");
                $("#cart_total").load(location.href + " #cart_total li");
                $("#header__cart__content").load(location.href + " #header__cart__content .header__cart");
              
            }
            setTimeout( (e) => {
                $("body .ajax-message").remove();
            }, 5000)
        });
    };

    static remove = (rowId, cart_type = 'default') => {
        let formData = new FormData();
        let token = $("meta[name='_token']").attr('content');
        formData.append( 'cart_type', cart_type );
        formData.append( 'rowId', rowId );
        formData.append( '_token', token );

        Ajax.send('/remove_from_cart', formData, 'POST', (response) => {
            if( response.success )
            {
                let message = "<div class='alert alert-success ajax-message'>" + response.message + "</div>";
                $("body").append(message);

                $(`#${rowId}`).remove();
                $("#cart_total").load(location.href + " #cart_total li")

                $("#header__cart__content").load(location.href + " #header__cart__content .header__cart");
            }
            setTimeout( (e) => {
                $("body .ajax-message").remove();
            }, 5000)
        });
    };

    static add = (slug, cart_type = 'default', qty = 1) => {
        let formData = new FormData();
        let token = $("meta[name='_token']").attr('content');

        formData.append( 'cart_type', cart_type );
        formData.append( 'slug', slug );
        formData.append( 'qty', qty );
        formData.append( '_token', token );

        Ajax.send('/add_to_cart', formData, 'POST', (response) => {
            if( response.success )
            {
                let message = "<div class='alert alert-success ajax-message'>" + response.message + "</div>";
                $("body").append(message);
                $("#header__cart__content").load(location.href + " #header__cart__content .header__cart");
            }
            setTimeout( (e) => {
                $("body .ajax-message").remove();
            }, 5000)
        });
    }
}