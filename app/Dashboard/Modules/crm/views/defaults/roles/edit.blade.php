@extends('layouts.modal')

@section('modal-body')
    <h1>Create an Role</h1>
    <div class="row">  
        {{ Former::open()
        ->role('Form')
        ->class('modal-ajax-form')
        ->id('')
        ->tableId('roles')
        ->method('POST')
        ->ajaxMethod('POST')
        ->route('app.roles.update', $record->id)
        ->populate($record->resource);
        }}

        @section('content-form')

            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    {{ Former::select('role_title')->class('form-control input-sm')->label('Role')->options($config['roles']) }}
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    {{ Former::select('role_variant')->class('form-control input-sm')->options($config['seasons']) }}
                </div>
            </div>
            
        @show

            <input type="hidden" class="" name="user_id" value="{{ Auth::user()->user()->id }}">

            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-lg btn-success pull-right"><i class="fa fa-check"></i> Save</button>
            </div>   

        {{ Former::close() }}
    </div>
    
@stop