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
                    <h4 class="card-title">Worker Information</h4>
                </div>
                <div class="card-block">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                                {!! Form::open(['route' => 'worker_informations.store', 'method' => 'POST', 'role'=>'form','enctype'=>"multipart/form-data",'id'=>'form-validation', 'novalidate'=>"novalidate"]) !!}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group required">
                                                {!! Form::Label('worker_name', 'Worker Name') !!}
                                                {!! Form::text('worker_name',null,['class' => 'form-control', 'placeholder'=>'Worker Name', 'required']) !!}
                                            </div>
                                        </div>
										<div class="col-md-4">
                                            <div class="form-group required">
                                                {!! Form::Label('village_name', 'Village Name') !!}
                                                {!! Form::text('village_name',null,['class' => 'form-control', 'placeholder'=>'Village Name', 'required']) !!}
                                            </div>
                                        </div>
										<div class="col-md-4">
                                            <div class="form-group required">
                                                {!! Form::Label('tale_name', 'Taluka Name') !!}
                                                {!! Form::text('tale_name',null,['class' => 'form-control', 'placeholder'=>'Worker Name', 'required']) !!}
                                            </div>
                                        </div>
                                    </div>
									<div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group required">
                                                {!! Form::Label('district_name', 'District Name') !!}
                                                {!! Form::text('district_name',null,['class' => 'form-control', 'placeholder'=>'District Name', 'required']) !!}
                                            </div>
                                        </div>
										<div class="col-md-4">
                                            <div class="form-group required">
                                                {!! Form::Label('education', 'Education') !!}
                                                {!! Form::text('education',null,['class' => 'form-control', 'placeholder'=>'Education', 'required']) !!}
                                            </div>
                                        </div>
										<div class="col-md-4">
                                            <div class="form-group required">
                                                {!! Form::Label('gender','Gender') !!}
												{!! Form::select('gender',['Female'=>"Female",'Male'=>"Male"], null, array( 'class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                    </div>
									<div class="row">
										<div class="col-md-4">
                                            <div class="form-group required">
                                                {!! Form::Label('mobile','Mobile') !!}
                                                {!! Form::text('mobile',null,['class' => 'form-control', 'placeholder'=>'Mobile','required']) !!}
                                            </div>
                                        </div>
										<div class="col-md-4">
                                            <div class="form-group required">
                                                {!! Form::Label('pin','Pin') !!}
                                                {!! Form::text('pin',null,['class' => 'form-control', 'placeholder'=>'pin','required']) !!}
                                            </div>
                                        </div>
										<div class="col-md-4">
											<div class="form-group">
												{!! Form::Label('status', 'Mukadam') !!}
												<div class="col-md-10">
													<div class="radio radio-inline">
														{{ Form::radio('is_main_person', '0', true, ['class'=>'radio','id'=>'rad1is_main_person']) }}
														<label for="rad1is_main_person">No</label>
													</div>
													<div class="radio radio-inline">
														{{ Form::radio('is_main_person', '1', true, ['class'=>'radio','id'=>'rad2is_main_person']) }}
														<label for="rad2is_main_person">Yes</label>
													</div>
												</div>
											</div>
										</div>
                                    </div>
									<div class="row">
										<div class="col-md-3 HideVoiceOverTab">
											<div class="form-group">
												{!! Form::Label('mukadam_user_id', 'Mukadam List') !!}
												{!! Form::select('mukadam_user_id',['' => 'Select'] + $users, null, array( 'class' => 'form-control')) !!}
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												{!! Form::Label('aadhar_card_number', 'Aadhar Card  Number') !!}
												{!! Form::text('aadhar_card_number',null,['class' => 'form-control', 'placeholder'=>'Aadhar Card  Number']) !!}
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												{!! Form::Label('aadhar_card_image_file', 'Aadhar Card Photo') !!}
												<input type="file" name="aadhar_card_image_file" placeholder="Upload Video" class="form-control" 
												<?php  if(!isset($worker_informations['aadhar_card_image_file'])) {?>  <?php  } ?>>
											</div>
										</div>
										<div class="col-md-3">  
										<?php  if(isset($worker_informations['aadhar_card_image_file'])  && !empty($worker_informations['aadhar_card_image_file'])) {?>
											<a class="btn btn-info btn-sm" href="{{ secure_asset('/storage/app/aadhar_cards/') }}/{{ $worker_informations['aadhar_card_image_file'] }}" target="_blank"><i class="fa fa-file-audio-o"></i> Download Video Attachment</a>
										<?php  }?>
										</div>
                                    </div>
									<h4>Categories</h4>
									<div class="row">
                                        <div class="col-md-12">
											<?php foreach($categories as $key => $ctgData){?>
                                            <div class="form-group">
                                                <span class="label label-primary"><i><?php echo $ctgData['name']; ?></i></span>
												{!! Form::hidden('data[worker_information]['.$key.'][category_id]',$ctgData['id'],['class' => 'form-control']) !!}
												{!! Form::hidden('data[worker_information]['.$key.'][id]',null,['class' => 'form-control']) !!}
                                                <?php foreach($ctgData['categories_cultivations'] as $inner_key => $cultiData){?>
													<div class="checkbox checkbox-inline checkbox-primary">
                                                        <input id="cultivation-<?php echo $key; ?>-<?php echo $cultiData['id']; ?>" name="data[worker_information][<?php echo $key; ?>][worker_information_details][][cultivation_id]" type="checkbox" value="<?php echo $cultiData['id']; ?>" <?php if(isset($work_categories[$ctgData['id']][$cultiData['id']])) { echo "checked"; } ?> >
                                                        <label for="cultivation-<?php echo $key; ?>-<?php echo $cultiData['id']; ?>"><?php echo $cultiData['name']; ?></label>
                                                    </div>
												<?php }?>
                                            </div>
											<?php }?>
                                        </div>
									</div>	
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::Label('status', 'Active') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('status', '0', true, ['class'=>'radio','id'=>'rad1']) }}
                                                        <label for="rad1">No</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('status', '1', true, ['class'=>'radio','id'=>'rad2']) }}
                                                        <label for="rad2">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
                                            {!! Form::hidden('created_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
                                            {!! Form::hidden('updated_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
                                            {!! Form::hidden('created_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
											{!! Form::hidden('user_id', Auth::id(), ['class' => 'form-control', 'required']) !!}
											{!! Form::hidden('is_form_submit_from_sales',1,['class' => 'form-control', 'required']) !!}
											{!! Form::hidden('updated_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
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