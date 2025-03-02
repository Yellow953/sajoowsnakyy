@extends('layouts.app')

@section('title', 'users')

@section('actions')
<a class="btn btn-success btn-sm px-4" href="{{ route('users.new') }}"><i class="fa-solid fa-plus"></i> <span
        class="d-none d-md-inline">New User</span></a>
<a class="btn btn-primary btn-sm px-4" href="{{ route('users.export') }}"><i class="fa-solid fa-download"></i><span
        class="d-none d-md-inline">Export to Excel</span></a>
@endsection

@section('filter')
<!--begin::filter-->
<div class="filter border-0 px-0 px-md-3 py-4">
    <!--begin::Form-->
    <form action="{{ route('users') }}" method="GET" enctype="multipart/form-data" class="form">
        @csrf
        <div class="pt-0 pt-3 px-2 px-md-4">
            <!--begin::Compact form-->
            <div class="d-flex align-items-center">
                <!--begin::Input group-->
                <div class="position-relative w-md-400px me-md-2">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input type="text" class="form-control ps-10" name="name" value="{{ request()->query('name') }}"
                        placeholder="Search By Name..." />
                </div>
                <!--end::Input group-->
                <!--begin:Action-->
                <div class="d-flex align-items-center">
                    <button type="submit" class="btn btn-primary me-5 px-3 py-2 d-flex align-items-center">
                        Search <span class="ml-2"><i class="fas fa-search"></i></span>
                    </button>
                    <a id="kt_horizontal_search_advanced_link" class="btn btn-link" data-bs-toggle="collapse"
                        href="#kt_advanced_search_form">Advanced Search</a>
                    <button type="reset" class="btn btn-danger clear-btn py-2 px-4 ms-3">Clear</button>
                </div>
                <!--end:Action-->
            </div>
            <!--end::Compact form-->
            <!--begin::Advance form-->
            <div class="collapse" id="kt_advanced_search_form">
                <!--begin::Separator-->
                <div class="separator separator-dashed mt-9 mb-6"></div>
                <!--end::Separator-->
                <!--begin::Row-->
                <div class="row g-8 mb-8">

                    <!--begin::Col-->
                    <div class="col-md-6">
                        <label class="fs-6 form-label fw-bold text-dark">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ request()->query('email') }}"
                            placeholder="Enter Email..." />
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-md-6">
                        <label class="fs-6 form-label fw-bold text-dark">Phone</label>
                        <input type="tel" class="form-control" name="phone" value="{{ request()->query('phone') }}"
                            placeholder="Enter Phone..." />
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-md-6">
                        <label class="fs-6 form-label fw-bold text-dark">Role</label>
                        <select name="role" class="form-select" data-control="select2" data-placeholder="Select a Role">
                            <option value=""></option>
                            @foreach ($roles as $role)
                            <option value="{{ $role }}" {{ request()->query('role') == $role ? 'selected' : '' }}>
                                {{ ucfirst($role) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Advance form-->
        </div>
    </form>
    <!--end::Form-->
</div>
<!--end::filter-->
@endsection

@section('content')
<div class="container">
    <!--begin::Tables Widget 10-->
    <div class="card mb-5 mb-xl-8">
        @yield('filter')

        <!--begin::Body-->
        <div class="card-body pt-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="text-center">
                            <th class="col-3 p-3">User</th>
                            <th class="col-3 p-3">Contact</th>
                            <th class="col-3 p-3">Role</th>
                            <th class="col-3 p-3">Actions</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-45px me-5">
                                        <img alt="user" src="{{ asset($user->image) }}" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{
                                            ucwords($user->name) }}</a>
                                    </div>
                                    <!--end::Name-->
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    {{ $user->email }} <br>
                                    {{ $user->phone }}
                                </div>
                            </td>
                            <td class="text-center">
                                <span
                                    class="badge {{ $user->role == 'admin' ? 'badge-light-success' : '' }} {{ $user->role == 'user' ? 'badge-light-primary' : '' }}">{{
                                    ucwords($user->role) }}</span>
                            </td>
                            <td class="d-flex justify-content-end border-0">
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="btn btn-icon btn-warning btn-sm me-1">
                                    <i class="bi bi-pen-fill"></i>
                                </a>
                                @if($user->can_delete())
                                <a href="{{ route('users.destroy', $user->id) }}"
                                    class="btn btn-icon btn-danger btn-sm show_confirm" data-toggle="tooltip"
                                    data-original-title="Delete User">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <th colspan="6">
                                <div class="text-center">No Users Yet ...</div>
                            </th>
                        </tr>
                        @endforelse
                    </tbody>
                    <!--end::Table body-->

                    <tfoot>
                        <tr>
                            <th colspan="6">
                                {{ $users->appends(['name' => request()->query('name'), 'email' =>
                                request()->query('email'), 'phone' => request()->query('phone'), 'role' =>
                                request()->query('role')])->links() }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
        <!--begin::Body-->
    </div>
    <!--end::Tables Widget 10-->
</div>
@endsection