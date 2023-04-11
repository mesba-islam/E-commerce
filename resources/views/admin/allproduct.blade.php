@extends('admin.layouts.template')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> All Products</h4>
            <div class="content-wrapper">
                <div class="card">
                    <h5 class="card-header">Product Details</h5>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="text-nowrap">
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>Thumbnail</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                              @foreach ($products as $product)
                                    <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><img src="{{ asset($product->thumbnail) }}" width="90" height="90"></strong></td>
                                     <td>{{ $product->product_title }}</td>
                                     <td>{{ $product->category->category_name }}</td>
                                     <td>{{ $product->price }}</td>
                                     <td>{{ $product->quantity }}</td>
                                     <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('edit.product', $product->id) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="{{ route('delete.product', $product->id) }}"><i
                                                        class="bx bx-trash me-1"></i> Delete</a>
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
