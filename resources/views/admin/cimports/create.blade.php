@extends('layouts.admin')
@section('content')
<div class="page-header">
  <h1><i class="fa fa-plus"></i> Cimports / Create </h1>
</div>

@include('error')

<div class="row">
  <div class="col-md-12">

    {{-- <form action="{{ route('admin.cimportsController.store') }}" method="POST"> --}}    
    {!! Form::open(['action'=>"CimportController@store", 'method'=>"POST",'files'=>true]) !!}
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
     <div class="form-group @if($errors->has('invoicenum')) has-error @endif">
       <label for="invoicenum-field">Invoice Number</label>
       <input type="text" id="invoicenum-field"  minlength="10" name="invoicenum" class="form-control" value="{{ old("invoicenum") }} "/>
       <p class="help-block"></p>
       @if($errors->has("invoicenum"))
       <span class="help-block">{{ $errors->first("invoicenum") }}</span>
       @endif
     </div>
   </div>
   <div class="col-md-3">
     <div class="form-group @if($errors->has('totalamount')) has-error @endif">
       <label for="totalamount-field">Total Amount</label>
       <input type="text" id="totalamount-field" name="totalamount" readonly="readonly" class="form-control" value="{{ old("totalamount") }}"/>
       @if($errors->has("totalamount"))
       <span class="help-block">{{ $errors->first("totalamount") }}</span>
       @endif
     </div>
   </div>
 </div>
 <div class="row">
   <div class="col-md-3">
     <div class="form-group @if($errors->has('user_id')) has-error @endif">
       <label for="user_id-field">User</label>
       <input type="text" id="user_id-field" name="user_id" readonly="readonly" class="form-control" value="{{ Auth::user()->name }}"/> 
       {{-- //old("user_id") --}}
       @if($errors->has("user_id"))
       <span class="help-block">{{ $errors->first("user_id") }}</span>
       @endif
     </div>
   </div>
   <div class="col-md-3">
     {!! Form::label('supplier_id', 'Company Name') !!}
     <div class="form-group input-group {{ $errors->has('supplier_id') ? 'has-error' :'' }}">
      {!! Form::select('supplier_id',[''=>'Choose Company'] + $suppliers,0,['class'=>'form-control']) !!}
      {!! $errors->first('supplier_id','<span class="help-block">:message</span>') !!}
       <span class="input-group-btn">
          <button class="btn btn-success" type="button"><i class="fa fa-plus"></i></button>
        </span>
    </div>
  </div>
</div>
<div class="row  well">
  <div class="col-md-4">
     <div class="col-md-12">
       {!! Form::label('computer_id', 'Computer Name') !!}
       <div class="form-group input-group {{ $errors->has('computer_id') ? 'has-error' :'' }}">
        {!! Form::select('computer_id',[''=>'Choose Computer'] + $computers,0,['class'=>'form-control']) !!}
        {!! $errors->first('computer_id','<span class="help-block">:message</span>') !!}
           <span class="input-group-btn">
              <button class="btn btn-success" type="button"><i class="fa fa-plus"></i></button>
            </span>
      </div>
    </div>
     <div class="col-md-12">
     {!! Form::label('color_id', 'Color') !!}
     <div class="form-group input-group {{ $errors->has('color_id') ? 'has-error' :'' }}">
      {!! Form::select('color_id',[''=>'Choose Color'] + $colors,0,['class'=>'form-control']) !!}
      {!! $errors->first('color_id','<span class="help-block">:message</span>') !!}
        <span class="input-group-btn">
        <button class="btn btn-success" type="button"><i class="fa fa-plus"></i></button>
      </span>
    </div>
  </div>
  </div>
  <div class="col-md-4">
     <div class="col-md-7">
       {!! Form::label('qtyinstock', 'Computer Qty') !!}
       <div class="form-group {{ $errors->has('qtyinstock') ? 'has-error' :'' }}">
        {!! Form::number('qtyinstock',0,['class'=>'form-control','step'=>'any','placeholder'=>'Computer qtyinstock']) !!}
        {!! $errors->first('qtyinstock','<span class="help-block">:message</span>') !!}
      </div>
    </div>
  </div>
  <div class="col-md-4">
     <div class="col-md-7">
       {!! Form::label('sellprice', 'Computer Price') !!}
       <div class="form-group input-group {{ $errors->has('sellprice') ? 'has-error' :'' }}">
        {!! Form::number('sellprice',0,['class'=>'form-control','step'=>'any','placeholder'=>'Computer sellprice', 'readonly'=>"readonly"]) !!}
        {!! $errors->first('sellprice','<span class="help-block">:message</span>') !!}
         <span class="input-group-btn">
        <button class="btn btn-success editsellprice" type="button"><i class="fa fa-edit"></i></button>
      </div>
    </div>
  </div>
   <div class="col-md-4">
     <div class="col-md-7">
       {!! Form::label('cost', 'Computer Cost') !!}
       <div class="form-group {{ $errors->has('cost') ? 'has-error' :'' }}">
        {!! Form::number('cost',0,['class'=>'form-control','step'=>'any','placeholder'=>'Computer Cost']) !!}
        {!! $errors->first('cost','<span class="help-block">:message</span>') !!}
      </div>
    </div>
  </div>
</div> 
<hr>
<div class="well well-sm">
  <button type="submit" value="newsubmit" name="newsubmit" class="btn btn-success"><i class="fa fa-asterisk"></i> New Import</button>
  <button type="submit" value="addsubmit" name="addsubmit" class="btn btn-warning"><i class="fa fa-download"></i> Add Computer</button>
  <a class="btn btn-link pull-right" href="{{ route('admin.cimports.index') }}"><i class="fa fa-backward"></i> Back</a>
  <button type="submit" value="addsubmit" name="savesubmit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Save Import</button>
</div>
{!! Form::close() !!}
{{-- </form> --}}

</div>
</div>
<div class="row">
  <div class="col-md-12">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Computer Name</th>
          <th>Color</th>
          <th>Qty</th>
          <th>Cost</th>
          <th>sell Price</th>
          <th>Amount</th>
          <th class="text-right">Option</th>
        </tr>
      </thead>
      <tbody>
      <?php $i = 1; ?>
      @foreach ($tempcomputers as $tmpcomputerstock)
        <tr>
          <td>{{ $i }}</td>
          <td>{{ $tmpcomputerstock->computer_name }}</td>
          <td>{{ $tmpcomputerstock->color_name }}</td>
          <td class="qty">{{ $tmpcomputerstock->qty }}</td>
          <td>{{ $tmpcomputerstock->cost }}</td>
          <td>{{ $tmpcomputerstock->sellprice }}</td>
          <td>{{ $tmpcomputerstock->cost * $tmpcomputerstock->cost }}</td>
          <td class="text-right">
             {{-- <a class="btn btn-xs btn-primary" href="{{ route('admin.tempcomputerstock.show', $category->id) }}"><i class="fa fa-eye"></i> View</a> --}}
            <a class="btn btn-xs btn-warning" href="{{ route('admin.tempcomputersotck.edit', $tmpcomputerstock->id) }}"><i class="fa fa-edit"></i> Edit</a>
            <form action="{{ route('admin.tempcomputersotck.destroy', $tmpcomputerstock->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</button>
            </form>
              <a class="btn btn-xs btn-info getQty" data-toggle="modal" href='#modal-id'><i class="fa fa-arrow-circle-o-down"></i> Add Serial</a>
          </td>
        </tr>
        <?php $i++; ?>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
<div class="modal fade" id="modal-id">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-info">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Input Serial</h4>
      </div>
      <div class="modal-body">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          {{-- {!! Form::open(['action'=>"TempcomputersotckController@store", 'method'=>"POST", 'id'=>'serialFrom']) !!} --}}
            <form action="{{ route('admin.tempcomputersotck.store') }}" method="POST" data-toggle="validator" id='serialForm' name="form1" novalidate>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
          {{-- @include('forms.Tempcomputersotck') --}}
            {{-- @for ($i = 0; $i < 3; $i++) --}}
            <div class="form-group control-group  {{ $errors->has('serialnumber') ? 'has-error' :'' }}" id="append">
             {{--  {!! Form::text('serialnumber[]',null,['class'=>'form-control unique  required','placeholder'=>'Computer Serial', 'required'=>"required", 'data-minlength'=>"5"]) !!}
               <div class="help-block with-errors"></div>
              {!! $errors->first('serialnumber','<span class="help-block">:message</span>') !!} --}}
             
            </div>
            {{-- @endfor   --}}
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="summit" class="btn btn-primary" data-backdrop="static" data-keyboard="false" onclick="findDuplicates();">Save Serial</button>
            </div>
             {{-- {!! Form::close() !!} --}}
             </form>
          </div>

@endsection
@section('footer')
@stop
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
<script>
  $('.date-picker').datepicker({
  });
</script>
<script type="text/javascript">

  $(document).ready(function() { 

    var $value = 0;
    $('#serialForm').validator();

    $('.getQty').click(function() {
     var $row = $(this).closest("tr");
     $value = parseInt($row.find(".qty").text());
      $(".modal-body form#serialForm .required").remove()
     $(".modal-body #value").val($value);
        for (var i = 0; i < $value; i++) {
          $("div#append").after('<div class="form-group control-group"> <input type="text" name="serialnumber[]" class="form-control required" placeholder="Input Serial" required="required" data-minlength="5" data-maxlength="25"  value=""/></div><div class="help-block with-errors"></div>');
        }
    });

    // Select2 Auto complete and search 
    $("#computer_id").select2({
      placeholder: "Select a Computer",
       maximumSelectionSize: 2
    }).on('change', function(e){
      var value = e.target.value;
      getComputers(value);
    }); 
    function getComputers(id){
      $.ajax({
        method: 'GET',
        url: '/admin/api/v1/computers/' + id,
        success: function(response) {
          console.log(response);
          $('#sellprice').val(response.sellprice);
          $('.editsellprice').attr('data-json', response);
        },
        error: function(error) {
          console.log(error);
        }
      });
    }
    // edit sellprice
    $('.editsellprice').on('click', function(e) {
      var data = $(this).data('json');
      var price = $('#sellprice').val();
      if(price != data.sellprice) {
        
      }
      $('#sellprice').removeAttr('readonly'); 

    });
    $("#color_id").select2({
      placeholder: "Select a Color",
       maximumSelectionSize: 2
    });
    $("#supplier_id").select2({
      placeholder: "Select a Color",
       maximumSelectionSize: 2
    }); 

    // Validation
      $('#serialForm').validator().on('submit', function (e) {
        if (e.isDefaultPrevented()) {
          // handle the invalid form...
          alert('message');
        } else {
          // everything looks good!
        }
      });
    $("input[unique='serial']").change( function() {
       // check input ($(this).val()) for validity here
       var valueOfChangedInput = $
       (this).val();
       var timeRepeated = 0;
       $("input[unique='serial']").each(function () {
           //Inside each() check the 'valueOfChangedInput' with all other existing input
           if ($(this).val() == valueOfChangedInput ) {
               timeRepeated++; //this will be executed at least 1 time because of the input, which is changed just now
           }
       });

       if(timeRepeated > 1) {
           alert("Duplicate value found !");
           // $('#serialForm').submit( function(ev){
           //          ev.preventDefault();
           //          //later you decide you want to submit
           //   });
       }
       else {
          
        // $("#serialForm").submit( function(ev){
         if(timeRepeated > 1) {
             alert("Duplicate value found !");
              ev.preventDefault();
           }else{
              $("#serialForm").get(0).allowDefault = true;
           }
       // });
             // $("#form1").get(0).allowDefault = true;
       }

   });
  
});
  // Unique validation
  $('#modal-id').on('hidden.bs.modal', function () {
     $(this).find("input").val('').end();
     $("div#append").empty();
    });
</script>

@endsection
