@extends('layouts.app', ['name' => __(  'Category Management')])

@section('links')
<link href="{{ asset('css/treeview.css') }}" rel="stylesheet">
@endsection


@section('content')
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">Manage Category TreeView</div>
          <div class="panel-body">
              <div class="row">
                  <div class="col-md-6">
                      <h3>Category List</h3>
                    <ul id="tree1">
                        @foreach($categories as $category)
                            <li>
                                {{ $category->name }}
                                @if(count($category->childs))
                                    @include('manageChild',['childs' => $category->childs])
                                @endif
                            </li>
                        @endforeach
                    </ul>
                  </div>
                  <div class="col-md-6">
                      <h3>Add New Category</h3>


                          {!! Form::open(['route'=>'add.category']) !!}


                              @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>{{ $message }}</strong>
                                </div>
                            @endif


                              <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                {!! Form::label('name:') !!}
                                {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Enter name']) !!}
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div>


                            <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
                                {!! Form::label('Category:') !!}
                                {!! Form::select('parent_id',$allCategories, old('parent_id'), ['class'=>'form-control', 'placeholder'=>'Select Category']) !!}
                                <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                            </div>


                            <div class="form-group">
                                <button class="btn btn-success">Add New</button>
                            </div>


                          {!! Form::close() !!}


                  </div>
              </div>


          </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="{{  asset('js/treeview.js')}}"></script>
@endsection
