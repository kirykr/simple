@extends('layouts.admin')
@section('content')
<div class="page-header">
  <h1><i class="fa fa-plus"></i> Oimports / Create </h1>
</div>

@include('error')

<div class="row">
  <div class="col-md-12">

    {{-- <form action="{{ route('admin.oimportsController.store') }}" method="POST"> --}}    
    {!! Form::open(['action'=>"OimportController@store", 'method'=>"POST",'files'=>true]) !!}
    {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}   
    <div class="row">
      <div class="col-md-3">
       <div class="form-group @if($errors->has('impdate')) has-error @endif">
         <label for="impdate-field">Import Date</label>
         {{-- <input type="text" id="impdate-field" name="impdate" class="form-control date-picker" value="{{ old("impdate") }}"/> --}}
         {!! Form::date('impdate', \Carbon\Carbon::now(), ['class'=>'form-control', 'value'=> "{{ old('impdate') }}" ]) !!}

         @if($errors->has("impdate"))
         <span class="help-block">{{ $errors->first("impdate") }}</span>
         @endif
       </div>
     </div>
     <div class="col-md-3">
       <div class="form-group @if($errors->has('impindate')) has-error @endif">
         <label for="impindate-field">ImportIn Date</label>
         {{-- <input type="text" id="impindate-field" name="impindate" class="form-control date-picker" value="{{ old("impindate") }}"/> --}}
         {!! Form::date('impindate', \Carbon\Carbon::now(), ['class'=>'form-control', 'value'=> "{{ old('impindate') }}" ]) !!}
         @if($errors->has("impindate"))
         <span class="help-block">{{ $errors->first("impindate") }}</span>
         @endif
       </div>     
     </div>
     <div class="col-md-3">

      <div class="form-group @if($errors->has('invoicenumber')) has-error @endif">
       <label for="invoicenumber-field">Invoicenumber</label>
       <input type="text" id="invoicenumber-field" name="invoicenumber" class="form-control" value="{{ old("invoicenumber") }}"/>
       @if($errors->has("invoicenumber"))
       <span class="help-block">{{ $errors->first("invoicenumber") }}</span>
       @endif
     </div>
   </div>
   <div class="col-md-3">
    <div class="form-group @if($errors->has('totalamount')) has-error @endif">
     <label for="totalamount-field">Totalamount</label>
     <input type="text" id="totalamount-field" name="totalamount" class="form-control" value="{{ old("totalamount") }}"/>
     @if($errors->has("totalamount"))
     <span class="help-block">{{ $errors->first("totalamount") }}</span>
     @endif
   </div>
 </div>
 <div class="col-md-3">
  <div class="form-group @if($errors->has('user_id')) has-error @endif">
   <label for="user_id-field">User_id</label>
   <input type="text" id="user_id-field" name="user_id" class="form-control" value="{{ old("user_id") }}"/>
   @if($errors->has("user_id"))
   <span class="help-block">{{ $errors->first("user_id") }}</span>
   @endif
 </div>
</div>
<div class="col-md-3">
 <div class="form-group @if($errors->has('supplier_id')) has-error @endif">
   <label for="supplier_id-field">Supplier_id</label>
   <input type="text" id="supplier_id-field" name="supplier_id" class="form-control" value="{{ old("supplier_id") }}"/>
   @if($errors->has("supplier_id"))
   <span class="help-block">{{ $errors->first("supplier_id") }}</span>
   @endif
 </div>
</div>
</div>




<div class="well well-sm">
  <button type="submit" class="btn btn-primary">Create</button>
  <a class="btn btn-link pull-right" href="{{ route('admin.oimports.index') }}"><i class="fa fa-backward"></i> Back</a>
</div>
{!! Form::close() !!}
{{-- </form> --}}

</div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
<script>
  $('.date-picker').datepicker({
  });
</script>
@endsection
