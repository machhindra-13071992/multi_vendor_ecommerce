@extends('layouts.default')
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
                    <h4 class="card-title">User Transactions</h4>
                </div>
				<div class="card-block">
					<div class="row">
						<div class="col-md-12 ml-auto mr-auto">
							{!! Form::open(['route' => 'post_wallet_transaction', 'method' => 'POST', 'role'=>'form','enctype'=>"multipart/form-data",'id'=>'form-validation', 'novalidate'=>"novalidate"]) !!}
								<div class="row">
									<div class="col-md-4">
										<div class="form-group required">
											{!! Form::Label('amount', 'Amount') !!}
											{!! Form::text('amount',0,['class' => 'form-control', 'placeholder'=>'Enter Amount', 'required']) !!}
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											{!! Form::Label('is_deposite', 'Money') !!}
											<div class="col-md-10">
												<div class="radio radio-inline">
													{{ Form::radio('is_deposite', '0', true, ['class'=>'radio','id'=>'rad1']) }}
													<label for="rad1">Withdraw</label>
												</div>
												<div class="radio radio-inline">
													{{ Form::radio('is_deposite', '1', true, ['class'=>'radio','id'=>'rad2']) }}
													<label for="rad2">Deposite</label>
												</div>
											</div>
										</div>
										{!! Form::hidden('created_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
										{!! Form::hidden('updated_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
										{!! Form::hidden('user_id',$user_id,['class' => 'form-control', 'required']) !!}
									</div>
								</div>
								<button class="btn btn-primary">Add Amount</button>
								<button class="btn btn-default" type="reset">Reset</button>
							{{ Form::close() }}
						</div>
					</div>
				</div>
				<div class="card-block">
				<h4 class="card-title">User Transactions</h4>
				<div class="table-overflow">
				{!! $user_money_transactions->links() !!}
				<table class="table table-bordered table-hover table-sm">
					<thead>
						<tr>
							<th>Date</th>
							<th>Amount</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						@if($user_money_transactions)
							@php $total_amount=0 @endphp
							@foreach($user_money_transactions as $wallet_info)
							<tr>
								<td>{{ $wallet_info['created_at'] }}</td>
								<td>{{ $wallet_info['amount'] }}</td>
								<td>
									@php 
									if($wallet_info['is_deposite'] == '1'){ $total_amount += $wallet_info['amount']; echo "<span class='text-success'><i class='fa fa-plus-circle'></i> credited</span>"; } 
									if($wallet_info['is_deposite'] == '0'){ $total_amount -= $wallet_info['amount']; echo "<span class='text-danger'><i class='fa fa-minus-circle'></i> debited</span>"; } 
									@endphp
								</td>
							</tr>
						@endforeach
						@endif
					</tbody>
					<tfoot>
						<tr>
							<td></td>
							<td colspan="2"><b>{{ $total_amount }}</b></td>
						</tr>
					</tfoot>
				</table>
				{!! $user_money_transactions->links() !!}
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