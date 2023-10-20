@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
    {{-- accept the order --}}
    @if (session('changeStatusSuccess'))
    <div class="alert alert-success border border-dark alert-dismissible" role="alert">
        {{ session('changeStatusSuccess') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    {{-- decline the order --}}
    @if (session('changeStatusDecline'))
    <div class="alert alert-success border border-dark alert-dismissible" role="alert">
        {{ session('changeStatusDecline') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
     {{-- mail sent --}}
     @if (session('mailsent'))
     <div class="alert alert-success border border-dark alert-dismissible" role="alert">
         {{ session('mailsent') }}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
     @endif
      {{-- mail sent wrong --}}
      @if (session('cantSent'))
      <div class="alert alert-warning border border-dark alert-dismissible" role="alert">
          {{ session('cantSent') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header row">
                <h5 class="fs-4 col-lg-3 col-md-12 col-sm-12 text-md-center text-sm-center">
                    Order List <span class="badge badge-center rounded-pill bg-label-primary">{{ $orders->total() }}</span>
                </h5>
               <form class="d-flex offset-lg-3 col-lg-6 col-md-12 col-sm-12 justify-content-end" style="max-height: 5vh !important;" action="{{ route('admin#order#orderList') }}"  method="get">
                    <div class="d-flex">
                        <input type="search" name="searchOrderList" value="{{ request('searchOrderList') }}" class="form-control form-control-sm" placeholder="search...">
                        <button type="submit" class="btn btn-sm btn-info ms">
                            <i class='bx bx-search-alt-2'></i>
                        </button>
                    </div>
               </form>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User Image</th>
                                <th>Username</th>
                                <th>Order Code</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                           @foreach ($orders as $order)
                           <tr class="table-primary">
                                <td>{{ $order->user_id }}</td>
                                <td>
                                    <img
                                    @if ($order->user_image === null)
                                        @if ($order->user_gender === 'male')
                                            src="{{ asset('user_male_default.png') }}"
                                        @elseif ($order->user_gender === 'female')
                                            src="{{ asset('default_user_female.svg') }}"
                                        @endif
                                    @else
                                        src="{{ asset('storage/admin/account/'.$order->user_image )}}"
                                    @endif
                                    width="80px"
                                    >
                                </td>
                                <td class="userName">
                                    <a href="{{ route('admin#order#particularOrder',[$order->user_id,$order->order_code]) }}">{{ $order->user_name }}</a>
                                </td>
                                <td><a href="{{ route('admin#order#particularOrder',[$order->user_id,$order->order_code]) }}">{{ $order->order_code }}</a></td>
                                <td>{{ $order->total_price }}</td>
                                <td>
                                    @if($order->status === '0'||$order->status === 0)
                                    pending
                                    @endif
                                    @if($order->status === '1' || $order->status === 1)
                                    success
                                    @endif
                                    @if($order->status === '2' || $order->status === 2)
                                    reject
                                    @endif
                                </td>
                                <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                <td >
                                    <div class="d-flex">
                                        <a href="{{ route('admin#order#changeStatus',[$order->id,'accept']) }}">
                                            <button class="btn btn-success btn-sm me-2"><i class='bx bxs-check-square'></i></button>
                                        </a>

                                        <a href="{{ route('admin#order#changeStatus',[$order->id,'decline']) }}">
                                            <button class="btn btn-danger btn-sm"><i class='bx bxs-x-square'></i></button>
                                        </a>
                                    </div>
                                </td>
                           </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-black p-4">
                    {{ $orders->links() }}
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


