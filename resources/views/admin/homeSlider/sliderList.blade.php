@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- create offers --}}
        @if (session('createdSlider'))
        <div class="alert alert-success border border-dark alert-dismissible" role="alert">
            {{ session('createdSlider') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

         {{-- update offers --}}
         @if (session('updatedSliders'))
         <div class="alert alert-success border border-dark alert-dismissible" role="alert">
             {{ session('updatedSliders') }}
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
         @endif

         {{-- delete offers --}}
         @if (session('deletedSlider'))
         <div class="alert alert-danger border border-dark alert-dismissible" role="alert">
             {{ session('deletedSlider') }}
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
         @endif
      <div class="row">

        <div class="col-12">
          <div class="card mb-4">
                <div class="card-header row">
                    <h5 class="fs-4 col-lg-3 col-md-12 col-sm-12 text-md-start text-sm-start">
                        <a href="{{ route('admin#homeSliders#list') }}" class="text-dark">
                            Slider List <span class="badge badge-center rounded-pill bg-label-primary">{{ $sliders->total() }}</span>
                        </a>
                    </h5>
                   <div class="d-flex offset-lg-6 col-lg-3 col-md-12 col-sm-12 d-flex align-items-center" style="max-height: 5vh !important;" >
                        <a href="{{ route('admin#homeSliders#createPage') }}" class="btn btn-sm btn-info me-1">
                            <i class='bx bx-message-alt-add'></i>
                        </a>
                        <form class=" justify-content-center" method="get"
                    action="{{ route('admin#homeSliders#list') }}">
                            <div class="d-flex">
                                <input type="search" name="searchSlider" value="{{ request('searchSlider') }}" class="form-control form-control-sm">
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
                                <th>Title</th>
                                <th>Category</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                           @foreach ($sliders as $slider)
                           <tr class="table-primary">
                                <td>{{ $slider->id }}</td>
                                <td>
                                    <img src="{{ asset('storage/admin/homeSliders/'.$slider->image )}}" width="150px">
                                </td>
                                <td>{{ $slider->title }}</td>
                                <td>{{ $slider->category_name }}</td>
                                <td>{{ $slider->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <div class="dropdown">
                                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                          <i class="bx bx-dots-vertical-rounded"></i>
                                          </button>
                                          <div class="dropdown-menu">
                                              <a class="dropdown-item"
                                              href="{{ route('admin#homeSliders#update',$slider->id) }}">
                                                  <i class="bx bx-edit-alt me-1"></i> Edit
                                              </a>
                                              <a class="dropdown-item"
                                              href="{{ route('admin#homeSliders#delete',$slider->id) }}">
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
                    {{ $sliders->links() }}
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
