@extends('admin.layouts.template')

@section('content')

<?php
    $categories = DB::table('categories')->get();
    $subcategory = DB::table('sub_categories')->get();
?>
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Edit Product</h4>

            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Edit new Product</h5>
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
                            <form action="{{ route('update.product', ['id' => $product_info->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Title</label>
                                    <input type="text" class="form-control" id="title" name="product_title"
                                        placeholder="T-shirt" value="{{ $product_info->product_title }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="defaultSelect" class="form-label">Category</label>
                                    <select id="category_id" name="category_id" class="form-select">
                                        <option>Choose Category...</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $product_info->category_id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="defaultSelect" class="form-label">SubCategory</label>
                                    <select id="subcategory_id" name="subcategory_id" class="form-select">
                                    <option>Choose Subcategory...</option>
                                    @foreach ($subcategory as $subcategory)
                                        <option value="{{ $subcategory->id }}" {{ $subcategory->id == $product_info->subcategory_id ? 'selected' : '' }}>{{ $subcategory->subcategory_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">

                                    <label for="formFile" class="form-label">Thumbnail</label>
                                    <input class="form-control" type="file" id="formFile" name="thumbnail" value="{{ $product_info->thumbnail }}">

                                </div>

                                <div class="mb-3">
                                    <strong><img src="{{ asset($product_info->thumbnail) }}" width="90" height="90"></strong>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Gallery</label>
                                    <input class="form-control" value="{{ $product_info->gallery }}" type="file" id="formFile" name="gallery" multiple>
                                </div>
                                <div class="mb-3">
                                <strong><img src="{{ asset($product_info->gallery) }}" width="90" height="90"></strong>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Price</label>

                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control" placeholder="Amount" value="{{ $product_info->price }}" aria-label="Amount (to the nearest dollar)" name="price">
                                    <span class="input-group-text">.00</span>
                                  </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Sale Price ($)</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="text" class="form-control" value="{{ $product_info->sale_price }}" placeholder="Amount" aria-label="Amount (to the nearest dollar)" name="sale_price">
                                            <span class="input-group-text">.00</span>
                                          </div>
                                        </div>

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">SKU</label>
                                    <input type="text" class="form-control" id="title" name="sku"
                                        placeholder="sku" value="{{ $product_info->sku }}"/>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Description</label>
                                    <input type="text" class="form-control" id="title" name="description"
                                        placeholder="Description" value="{{ $product_info->description }}"/>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Quantity</label>
                                    <input type="text" class="form-control" id="title" name="quantity"
                                        placeholder="1.." value="{{ $product_info->quantity }}"/>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $product_info->status != null ? 1 : 0 }}" name="status" id="defaultCheck3" {{ $product_info->status != null ? 'checked' : '' }}>
                                    <label class="form-check-label" for="defaultCheck3"> Published </label>
                                  </div>



                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $product_info->featured != null ? 1 : 0 }}" name="featured" id="defaultCheck3" {{ $product_info->featured != null ? 'checked' : '' }}>
                                    <label class="form-check-label" for="defaultCheck3"> Featured </label>
                                  </div>



                                <button type="submit" class="btn btn-primary">submit</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <script>


            $('#category_id').on('change',function(e){
                // console.log(e);

                var cat_id = e.target.value;



                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'POST',
                    dataType: 'json',
                    url: "{{ route('ajax.subcategory') }}",
                    data: {
                        'category_id': cat_id,
                        'subcategory_id': subcategory_id
                    },
                    success: function (result) {
                        console.log(result);

                        $("#subcategory").html(result.message)

                    },
                    error: function (e) {
                        console.log(e);
                    }
                });

                // $.get('/ajax-subcat?cat_id=' + cat_id, function(data){
                //     console.log(data);
                // });
            });
        </script>
    @endsection
