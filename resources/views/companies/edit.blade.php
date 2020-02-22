@extends('layouts/edit-form', [
    'createText' => trans('admin/companies/table.create') ,
    'updateText' => trans('admin/companies/table.update'),
    'helpTitle' => trans('admin/companies/general.about_companies_title'),
    'helpText' => trans('admin/companies/general.about_companies_text'),
    'formAction' => ($item) ? route('companies.update', ['company' => $item->id]) : route('companies.store'),
])

{{-- Page content --}}
@section('inputFields')
@include ('partials.forms.edit.name', ['translated_name' => trans('admin/companies/table.name')])
<!-- Full Name -->
<div class="form-group {{ $errors->has('full_name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-3 control-label">{{ trans('admin/companies/table.full_name') }}</label>
    <div class="col-md-7 col-sm-12{{  (\App\Helpers\Helper::checkIfRequired($item, 'name')) ? ' required' : '' }}">
        <input class="form-control" type="text" name="full_name" id="full_name" value="{{ Input::old('full_name', $item->full_name) }}" />
        {!! $errors->first('full_name', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
    </div>
</div>

<!-- Image -->
@if ($item->image)
    <div class="form-group {{ $errors->has('image_delete') ? 'has-error' : '' }}">
        <label class="col-md-3 control-label" for="image_delete">{{ trans('general.image_delete') }}</label>
        <div class="col-md-5">
            {{ Form::checkbox('image_delete') }}
            <img src="{{ url('/') }}/uploads/companies/{{ $item->image }}" />
            {!! $errors->first('image_delete', '<span class="alert-msg">:message</span>') !!}
        </div>
    </div>
@endif

<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label" for="image">{{ trans('admin/companies/table.logo') }}</label>
    <div class="col-md-9">
        <label class="btn btn-default">
            {{ trans('button.select_file')  }}
            <input type="file" name="image" id="uploadFile" data-maxsize="{{ \App\Helpers\Helper::file_upload_max_size() }}" accept="image/gif,image/jpeg,image/png,image/svg" style="display:none">
        </label>
        <span class='label label-default' id="upload-file-info"></span>

        <p class="help-block" id="upload-file-status">{{ trans('general.image_filetypes_help', ['size' => \App\Helpers\Helper::file_upload_max_size_readable()]) }}</p>
        {!! $errors->first('image', '<span class="alert-msg">:message</span>') !!}
    </div>
    <div class="col-md-4 col-md-offset-3">
        <img id="imagePreview" style="max-width: 200px;">
    </div>
</div>


@stop
