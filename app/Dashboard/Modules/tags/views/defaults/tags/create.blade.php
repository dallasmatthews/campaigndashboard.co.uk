@extends('layouts.modal')

@section('modal-body')
    <h1>Create an Role</h1>
    <div class="row">  
        {{ Former::open()
        ->role('Form')
        ->class('ajax-form')
        ->id('')
        ->method('POST')
        ->ajaxMethod('POST')
        ->route('api.v1.tag_pivot.store');
        // ->populate($record->resource);

        }}
            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    {{ Former::select('tag_id')->class('form-control input')->label('Role')->options($config['roles']) }}
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    {{ Former::select('order_source')->class('form-control input-sm')->options($config['orderSource']) }}
                </div>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="lineitems" >
                    <tr>
                        <th style="width:40%">Product</th>
                        <th style="width:30%">Season</th>
                        <th style="width:10%">Qty</th>
                        <th style="width:15%">Price</th>
                    </tr>
                    <tr >
                        <td>
                            {{ Former::select('_order_product[product_id][]')->class('form-control input')->options($config['productList'])->label(false) }}
                        </td>
                        <td>
                            {{ Former::select('_order_product[variant][]')->class('form-control input')->options($config['seasons'])->label(false) }}
                        </td>
                        <td>
                            {{ Former::text('_order_product[quantity][]')->class('form-control input')->label(false) }}
                        </td>
                        <td>
                            {{ Former::text('_order_product[price][]')->class('form-control input')->label(false) }}
                        </td>
                    </tr>
                </table>
                <a class="add_row pull-right" data-tableid="lineitems"><h5><i class="fa fa-plus"></i> Add more items</h5></a>
            </div>
    
            <div class="form-group col-lg-6 col-md-6 col-sm-6  col-xs-12">
                {{ Former::textarea('order_notes')->class('form-control input')->placeholder('E.g. Send out the card recorded delivery')->rows(5) }}
            </div>

            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                
                <div class="1col-lg-offset-8 col-lg-12 1col-md-offset-8 col-md-12 1col-sm-offset-6 col-sm-12 1col-xs-offset-2 col-xs-12">
                    {{ Former::text('_order_total')->class('form-control input-sm')->label('Total') }}
                </div>
                <div class="1col-lg-offset-8 col-lg-12 1col-md-offset-8 col-md-12 1col-sm-offset-6 col-sm-12 1col-xs-offset-2 col-xs-12">
                    {{ Former::select('payment_method')->class('form-control input-sm')->options($config['paymentMethod']) }}
                </div>
            </div>

            <input type="hidden" class="" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" class="" name="contact_id" value="{{ Input::get('contact_id') }}">

            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-lg btn-success pull-right"><i class="fa fa-check"></i> Save</button>
            </div>   

        {{ Former::close() }}
    </div>
    
@stop