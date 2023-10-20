@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- create offers --}}
        @if (session('createdOffers'))
        <div class="alert alert-success border border-dark alert-dismissible" role="alert">
            {{ session('createdOffers') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

         {{-- update offers --}}
         @if (session('updatedOffers'))
         <div class="alert alert-success border border-dark alert-dismissible" role="alert">
             {{ session('updatedOffers') }}
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
         @endif

         {{-- delete offers --}}
         @if (session('deletedOffers'))
         <div class="alert alert-danger border border-dark alert-dismissible" role="alert">
             {{ session('deletedOffers') }}
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
         @endif
      <div class="row">

        <div class="col-12">
          <div class="card mb-4">
                <div class="card-header row">
                    <h5 class="fs-4 col-lg-3 col-md-12 col-sm-12 text-md-start text-sm-start">
                       <a href="{{ route('admin#offers#list') }}" class="text-dark">
                        Offers List <span class="badge badge-center rounded-pill bg-label-primary">{{ $offers->total() }}</span>
                       </a>
                    </h5>
                   <div class="d-flex offset-lg-6 col-lg-3 col-md-12 col-sm-12 d-flex align-items-center" style="max-height: 5vh !important;" >
                        <a href="{{ route('admin#offers#createPage') }}" class="btn btn-sm btn-info me-1">
                            <i class='bx bx-message-alt-add'></i>
                        </a>
                        <form class=" justify-content-center" method="get"
                    action="{{ route('admin#offers#list') }}">
                            <div class="d-flex">
                                <input type="search" name="searchOffers" value="{{ request('searchOffers') }}" class="form-control form-control-sm">
                                <button type="submit" class="btn btn-sm btn-info ms">
                                    <i class='bx bx-search-alt-2'></i>
                                </button>
                            </div>
                        </form>
                   </div>
                </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Label Name</th>
                                <th>Description</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                           @foreach ($offers as $offer)
                           <tr class="table-primary">
                                <td>{{ $offer->id }}</td>
                                <td>
                                    <img src="{{ asset('storage/admin/offers/'.$offer->image )}}" width="150px">
                                </td>
                                <td>{{ $offer->label_name }}</td>
                                <td>{{ $offer->description }}</td>
                                <td>{{ $offer->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <div class="dropdown">
                                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                          <i class="bx bx-dots-vertical-rounded"></i>
                                          </button>
                                          <div class="dropdown-menu">
                                              <a class="dropdown-item"
                                              href="{{ route('admin#offers#update',$offer->id) }}">
                                                  <i class="bx bx-edit-alt me-1"></i> Edit
                                              </a>
                                              <a class="dropdown-item"
                                              href="{{ route('admin#offers#delete',$offer->id) }}">
                                                  <i class="bx bx-trash me-1"></i> Delete
                                              </a>
                                          </div>
                                    </div>
                                </td>
                           </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-black p-4">
                    {{ $offers->links() }}
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
