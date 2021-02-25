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
                <div class="card-heading border bottom">
                    <h4 class="card-title">Edit Product</h4>
                </div>
                <div class="card-block">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                                {!! Form::model($products, ['id'=>'form-validation', 'novalidate'=>"novalidate",'enctype'=>"multipart/form-data", 'method' => 'PATCH','route' => ['products.update', $products->id]]) !!}
									<div class="row">
                                        <div class="col-md-3">
                                        <div class="form-group required">
                                            {!! Form::Label('product_code', 'Product Code') !!}
                                            {!! Form::text('product_code', $products->product_code, ['class' => 'form-control','placeholder'=>'product Code','required','readonly']) !!}
                                        </div>
                                    </div>
									<div class="col-md-3">
										<div class="form-group required">
											{!! Form::Label('category_id', 'Category Name') !!}
											{!! Form::select('category_id', ['' => 'Select'] + $categories, null, array( 'class' => 'form-control customer_details','required')) !!}
										</div>
									</div>
									<div class="col-md-3">
                                        <div class="form-group required">
                                            {!! Form::Label('product_name', 'Product Name') !!}
                                            {!! Form::text('product_name', null, ['class' => 'form-control', 'placeholder'=>' Name','required']) !!}
                                        </div>
                                    </div>
									<div class="col-md-3">
                                        <div class="form-group required">
                                            {!! Form::Label('product_description','Product Description') !!}
                                            {!! Form::textarea('product_description',null,array('placeholder' => 'Product Description', 'class' => 'form-control','required','rows'=>'1')) !!}
                                        </div>
                                    </div>
                                    </div>
									<div class="row">
										<div class="col-md-3">
                                        <div class="form-group">
                                            {!! Form::Label('price', 'Original Price ') !!}
                                            {!! Form::text('price', null, ['class' => 'form-control', 'placeholder'=>'Original Price ']) !!}
                                        </div>
                                    </div>
									<div class="col-md-3">
                                        <div class="form-group">
                                            {!! Form::Label('discount','Discount') !!}
                                            {!! Form::text('discount', null, array('placeholder' => 'Discount','class' => 'form-control')) !!}
                                        </div>
                                    </div>
									<div class="col-md-3">
										<div class="form-group required">
											{!! Form::Label('quantity_id', 'Quantity Name') !!}
											{!! Form::select('quantity_id', ['' => 'Select'] + $quantities, null, array( 'class' => 'form-control customer_details','required')) !!}
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group required">
											{!! Form::Label('image_file', 'Upload Image') !!}
											<input type="file" name="image_file" placeholder="Upload Video" class="form-control" 
											<?php  if(!isset($products['image_file'])) {?> required <?php  } ?> >
										</div>
										<?php  if(isset($products['image_file'])  && !empty($products['image_file'])) {?>
											<img style="width:50%" src="{{ secure_asset('/storage/app/product_image_files/') }}/<?php echo $products['image_file']; ?>">
										<?php  }?>
									</div>
                                    <div class="row">
                                        <div class="col-md-12">
											{!! Form::hidden('id', $products->id, [ ]); !!}
											{!! Form::hidden('user_id', Auth::id(), ['class' => 'form-control', 'required']) !!}
                                            {!! Form::hidden('created_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
                                            {!! Form::hidden('updated_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
                                            {!! Form::hidden('created_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
                                            {!! Form::hidden('modified_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>
                                    <button class="btn btn-primary">Submit</button>
                                    <a href="{{ route('products.index')}}" class="btn btn-danger">Cancel</a>
                                    <button class="btn btn-default" type="reset">Reset</button>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection