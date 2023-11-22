@extends('layouts.admin')

@section('page-title')
   {{ __("Manage Contract Type") }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __("Home") }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __("Contract Type") }}</li>
@endsection

@section('action-button')
    
    <div class="row align-items-center m-1">
        @if(\Auth::user()->type != 'employee')
            <div class="col-auto pe-0">
                <a href="#" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Create Contract')}}" data-ajax-popup="true" data-size="md" data-title="{{__('Create Contract Type')}}" data-url="{{route('contract_type.create')}}"><i class="ti ti-plus text-white"></i></a>
            </div>
        @endif
    </div>
 
@endsection

@section('content')
<div class="col-3">
    @include('layouts.hrm_setup')
</div>
<div class="col-9">
    <div class="card">
        <div class="card-body table-border-style">
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>{{__('Contract Type')}}</th>
                            <th>{{__('Attachment')}}</th>
                            <th width="250px">{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contractTypes as $contractType)
                        <tr>
                            <td>{{ $contractType->name }}</td>
                            <td>
                                @if($contractType->attachment)
                                <a target="_blank" href="https://hrm.devop360.com/storage/{{ $contractType->attachment }}">Attachment</a>
                                @endif
                            </td>
                            <td class="Action">
                                <span>
                                    @if(\Auth::user()->type != 'employee')
                                        <div class="action-btn btn-info ms-2">
                                            <a href="#" data-size="md" data-url="{{ URL::to('contract_type/'.$contractType->id.'/edit') }}" data-ajax-popup="true" data-title="{{__('Edit Contract Type')}}" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Edit Contract Type')}}"><i class="ti ti-pencil text-white"></i></a>
                                        </div>
                                        <div class="action-btn bg-danger ms-2">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['contract_type.destroy', $contractType->id]]) !!}
                                            <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center bs-pass-para" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Delete')}}"><span class="text-white"><i class="ti ti-trash"></i></span></a>
                                            {!! Form::close() !!}
                                        </div>
                                    @endif
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
