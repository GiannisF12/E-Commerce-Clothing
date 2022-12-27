$(document).ready(function() 
{
    loadcart();
    $.ajaxSetup
    ({
        headers: 
        {
            'X-CSRFTOKET': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function loadcart()
    {
        $.ajax({
            type: "GET",
            url: "/load-cart-data",
            success: function(response)
            {
                $('.cart-count').html('');
                $('.cart-count').html(response.count);
                //console.log(response.count)
            }
        });
    }
})

Route::get('load-cart-data', [CartController::class,'cartcount']);
    public function cartcount()
    {
        $cartcount = Cart::where('id', Auth::id())->count();
        return response()->json(['count' => $cartcount]);
    }