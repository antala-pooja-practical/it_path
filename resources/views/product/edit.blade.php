@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h4><div class="card-header"><center>{{ __('Edit Product') }}</center></div></h4>
                <br>
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
                    <div class="row">
                        <div class="col-md-12 msg_display_div">
                           <div class="alert" id="msg_div" style="display:none">
                            <span id="res_message"></span>
                          </div>
                        </div>
                     </div>
                    <form method="POST" action="{{ route('products.update', $product->id) }}" id="productEdit" enctype="multipart/form-data">
                       {{ csrf_field() }}
                        <div class="form-group">
                            <label for="catname">Product Title<span class="require_field">*</span>:</label>
                            <input type="text" name="product_title" class="form-control" placeholder="Product Title" value="{{ $product->title }}">
                        </div>
                        <div class="form-group">
                            <label for="status">Category<span class="require_field">*</span>:</label>
                            <select class="category form-control" name="category">
                                <option value="">Select Status</option>
                                @if(count($category)>0)
                                @foreach($category as $key => $val)
                                <option value="{{$val->id}}" {{$val->id == $product->category_id?'selected':''}}>{{$val->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="catname">Description<span class="require_field">*</span>:</label>
                            <textarea class="form-control" col="4" name="description" placeholder="Enter Description">{{$product->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="catname">Price<span class="require_field">*</span>:</label>
                            <input type="text" name="price" class="form-control" value="{{ $product->price }}">
                        </div>
                        <div class="custom-file">
                            <label for="catname">Product Images<span class="require_field">*</span>:</label>
                            <input type="file" name="imageFile[]" class="custom-file-input" id="images" multiple="multiple">
                            <br>
                            @if($product->productImages)
                            <div class='row'>
                                @foreach($product->productImages as $image)
                                <div class="col-md-3">
                                    <img src="{{url('/uploads/'.$image->image)}}">
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                       <br>
                        <div class="form-group">
                            <button style="cursor:pointer" type="submit" class="btn btn-primary" id='cat_submit'>Submit</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{asset('/js/style.js?'.time())}}"></script>
@endsection