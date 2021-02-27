@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-info" href="{{ route('users.index') }}">  <i class="fa fa-arrow-circle-left"></i> User Information </a>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-stripped">
                <tbody>
                    <tr>
                        <td class=''><b>Role</b></th>
                        <td class=''>@if ($user->roles) @foreach ($user->roles as $key => $role) <span class="label label-primary">{{ $role['name'] }}</span> @endforeach @endif</td>
						<td class=''><b>User Name</b></th>
                        <td class=''>{{ $user['user_name'] }}</td>
					</tr>
                    <tr>
						<td class=''><b>First Name</b></th>
                        <td class=''>{{ $user['f_name'] }}</td>
                        <td class=''><b>Middle Name</b></th>
                        <td class=''>{{ $user['m_name'] }}</td>
                    </tr>
					<tr>
						<td class=''><b>Last Name</b></th>
                        <td class=''>{{ $user['l_name'] }}</td>
						<td class=''><b>Email</b></th>
                        <td class=''>{{ $user['email'] }}</td>
                    </tr>
                    <tr>
                        <td class=''><b>Mobile</b></th>
                        <td class=''>{{ $user['mobile_no'] }}</td>
						<td class=''><b>Mobile 2</b></th>
                        <td class=''>{{ $user['mobile_number_second'] }}</td>
                    </tr>
                    <tr>
                        <td class=''><b>DOB</b></th>
                        <td class=''>{{ $user['dob'] }}</td>
						<td class=''><b>Date of Joining</b></th>
                        <td class=''>{{ $user['date_of_joining'] }}</td>
                    </tr>
					<tr>
                        <td class=''><b>Country of Employment</b></th>
                        <td class=''>@if($user->users_countries_of_employments) @foreach ($user->users_countries_of_employments as $key => $country) <span class="label label-primary">{{ $country['name'] }}</span> @endforeach @endif</td>
						<td class=''><b>Languages to Speak</b></th>
                        <td class=''>@if($user->users_languages_to_speaks) @foreach ($user->users_languages_to_speaks as $key => $language) <span class="label label-primary">{{ $language['name'] }}</span> @endforeach @endif</td>
					</tr>
                    <tr>
                        <td class=''><b>Created At</b></th>
                        <td class=''>{{ $user['created_at'] }}</td>
						<td class=''><b>Modified At</b></th>
                        <td class=''>{{ $user['updated_at'] }}</td>
                    </tr>
                    <tr>
						<th class=''><b>Status</b></th>
						<td class=''>
									@if ($user->status == 1) <span class="text-success"><i class="fa fa-check"></i> Active</span> @endif
									@if ($user->status == 2) <span class="text-danger"><i class="fa fa-times"></i> Suspend</span> @endif
									@if ($user->status == 3) <span class="text-danger"><i class="fa fa-times"></i> Resigned</span> @endif	
									@if ($user->status == 4) <span class="text-warning"><i class="fa fa-times"></i> Hold</span> @endif
						</td>				
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
	<?php if($isUpdateStatusFlag == true){?>
	@if (count($user['user_remark_details']) > 0)
								<div class="row">
									<div class="col-lg-12">
										<div class="card widget-feed">
											<ul class="feed-action border bottom">
												<li>
													<a href="">
														<i class="ti-comments text-primary pdd-right-5"></i>
														<span>Remarks <strong style="color:red;">( {{ count($user['user_remark_details']) }} )</strong></span>
													</a>
												</li>
											</ul>
											<div class="feed-footer">
												<div class="comment">
													<ul class="list-unstyled list-info" style="overflow: auto">
														@foreach ($user['user_remark_details'] as $key=> $remarks)
														<li class="comment-item">
															<div class="info">
																<p class="width-80">On {{ $remarks->created_at->format('j F Y') }},{{ isset($userMasters[$remarks['user_id']]) ? ucfirst($userMasters[$remarks['user_id']]) : "" }} wrote as follows</p>
																<p class="width-80"><span>{{ $remarks->remarks }}</span></p>
															</div>
														</li>
														@endforeach
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
								@endif
								{!! Form::model($user, ['id'=>'form-validation', 'novalidate'=>"novalidate",'method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                                <div class="row">
									<div class="col-md-6">
                                        <div class="form-group">
											{!! Form::hidden('id', $user->id, [ ]); !!}
											{!! Form::hidden('update_remarks', 1, [ ]); !!}
											{!! Form::Label('active', 'Status') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('status', '1', true, ['class'=>'radio','id'=>'rad1']) }}
                                                        <label for="rad1">Active</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('status', '2', true, ['class'=>'radio','id'=>'rad2']) }}
                                                        <label for="rad2">Suspend</label>
                                                    </div>
													<div class="radio radio-inline">
                                                        {{ Form::radio('status','3', true, ['class'=>'radio','id'=>'rad3']) }}
                                                        <label for="rad3">Resigned</label>
                                                    </div>
													<div class="radio radio-inline">
                                                        {{ Form::radio('status', '4', true, ['class'=>'radio','id'=>'rad4']) }}
                                                        <label for="rad4">Hold</label>
                                                    </div>
                                               </div>
                                        </div>
                                    </div>
								</div>
								<div class="row">
                                    <div class="col-md-6">
										<div class="form-group required">
											{!! Form::Label('keywords', 'Remarks') !!}
											<textarea id="remarks" class="form-control" id="body" rows="1" name="remarks" "data-role"="tagsinput" required><?php //echo isset($users->remarks) ? $users->remarks : ""; ?></textarea>
										</div>
                                    </div>
                                </div>
	
                                {!! Form::hidden('updated_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
                                {!! Form::hidden('created_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
                                {!! Form::hidden('modified_by', Auth::id(), ['class' => 'form-control', 'required']) !!}	
								<button class="btn btn-primary">Submit</button>
                                <a href="{{ route('users.index')}}" class="btn btn-danger">Cancel</a>
                                <button class="btn btn-default">Reset</button>
                                {!! Form::close() !!}
							<?php }?>
@endsection