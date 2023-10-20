@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row mb-3">
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $user->name}} 's order</h4>
                    <span>{{ $user->email }}</span>
                    <br>
                    <span>{{ $user->phone }}</span>
                </div>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header row">
                <h5 class="fs-4 col-lg-3 col-md-12 col-sm-12 text-md-center text-sm-center">
                    Order Items List
                </h5>
               <div class="d-flex offset-lg-3 col-lg-6 col-md-12 col-sm-12 justify-content-end">
               <a href="{{ route('admin#order#viewOrder',[$user->id,$order_code]) }}">
                    <button type="button" class="btn btn-secondary btn-sm text-dark me-3">View</button>
               </a>
               <a href="{{ route('admin#order#download',[$user->id,$order_code]) }}">
                    <button type="button" class="btn btn-info btn-sm text-dark me-2">Download</button>
               </a>
               <a href="{{ route('admin#order#sendmail',[$user->id,$order_code]) }}">
                    <button type="button" class="btn btn-warning btn-sm text-dark">Send Mail</button>
               </a>
               </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>OrderCode</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($orderItems as $orderItem)
                            <tr class="table-primary">
                                <td>
                                    <img src="{{ asset('storage/admin/product/'.$orderItem->product_image )}}" width="75px">
                                </td>
                                <td>{{ $orderItem->product_name }}</td>
                                <td>{{ $orderItem->product_price }}</td>
                                <td>{{ $orderItem->quantity }}</td>
                                <td>{{ $orderItem->total_price }}</td>
                                <td>{{ $orderItem->order_code }}</td>
                                <td>{{ $orderItem->created_at->format('d-m-Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-black p-4">
                    {{-- {{ $orders->links() }} --}}
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
</div>
@endsection
