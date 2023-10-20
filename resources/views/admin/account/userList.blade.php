@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-md-12">
            {{-- password change success --}}
            @if (session('accountDelete'))
                <div class="alert alert-danger border border-dark alert-dismissible" role="alert">
                    {{ session('accountDelete') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- change role --}}
            @if (session('changedRole'))
                <div class="alert alert-info border border-dark alert-dismissible" role="alert">
                    {{ session('changedRole') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

          <div class="card mb-4">
            <div class="card-header row">
                <h5 class="fs-4 col-lg-3 col-md-12 col-sm-12 text-md-center text-sm-center">
                   <a href="{{ route('admin#account#userList') }}" class="text-dark">
                    Admin & User List <span class="badge badge-center rounded-pill bg-label-primary">{{ $userList->total() }}</span></a>
                </h5>
               <form class="d-flex offset-lg-3 col-lg-6 col-md-12 col-sm-12 justify-content-end" style="max-height: 5vh !important;" action="{{ route('admin#account#userList') }}" method="get">
                    <div class="d-flex me-1" >
                        <select name="sortUser" class="form-control form-control-sm">
                            <option value="all" @if (request('sortUser') === 'all') selected @endif>Default</option>
                            <option value="admin" @if (request('sortUser') === 'admin') selected @endif>Admin</option>
                            <option value="user" @if (request('sortUser') === 'user') selected @endif>User</option>
                        </select>
                        <button class="btn btn-sm btn-info" type="submit">
                            <i class='bx bx-sort'></i>
                        </button>
                    </div>
                    <div class="d-flex">
                        <input type="search" name="searchUser" value="{{ request('searchUser') }}" class="form-control form-control-sm">
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
                          <th>Image</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>Role</th>
                          <th>Gender</th>
                          <th>Join Date</th>
                          <th>Edit</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        @foreach ($userList as $user)
                        <tr class="table-primary">
                            <td>
                                <img
                                @if ($user->image === null)
                                    @if ($user->gender === 'male')
                                        src="{{ asset('user_male_default.png') }}"
                                    @elseif ($user->gender === 'female')
                                        src="{{ asset('default_user_female.svg') }}"
                                    @endif
                                @else
                                    src="{{ asset('storage/admin/account/'.$user->image )}}"
                                @endif
                                width="80px"
                                >
                            </td>
                            <td>
                              <strong>{{ Str::ucfirst($user->name) }}</strong>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->role }}</td>
                            <td class="col-1">{{ $user->gender }}</td>
                            <td>{{ $user->created_at->format('d-m-Y') }}</td>
                            <td>
                              @if ($user->id === Auth::user()->id)
                              <span class="badge bg-label-success me-1">Current</span>
                              @elseif ($user->id === 1 || $user->id === '1')
                                @if($user->id === Auth::user())
                                    <span class="badge bg-label-success me-1">Current</span>
                                @else
                                    <span class="badge bg-label-success me-1">Root</span>

                                @endif
                              @else
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        @if (!($user->id === 1 || $user->id === '1'))
                                            <a class="dropdown-item"
                                            href="{{ route('admin#account#profileViaList',$user->id)}}">
                                                <i class="bx bx-edit-alt me-1"></i> View
                                            </a>
                                        @endif
                                        @if (!($user->id === 1 || $user->id === '1'))
                                            <a class="dropdown-item" href="{{ route('admin#account#delete',$user->id) }}">
                                                <i class="bx bx-trash me-1"></i> Delete
                                            </a>
                                        @endif
                                        @if (!($user->id === 1 || $user->id === '1'))
                                            @if ($user->role === 'admin')
                                            <a class="dropdown-item" href="{{ route('admin#account#changeRole',$user->id)}}">
                                                <i class='bx bxs-down-arrow me-1'></i> Degrade to User
                                            </a>
                                            @else
                                                <a class="dropdown-item" href="{{ route('admin#account#changeRole',$user->id)}}">
                                                    <i class='bx bxs-up-arrow me-1'></i>  Promote to Admin
                                                </a>
                                            @endif
                                        @endif

                                    </div>
                                </div>
                              @endif
                            </td>
                            {{-- <td>
                                <span class="badge bg-label-success me-1">Active</span>
                            </td> --}}
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
            <div class="text-black p-4">
                {{ $userList->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
</div>
@endsection
