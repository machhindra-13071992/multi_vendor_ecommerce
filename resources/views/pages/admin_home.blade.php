@extends('layouts.default')
@section('content')
<div class="page">
    <div class="page-header">
      <h1 class="page-title font-size-26 font-weight-100">Ecommerce Overview</h1>
    </div>

    <div class="page-content container-fluid">
      <div class="row">
        <!-- First Row -->
        <div class="col-md-3">
          <div class="card card-shadow">
            <div class="card-block bg-white p-20">
              <button type="button" class="btn btn-floating btn-sm btn-warning">
                <i class="icon ei ei-cart-2"></i>
              </button>
              <span class="ml-15 font-weight-400">ORDERS</span>
              <div class="content-text text-center mb-0">
                <i class="text-danger icon wb-triangle-up font-size-20">
              </i>
                <span class="font-size-40 font-weight-100">@php echo count($orders); @endphp</span>
				
                <p class="blue-grey-400 font-weight-100 m-0">
					<a href="{{ secure_asset('/users') }}" class="block-anchor panel-footer text-center">Full Detail &nbsp; 
						<i class="fa fa-arrow-right"></i>
					</a>
			   </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card card-shadow">
            <div class="card-block bg-white p-20">
              <button type="button" class="btn btn-floating btn-sm btn-success">
                <i class="icon fa fa-users"></i>
              </button>
              <span class="ml-15 font-weight-400">Users</span>
              <div class="content-text text-center mb-0">
                <i class="text-danger icon wb-triangle-up font-size-20">
              </i>
                <span class="font-size-40 font-weight-100">@php echo count($users); @endphp</span>
                <p class="blue-grey-400 font-weight-100 m-0"><a href="{{ secure_asset('/users') }}" class="block-anchor panel-footer text-center">Full Detail &nbsp; 
					<i class="fa fa-arrow-right"></i>
               </a></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card card-shadow">
            <div class="card-block bg-white p-20">
              <button type="button" class="btn btn-floating btn-sm btn-primary">
                <i class="icon fa fa-product-hunt"></i>
              </button>
              <span class="ml-15 font-weight-400">Products</span>
              <div class="content-text text-center mb-0">
                <i class="text-danger icon wb-triangle-up font-size-20">
              </i>
              <span class="font-size-40 font-weight-100">@php echo count($products); @endphp</span>
                <p class="blue-grey-400 font-weight-100 m-0">
					<a href="{{ secure_asset('/products') }}" class="block-anchor panel-footer text-center">Full Detail &nbsp; 
						<i class="fa fa-arrow-right"></i>
				   </a>
			   </p>
              </div>
            </div>
          </div>
        </div>
		</div>
    </div>
  </div>		
@endsection