@extends('layouts.admin')
@section('content')

    <div class="page-header clearfix">
        <h1>
            <i class="fa fa-align-justify"></i> Colors
            <a class="btn btn-success pull-right" href="{{ route('admin.colors.create') }}"><i class="fa fa-plus"></i> Create</a>
        </h1>

    </div>

    <div class="row">
        <div class="col-md-12">
            @if($colors->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                        <th>Description</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($colors as $color)
                            <tr>
                                <td>{{$color->id}}</td>
                                <td>{{$color->name}}</td>
                    <td>{{$color->description}}</td>
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.colors.show', $color->id) }}"><i class="fa fa-eye"></i> View</a>
                                    <a class="btn btn-xs btn-warning" href="{{ route('admin.colors.edit', $color->id) }}"><i class="fa fa-edit"></i> Edit</a>
                                    <form action="{{ route('admin.colors.destroy', $color->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $colors->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection