@extends('layouts.master')
@section('content')
<style type="text/css">
	.table > thead > tr > th {padding: 5px;}
	.table > tbody > tr > td {padding: 8px;}
</style>
@if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-heading border bottom">
                    <h4 class="card-title">Farmer Information</h4>
                </div>
                <div class="card-block">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                                {!! Form::open(['route' => 'farmer_informations.store', 'method' => 'POST', 'role'=>'form','enctype'=>"multipart/form-data",'id'=>'form-validation', 'novalidate'=>"novalidate"]) !!}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group required">
                                                {!! Form::Label('farmer_name','Farmer Name') !!}
                                                {!! Form::text('farmer_name',isset($farmer_information[0]->farmer_name)?$farmer_information[0]->farmer_name:"" ,['class'=>'form-control','placeholder'=>'Farmer Name']) !!}
                                            </div>
                                        </div>
										<div class="col-md-4">
                                            <div class="form-group required">
                                                {!! Form::Label('village_name', 'Address') !!}
                                                {!! Form::text('address',isset($farmer_information[0]->address)?$farmer_information[0]->address:"",['class' => 'form-control', 'placeholder'=>'Address', 'required']) !!}
                                            </div>
                                        </div>
										<div class="col-md-4">
                                            <div class="form-group required">
                                                {!! Form::Label('work_name', 'Work Name') !!}
                                                {!! Form::text('work_name',null,['class' => 'form-control', 'placeholder'=>'Work', 'required']) !!}
                                            </div>
                                        </div>
                                    </div>
									<div class="row">
										<div class="col-md-4">
                                            <div class="form-group required">
                                                {!! Form::Label('mobile','Mobile') !!}
                                                {!! Form::text('mobile',isset($farmer_information[0]->mobile)?$farmer_information[0]->mobile:"" ,['class' => 'form-control', 'placeholder'=>'Mobile','required']) !!}
                                            </div>
                                        </div>
										<div class="col-md-4">
                                            <div class="form-group required">
                                                {!! Form::Label('mobile','Email') !!}
                                                {!! Form::text('email',isset($farmer_information[0]->email)?$farmer_information[0]->email:"",['class' => 'form-control', 'placeholder'=>'Email','required']) !!}
                                            </div>
                                        </div>
										<div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::Label('pin','Pin') !!}
                                                {!! Form::text('pin',null,['class' => 'form-control', 'placeholder'=>'pin']) !!}
                                            </div>
                                        </div>
                                    </div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group required">
												{!! Form::Label('work_category_name', 'Work Category') !!}
												{!! Form::select('work_category_name',['' => 'Select'] + $workerCategories, null, array( 'class' => 'form-control','required')) !!}
											</div>
										</div>
										<div class="col-md-4">
                                            <div class="form-group required">
                                                {!! Form::Label('work_date_from','Work Date From') !!}
                                                {!! Form::text('work_date_from',null,['class' => 'form-control date', 'placeholder'=>'Work Date From','required']) !!}
                                            </div>
                                        </div>
										<div class="col-md-4">
                                            <div class="form-group required">
                                                {!! Form::Label('work_date_to','Work Date To') !!}
                                                {!! Form::text('work_date_to',null,['class' => 'form-control date', 'placeholder'=>'Work Date To','required']) !!}
                                            </div>
                                        </div>
                                    </div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												{!! Form::Label('required_workers_count', 'Required Workers Count') !!}
												{!! Form::text('required_workers_count',null,array('class' => 'form-control')) !!}
											</div>
										</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            {!! Form::hidden('status',1,['class' => 'form-control', 'required']) !!}
											{!! Form::hidden('is_form_submit_from_sales',1,['class' => 'form-control', 'required']) !!}
                                            {!! Form::hidden('created_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
                                            {!! Form::hidden('updated_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
                                            {!! Form::hidden('created_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
											{!! Form::hidden('created_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
											{!! Form::hidden('farmer_user_id', Auth::id(), ['class' => 'form-control', 'required']) !!}
										</div>
                                    </div>
                                    <button class="btn btn-primary">Submit</button>
                                    <button class="btn btn-default" type="reset">Reset</button>
                                <!-- </form> -->
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
    </div>
	<script type="text/javascript">
	$(".HideVoiceOverTab").css({'display':'none'});	
	 $("input[name='is_main_person']").on('change', function(){
            if(this.value == 1){
                $(".HideVoiceOverTab").css({'display':'none'});	
            }else{
                $(".HideVoiceOverTab").css({'display':'block'});
            }
        });
  </script>  
@endsection