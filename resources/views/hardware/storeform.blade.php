
@extends('layouts/print-form', [
    'createText' => trans('admin/hardware/form.storeform'),
    'formAction' => route('hardware.storeform.print'),
])


{{-- Page content --}}

@section('inputFields')

    @include ('partials.forms.edit.company-select', ['translated_name' => trans('general.company'), 'fieldname' => 'company_id'])
    @include ('partials.forms.edit.purchase_date')

    {{-- Form Tag --}}
    <div class="form-group {{ $errors->has('form_tag') ? ' has-error' : '' }}">
        <label for="form_tag" class="col-md-3 control-label">{{-- trans('general.purchase_date') --}}入库单编号</label>
        <div class="input-group col-md-3">
            <input type="text" class="form-control" placeholder="{{-- trans('general.select_date')--}}GSJY-ITAM-YYYYSS" name="form_tag" id="form_tag" value="">
            {!! $errors->first('form_tag', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
        </div>
    </div>
    <div class="form-group">
        <label for="assets-list" class="col-md-3 control-label">资产清单</label>
        <div class="input-group col-md-8">
            <table class="table table-striped snipe-table" name="assets-list">
                <tr>
                    <td class="col-md-3">资产编号</td>
                    <td class="col-md-3">型号</td>
                    <td class="col-md-3">序列号</td>
                </tr>
    @foreach ($assets as $asset)
                <tr>
                    <input type="hidden" name="ids[{{ $loop->index }}]" id="ids[{{ $loop->index }}]" value="{{ $asset->id }}">
                    <td>{{ $asset->asset_tag }}</td>
                    <td>{{ $asset->model->model_number }}</td>
                    <td>{{ $asset->serial }}</td>
                </tr>
    @endforeach
            </table>
        </div>
    </div>
@stop

@section('moar_scripts')
<script nonce="{{ csrf_token() }}">

    $(function () {

        $("#create-form").submit(function (event) {
            event.preventDefault();
            return sendForm();
        });

        function sendForm() {
            var form = $("#create-form").get(0);
            var formData = $('#create-form').serializeArray();
            // formData.push({name: 'image', value: imageData});
            $.ajax({
                type: 'POST',
                url: form.action,
                headers: {
                    "X-Requested-With": 'XMLHttpRequest',
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                dataType: 'json',
                success: function (data) {
                    // console.dir(data);
                    // AssetController flashes success to session, redirect to hardware page.
                    if (data.redirect_url) {
                        window.location.href = data.redirect_url;
                        return true;
                    }
                    window.location.reload(true);
                    return false;

                },
                error: function (data) {
                    // AssetRequest Validator will flash all errors to session, this just refreshes to see them.
                    window.location.reload(true);
                    // console.log(JSON.stringify(data));
                    // console.log('error submitting');
                }
            });

            return false;
        }

    });




</script>
@stop
