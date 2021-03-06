@extends('crm::defaults.contacts.create')

@section('create-form')
    {{ Former::open()
            ->role('Form')
            ->class('')
            ->method('POST')
            ->route('app.contacts.store');
            // ->populate($record->resource);
    }}

        <div class="col-lg-4 col-md-4 col-sm-4  col-xs-12">
            {{ Former::select('title')->class('form-control input-lg')->options($config['dropdowns']['titles']) }}
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8  col-xs-12">
            {{ Former::text('first_name')->class('form-control input-lg')->placeholder('E.g. Lionel')->id('copy-source') }}
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12  col-xs-12">
            {{ Former::text('last_name')->class('form-control input-lg')->placeholder('E.g. Blair') }}
        </div>

       <div class="col-lg-12 col-md-12 col-sm-12  col-xs-12">
            {{ Former::text('nickname')->class('form-control input-lg copy-destination')->placeholder('E.g. Dancing Li')->label('Known As') }}
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12  col-xs-12">
            {{ Former::tel('mobile_phone')->class('form-control input-lg')->placeholder('E.g. 07703545343') }}
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12  col-xs-12">
            {{ Former::tel('home_phone')->class('form-control input-lg')->placeholder('E.g. 01614536464') }}
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12  col-xs-12">
            {{ Former::email('email')->class('form-control input-lg')->placeholder('E.g. lionel@GiveUsAClue.com') }}
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <button type="submit" class="btn btn-lg btn-success pull-right"><i class="fa fa-check"></i> Create this {{ $config['contacts']['label'] }}</button>
        </div>   

    {{ Former::close() }}

    <div class="form-group">
        <p class="help-block"><strong>Got more to say?</strong> Don't worry, there's space on the next page for all that</p>
    </div>
@stop
