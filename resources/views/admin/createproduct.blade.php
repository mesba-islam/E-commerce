@extends('admin.layouts.template')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Add Product</h4>

            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add new Product</h5>
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
                            <form action="{{ route('storeproduct') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Title</label>
                                    <input type="text" class="form-control" id="title" name="product_title"
                                        placeholder="T-shirt" />
                                </div>

                                <div class="mb-3">
                                    <label for="defaultSelect" class="form-label">Category</label>
                                    <select id="category_id" name="category_id" class="form-select">
                                    <option>Choose Category...</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach

                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="defaultSelect" class="form-label">SubCategory</label>
                                    <select id="subcategory" name="subcategory_id" class="form-select">
                                    <option>Choose Subcategory...</option>
                                    </select>
                                </div>

                                <div class="mb-3">

                                    <label for="formFile" class="form-label">Thumbnail</label>
                                    <input class="form-control" type="file" id="formFile" name="thumbnail">

                                </div>


                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Gallery</label>
                                    <input class="form-control" type="file" id="formFile" name="gallery" multiple>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Price</label>

                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control" placeholder="Amount" aria-label="Amount (to the nearest dollar)" name="price">
                                    <span class="input-group-text">.00</span>
                                  </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Sale Price ($)</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="text" class="form-control" placeholder="Amount" aria-label="Amount (to the nearest dollar)" name="sale_price">
                                            <span class="input-group-text">.00</span>
                                          </div>
                                        </div>

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">SKU</label>
                                    <input type="text" class="form-control" id="title" name="sku"
                                        placeholder="sku" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Description</label>
                                    <input type="text" class="form-control" id="title" name="description"
                                        placeholder="Description" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Quantity</label>
                                    <input type="text" class="form-control" id="title" name="quantity"
                                        placeholder="1.." />
                                </div>


                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="status" id="defaultCheck3" checked="">
                                    <label class="form-check-label" for="defaultCheck3"> Published </label>
                                  </div>


                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="featured" id="defaultCheck3" checked="">
                                    <label class="form-check-label" for="defaultCheck3"> Featured </label>
                                  </div>

                                  <br>
                                <button type="submit" class="btn btn-primary">Create</button>
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
                    url: "{{ route('ajax.subcat') }}",
                    data: {
                        'category_id': cat_id,
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
