@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                <h4>{{ session('success') }}</h4>
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h1><center>Product Listing</center></h1>
                    <a href="{{url('product/add')}}" title="Add Product" class="btn btn-primary padding-5 addCar"> Add Product</a> 
                    <button class="btn btn-success btn-sm" onclick="window.location.reload()">Refresh to Re-order</button> 
                </div>
                <br>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-bordered car-listing" id="product_listing" >
                        <thead>
                            <tr>
                                <th></th>
                                <th>No</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id='productListing-body'>
                          @if(count($product))
                          @php $i = 1; @endphp
                            @foreach($product as $val)
                                <tr id="tr_{{$val->id}}"  class="row1" data-id="{{ $val->id }}">
                                    <td class="pl-3"><i class="fa fa-sort"></i></td>
                                    <td>{{$i}}</td>
                                    <td>{{$val->title}}</td>
                                    <td>{{$val->name}}</td>
                                    <td>{{$val->price}}</td>
                                    <td>
                                        <a href="{{ route('products.edit',$val->id)}}" class="btn btn-primary">Edit</a>
                                        <button type="button" class="deleteProduct btn btn-danger" id='{{$val->id}}'>Delete</button>
                                    </td>
                                </tr>
                                @php
                                $i ++;
                                @endphp
                            @endforeach
                            @else
                            <h1>No data found</h1>
                            @endif  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
