@extends ('user.layouts.master')

@section('mainContent')
<main class="main">
    <div class="page-header text-center" style="background: rgb(180, 180, 180)">
        <div class="container">
            <h1 class="page-title">Shopping Cart...<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user#home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer#allProducts') }}">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <table class="table table-cart table-mobile" id="productTableTag">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
                                @foreach ($cartItems as $cartItem)
                                <tr>
                                    <td class="product-col">
                                        <div class="product">
                                            <figure class="product-media">
                                                <a href="#">
                                                    <img src="{{ asset('storage/admin/product/'.$cartItem->product_image) }}" alt="Product image">
                                                </a>
                                            </figure>

                                            <h3 class="product-title">
                                                <a href="#">{{ $cartItem->product_name }}</a>
                                                <input type="hidden" id="cartItemId" value="{{ $cartItem->id }}">
                                            </h3><!-- End .product-title -->
                                        </div><!-- End .product -->
                                    </td>
                                    <td class="price-col productPrice">{{ $cartItem->product_price }}</td>
                                    <td class="quantity-col">
                                        <div class="cart-product-quantity">
                                            <input type="number" class="form-control productQuantity" value="{{ $cartItem->quantity }}" min="1" max="10" step="1" data-decimals="0"  required>
                                            <input type="hidden" class="productId" id="productId" value="{{ $cartItem->product_id }}">
                                        </div><!-- End .cart-product-quantity -->
                                    </td>
                                    <td class="total-col productTotal">{{ $cartItem->product_price * $cartItem->quantity }} Kyats</td>
                                    <td class="remove-col"><button class="btn-remove bg-info removeTrBtn" type="button" ><i class="icon-close"></i></button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table><!-- End .table table-wishlist -->

                        <div class="cart-bottom">
                            <a href="#" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i class="icon-refresh"></i></a>
                        </div><!-- End .cart-bottom -->
                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-3">
                        <div class="summary summary-cart">
                            <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                            <table class="table table-summary" >
                                <tbody>
                                    <tr class="summary-subtotal">
                                        <td>Subtotal:</td>
                                        <td id="subTotal">{{ $subTotal }} Kyats</td>
                                    </tr><!-- End .summary-subtotal -->
                                    <tr class="summary-shipping">
                                        <td>Delivery:</td>
                                        <td id="deliveryFee">5000 Kyats</td>
                                    </tr>

                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td id="total">{{ $subTotal + 5000 }} Kyats</td>
                                    </tr><!-- End .summary-total -->
                                </tbody>
                            </table><!-- End .table table-summary -->

                            <button type="button" id="checkoutBtn" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</button>
                        </div><!-- End .summary -->

                        <a href="{{ route('customer#allProducts') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // when the quantity increases or decreases
        $('.productQuantity').change(function () {
            // get the data
            $parentRow = $(this).parents("tr");
            $price = $parentRow.find('.productPrice').text();
            $quantity = $parentRow.find('.productQuantity').val();

            // update specific total text
            $parentRow.find('.productTotal').html(`${$price * $quantity} Kyats`);
            updateSubTotalAndTotal();

            // update data in database
            $updateData = {
                id : $parentRow.find('#cartItemId').val(),
                quantity : $quantity
            };

            $.ajax({
                type : 'get',
                url : '/customer/cart/updateCartItem/ajax',
                data : $updateData,
                dataType : 'json',
                success : function (response) {
                }
            });

        });

        // remove table row
        $('.removeTrBtn').click(function(){
            $(this).parents("tr").remove();
            updateSubTotalAndTotal();

            // delete data in database
            $deleteData = {
                id :  $(this).parents("tr").find('#cartItemId').val(),
            };
            $.ajax({
                type : 'get',
                url : '/customer/cart/deleteCartItem/ajax',
                data : $deleteData,
                dataType : 'json',
                success : function (response) {
                }
            });
        });

        // update subtotal & total function
        function updateSubTotalAndTotal () {
            // update subtotal text
            $subTotal = 0;
            $deliveryFee = Number($('#deliveryFee').text().replace('Kyats',''));
            $('#productTableTag tbody tr').each(function (index,row) {
                $subTotal += Number($(row).find('.productTotal').text().replace('Kyats',''));
            });
            $('#subTotal').html(`${$subTotal} Kyats`);
            $('#total').html(`${$subTotal + $deliveryFee} Kyats`);
        }

        // check out button
        $('#checkoutBtn').click(function () {
            $itemList = [];
            $randomNumber = Math.floor(Math.random() * 100000000001)
            $('#productTableTag tbody tr').each(function (index,row) {
                $itemList.push({
                    'user_id' : $('#userId').val(),
                    'product_id' : $(row).find('.productId').val(),
                    'quantity' : $(row).find('.productQuantity').val(),
                    'total_price' : Number($(row).find('.productTotal').text().replace('Kyats','')),
                    'order_code' : $randomNumber
                });
            });
            $.ajax({
                type : 'get',
                url : '/customer/cart/orderItems/ajax',
                data : Object.assign({},$itemList),
                dataType : 'json',
                success : function (response) {
                    window.location.href = '/home'
                }
            });


        });
    });
</script>
@endsection
