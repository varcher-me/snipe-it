@extends('layouts.default')

{{-- Page title --}}
@section('title')
        {{ $createText }}
@parent
@stop

@section('header_right')
<a href="{{ URL::previous() }}" class="btn btn-primary pull-right">
    {{ trans('general.back') }}</a>
@stop



{{-- Page content --}}

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-default">
            <div class="box-header with-border">
            <h3 class="box-title">
            </h3>
                @if (isset($helpText))
                    <div class="box-tools pull-right">
                        <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                    </div>
                @endif
            </div><!-- /.box-header -->

            <div class="box-body">
                <form id="create-form" class="form-horizontal" method="post" action="{{ (isset($formAction)) ? $formAction : \Request::url()  }}" autocomplete="off" role="form" enctype="multipart/form-data">

                    <!-- CSRF Token -->
                    {{ csrf_field() }}
                    @yield('inputFields')
                    <div class="box-footer text-right">
                        <a class="btn btn-link text-left" href="{{ URL::previous() }}">{{ trans('button.cancel') }}</a>
                        <button type="submit" class="btn btn-success"><i class="fa fa-print icon-white"></i> {{ trans('general.print') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ((isset($helpText)) && (isset($helpTitle)))
    <div class="slideout-menu">
        <a href="#" class="slideout-menu-toggle pull-right">×</a>
        <h3>
            {{ $helpTitle}}
        </h3>
        <p>{{ $helpText }} </p>
    </div>
    @endif
</div>

@stop
