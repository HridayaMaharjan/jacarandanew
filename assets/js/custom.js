$(document).ready(function(){
    console.log("custom.js loaded");


        $(document).on('click','.increment-btn', function(e){
        e.preventDefault();

        var qty = $(this).closest('.item_data').find('.input-qty').val();
        
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if(value < 10)
            {
                value++;
                $(this).closest('.item_data').find('.input-qty').val(value);
            }
    });

 
        $(document).on('click','.decrement-btn', function(e){
        e.preventDefault();

        var qty = $(this).closest('.item_data').find('.input-qty').val();
        
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if(value > 1)
            {
                value--;
                $(this).closest('.item_data').find('.input-qty').val(value);
            }
    });


        $(document).on('click','.addToCartBtn', function(e){
        e.preventDefault();
        console.log("Add to Cart button clicked");

        var qty = $(this).closest('.item_data').find('.input-qty').val();
        var item_id = $(this).val();
        console.log("Item ID:", item_id);
        console.log("Quantity:", qty);

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "item_id": item_id,
                "item_qty": qty,
                "scope": "add"
            },
            success: function(response){
                console.log("Response from server:", response);

                if(response == 201) {
                    alert('Item added to cart!');
                }
                else if(response == " existing") {
                    alert('Already added to cart!');
                }
                else if(response == 401) {
                    window.location.href = 'login.php?message=please_login_to_continue';
                } 
                else if(response == 500) {
                    alert('Something went wrong. Please try again.');
                }
            },

            error: function(xhr, status, error) {
                console.error("AJAX Error: ", status, error);
            }
        });
    });


    $(document).on('click','.updateQty', function(){
        var qty = $(this).closest('.item_data').find('.input-qty').val();
        var item_id = $(this).closest('.item_data').find('.itemId').val();

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
            "item_id": item_id,
            "item_qty": qty,
            "scope": "update"
        },
        success: function (response){
            //alert(response);
        }
    });
});


$(document).on('click','.deleteItem', function(){
    var cart_id = $(this).val();

    $.ajax({
        method: "POST",
        url: "functions/handlecart.php",
        data: {
        "cart_id": cart_id,
        "scope": "delete"
    },
    success: function (response){
        if(response == 200) {
            alert('Item deleted successfully!');
            $('#mycart').load(location.href + "#mycart");
        }else{
            alert(response);
        }
    }
});
    
});
});