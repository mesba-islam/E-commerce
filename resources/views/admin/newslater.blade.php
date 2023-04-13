@extends('admin.layouts.template')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Newslaters</h4>
            <div class="content-wrapper">
                <div class="card">
                    <h5 class="card-header">Details</h5>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="text-nowrap">
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">

                                    @foreach ($newslaters as $newslater)
                                    <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $newslater->id }}</strong></td>
                                     <td>{{ $newslater->email }}</td>
                                     <td>{{ $newslater->created_at }}</td>
                                     <td>{{ $newslater->updated_at }}</td>
                                     <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                {{-- <a class="dropdown-item" href="{{ route('edit.coupon', $coupon->id) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="{{ route('delete.coupon', $coupon->id) }}"><i
                                                        class="bx bx-trash me-1"></i> Delete</a> --}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        @endsection
