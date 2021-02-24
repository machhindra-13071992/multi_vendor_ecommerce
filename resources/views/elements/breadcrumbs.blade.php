
<div class="row">
    <div class="btn-group btn-breadcrumb" style="margin-left: 15px;">
    <a href="#" class="btn btn-sm btn-default"><i class="fa fa-home"></i></a>
    @for($i = 1; $i <= count(Request::segments()); $i++)
    @if($i == 1)
    <a href="{{ secure_asset('/') }}{{Request::segment($i)}}" class="btn btn-sm btn-default">{{ ucwords(str_replace('_',' ',Str::singular(Request::segment($i)))) }}</a>
    @else 
        @if($i == 2)
        <a href="#" class="btn btn-sm btn-default">{{ ucwords(str_replace('_',' ',Str::singular(Request::segment($i)))) }}</a>
        @endif
    @endif
    @endfor
    </div>
</div>