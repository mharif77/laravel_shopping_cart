@extends('shop')

@section('content')
<h1>Order Summary</h1>
<table id="cart" class="table table-bordered" style="width: 40%;">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>

        </tr>
    </thead>
    <tbody>
        @php $total = 0 @endphp
        @if (session('cart'))
            @foreach (session('cart') as $id => $details)
                <tr rowId="{{ $id }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{ $details['price'] }}</td>
                    <td data-th="quantity">{{ $details['quantity'] }}</td>

                    <td data-th="Subtotal" class="text-center">${{ $details['quantity'] * $details['price'] }}</td>

                </tr>
                @php
                    $total += $details['quantity'] * $details['price'];

                    $total = round($total);
                @endphp
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Total Amount:</th>
            <th> ${{$total}}</th>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <form action="{{route('session')}}" method="post">
                    @csrf
                
                <a href="{{ url('/home') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continue
                    Shopping</a>
                    <!-- <a href="{{ url('/session/{$total}/{productdetails}') }}" class="btn btn-danger">Place order <i class="fa fa-angle-right"></i> </a> -->
                     <button type="submit" class="btn btn-danger"> Place order <i class="fa fa-angle-right"></i></button>
                     <input type="hidden" name="total" value="{{$total}}">
                     <input type="hidden" name="productDetails" value="Sample">

                    </form>
            </td>
        </tr>
    </tfoot>
</table>
@endsection

@section('scripts')
<script type="text/javascript">
    $(".edit-cart-info").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        //alert(ele.val());
        $.ajax({
            url: "{{ route('update.sopping.cart') }}",
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("rowId"),
                quantity: ele.val()
            },
            success: function (response) {
                window.location.reload();
            }
        });
    });

    $(".delete-product").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        if (confirm("Do you really want to delete?")) {
            $.ajax({
                url: "{{ route('delete.cart.product') }}",
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("rowId")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
</script>
@endsection