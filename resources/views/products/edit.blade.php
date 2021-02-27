@extends('layouts.default')

@section('content')
<style>
.label-info {background-color: #2bafff !important;}
</style>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-info" href="{{ route('products.index') }}"> <i class="fa fa-arrow-circle-left"></i> Back To Listing </a>
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-7">
                                <h4 class="card-title">Add Product</h4>
                                {!! Form::model($products, ['id'=>'form-validation', 'novalidate'=>"novalidate",'enctype'=>"multipart/form-data",'class'=>'form-horizontal mrg-top-40 pdd-right-30', 'method' => 'PATCH','route' => ['products.update', $products->id]]) !!}
                                <div class="form-group row">
                                    <label for="form-1-1" class="col-md-2 control-label">Title</label>
                                    <div class="col-md-10">
                                        {!! Form::text('product_name', null, ['class' => 'form-control', 'placeholder'=>'The product title to be displayed on the Shop Page and Product Page.','required']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-1-1" class="col-md-2 control-label">Meta Title</label>
                                    <div class="col-md-10">
                                        {!! Form::text('meta_title', null, ['class' => 'form-control', 'placeholder'=>'The meta title to be used for browser title and SEO.']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-1-1" class="col-md-2 control-label">Slug URL</label>
                                    <div class="col-md-10">
                                        {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder'=>'The slug to form the URL.']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-1-1" class="col-md-2 control-label">SKU</label>
                                    <div class="col-md-10">
                                        {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder'=>'The Stock Keeping Unit to track the product inventory.']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-1-1" class="col-md-2 control-label">Product Code</label>
                                    <div class="col-md-10">
                                        {!! Form::text('product_code', null, ['class' => 'form-control','placeholder'=>'product Code','required','readonly']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-1-1" class="col-md-2 control-label">Category</label>
                                    <div class="col-md-10">
                                        {!! Form::select('category_id', ['' => 'Select'] + $categories, null, array( 'class' => 'form-control customer_details','required')) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-1-1" class="col-md-2 control-label">Sub Category</label>
                                    <div class="col-md-10">
                                        {!! Form::select('sub_category_id', ['' => 'Select'] + $sub_categories, null, array( 'class' => 'form-control customer_details','required')) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-1-1" class="col-md-2 control-label">Price</label>
                                    <div class="col-md-10">
                                        {!! Form::text('price', null, ['class' => 'form-control', 'placeholder'=>'The price of the product.','required']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-1-1" class="col-md-2 control-label">Discount</label>
                                    <div class="col-md-10">
                                        {!! Form::text('discount', null, ['class' => 'form-control', 'placeholder'=>'The discount on the product.','required']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-1-1" class="col-md-2 control-label">Quantity</label>
                                    <div class="col-md-10">
                                        {!! Form::text('quantity', null, ['class' => 'form-control', 'placeholder'=>'The available quantity of the product.','required']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-1-1" class="col-md-2 control-label">Product Description</label>
                                    <div class="col-md-10">
                                        {!! Form::textarea('product_description',null,array('placeholder' => 'Product Description', 'class' => 'form-control','required','rows'=>'1')) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="form-1-1" class="col-md-2 control-label">Upload Image</label>
                                    <div class="col-md-10">
                                            <input type="file" name="image_file" placeholder="Upload Video" class="form-control" 
                                            <?php  if(!isset($products['image_file'])) {?> required <?php  } ?> >
                                    </div>
                                    <?php  if(isset($products['image_file'])  && !empty($products['image_file'])) {?>
                                            <img style="width:50%" src="{{ secure_asset('/storage/app/product_image_files/') }}/<?php echo $products['image_file']; ?>">
                                    <?php  }?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-10">
                                        {!! Form::hidden('id', $products->id, [ ]); !!}
                                        {!! Form::hidden('status', 1, ['class' => 'form-control', 'required']) !!}
                                        {!! Form::hidden('created_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
                                        {!! Form::hidden('updated_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
                                        {!! Form::hidden('created_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
                                        {!! Form::hidden('updated_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
                                        <button class="btn btn-primary">Submit</button>
                                        <a href="{{ route('products.index')}}" class="btn btn-danger">Cancel</a>
                                        <button class="btn btn-default" type="reset">Reset</button>
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>      
@endsection