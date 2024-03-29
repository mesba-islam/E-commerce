@extends('admin.layouts.template')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Edit Category</h4>

            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Edit Category</h5>
                            <small class="text-muted float-end">Input details</small>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('update.coupon', ['id' => $coupons->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $coupons->id }}" name="coupon">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Coupon code</label>
                                    <input type="text" class="form-control" id="coupon" name="coupon"
                                        value="{{ $coupons->coupon }}" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Discount</label>
                                    <input type="text" class="form-control" id="discount" name="discount"
                                        value="{{ $coupons->discount }}" />
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    @endsection
