
@extends('layouts/edit-form', [
    'createText' => trans('admin/hardware/form.createbulk'),
    'helpTitle' => trans('admin/hardware/general.about_assets_title'),
    'helpText' => trans('admin/hardware/general.about_assets_text'),
    'formAction' => route('hardware.store.bulk'),
])


{{-- Page content --}}

@section('inputFields')

    @include ('partials.forms.edit.company-select', ['translated_name' => trans('general.company'), 'fieldname' => 'company_id'])

    @include ('partials.forms.edit.model-select', ['translated_name' => trans('admin/hardware/form.model'), 'fieldname' => 'model_id', 'required' => 'true'])

    @include ('partials.forms.edit.status')

    <!-- Serials -->
    <div class="form-group {{ $errors->has('serial') ? ' has-error' : '' }}">
        <label for="serial[1]" class="col-md-3 control-label">{{ trans('admin/hardware/form.serial') }} </label>
        <div class="col-md-7 col-sm-12  required">
            <input class="form-control" type="text" name="serials[1]" id="serial[1]" value="" placeholder="{{ trans('general.input_serial_bulk') }}" />
            {!! $errors->first('serial', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
        </div>
        <div class="col-md-2 col-sm-12">
            <button class="add_field_button btn btn-default btn-sm"><i class="fa fa-plus"></i></button>
        </div>
    </div>
    <div class="input_serials_fields_wrap">
    </div>

  @include ('partials.forms.edit.name', ['translated_name' => trans('admin/hardware/form.name')])
  @include ('partials.forms.edit.purchase_date')
  @include ('partials.forms.edit.supplier-select', ['translated_name' => trans('general.supplier'), 'fieldname' => 'supplier_id'])

  @include ('partials.forms.edit.warranty')
  @include ('partials.forms.edit.notes')

  @include ('partials.forms.edit.requestable', ['requestable_text' => trans('admin/hardware/general.requestable')])




@stop

@section('moar_scripts')
<script nonce="{{ csrf_token() }}">

    var transformed_oldvals={};

    function fetchCustomFields() {
        //save custom field choices
        var oldvals = $('#custom_fields_content').find('input,select').serializeArray();
        for(var i in oldvals) {
            transformed_oldvals[oldvals[i].name]=oldvals[i].value;
        }

        var modelid = $('#model_select_id').val();
        if (modelid == '') {
            $('#custom_fields_content').html("");
        } else {

            $.ajax({
                type: 'GET',
                url: "{{url('/') }}/models/" + modelid + "/custom_fields",
                headers: {
                    "X-Requested-With": 'XMLHttpRequest',
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                _token: "{{ csrf_token() }}",
                dataType: 'html',
                success: function (data) {
                    $('#custom_fields_content').html(data);
                    $('#custom_fields_content select').select2(); //enable select2 on any custom fields that are select-boxes
                    //now re-populate the custom fields based on the previously saved values
                    $('#custom_fields_content').find('input,select').each(function (index,elem) {
                        if(transformed_oldvals[elem.name]) {
                            $(elem).val(transformed_oldvals[elem.name]).trigger('change'); //the trigger is for select2-based objects, if we have any
                        }
                        
                    });
                }
            });
        }
    }

    function user_add(status_id) {

        if (status_id != '') {
            $(".status_spinner").css("display", "inline");
            $.ajax({
                url: "{{url('/') }}/api/v1/statuslabels/" + status_id + "/deployable",
                headers: {
                    "X-Requested-With": 'XMLHttpRequest',
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $(".status_spinner").css("display", "none");
                    $("#selected_status_status").fadeIn();

                    if (data == true) {
                        $("#assignto_selector").show();
                        $("#assigned_user").show();

                        $("#selected_status_status").removeClass('text-danger');
                        $("#selected_status_status").addClass('text-success');
                        $("#selected_status_status").html('<i class="fa fa-check"></i> That status is deployable. This asset can be checked out.');


                    } else {
                        $("#assignto_selector").hide();
                        $("#selected_status_status").removeClass('text-success');
                        $("#selected_status_status").addClass('text-danger');
                        $("#selected_status_status").html('<i class="fa fa-times"></i> That asset status is not deployable. This asset cannot be checked out. ');
                    }
                }
            });
        }
    }
    ;

    $(function () {
        //grab custom fields for this model whenever model changes.
        $('#model_select_id').on("change", fetchCustomFields);

        //initialize assigned user/loc/asset based on statuslabel's statustype
        user_add($(".status_id option:selected").val());

        //whenever statuslabel changes, update assigned user/loc/asset
        $(".status_id").on("change", function () {
            user_add($(".status_id").val());
        });

        $("#create-form").submit(function (event) {
            event.preventDefault();
            return sendForm();
        });

        // // Resize Files when chosen
        // //First check to see if there is a file before doing anything else
        //
        // var imageData = "";
        // var $fileInput = $('#uploadFile');
        // $fileInput.on('change', function (e) {
        //     if ($fileInput != '') {
        //         if (window.File && window.FileReader && window.FormData) {
        //             var file = e.target.files[0];
        //             if (file) {
        //                 if (/^image\//i.test(file.type)) {
        //                     readFile(file);
        //                 } else {
        //                     alert('Invalid Image File :(');
        //                 }
        //             }
        //         }
        //         else {
        //             console.log("File API not supported, not resizing");
        //         }
        //     }
        // });


        // function readFile(file) {
        //     var reader = new FileReader();
        //
        //     reader.onloadend = function () {
        //         processFile(reader.result, file.type);
        //     }
        //
        //     reader.onerror = function () {
        //         alert("Unable to read file");
        //     }
        //
        //     reader.readAsDataURL(file);
        // }

        // function processFile(dataURL, fileType) {
        //     var maxWidth = 800;
        //     var maxHeight = 800;
        //
        //     var image = new Image();
        //     image.src = dataURL;
        //
        //     image.onload = function () {
        //         var width = image.width;
        //         var height = image.height;
        //         var shouldResize = (width > maxWidth) || (height > maxHeight);
        //
        //         if (!shouldResize) {
        //             imageData = dataURL;
        //             return;
        //         }
        //
        //         var newWidth;
        //         var newHeight;
        //
        //         if (width > height) {
        //             newHeight = height * (maxWidth / width);
        //             newWidth = maxWidth;
        //         } else {
        //             newWidth = width * (maxHeight / height);
        //             newHeight = maxHeight;
        //         }
        //         var canvas = document.createElement('canvas');
        //
        //         canvas.width = newWidth;
        //         canvas.height = newHeight;
        //
        //         var context = canvas.getContext('2d');
        //
        //         context.drawImage(this, 0, 0, newWidth, newHeight);
        //
        //         dataURL = canvas.toDataURL(fileType);
        //
        //         imageData = dataURL;
        //
        //     };
        //
        //     image.onerror = function () {
        //         alert('Unable to process file :(');
        //     }
        // }

        $(document).ready(function() {
            var max_fields      = 100; //maximum input boxes allowed
            var wrapper         = $(".input_serials_fields_wrap"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID
            console.log(add_button);
            var x               = 1; //initial text box count
            var seq             = 1;
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                var box_html        = '';
                if (x < max_fields) {
                    x++; //text box increment
                    seq ++;
                    console.log("Add button Clicked for seq = "+ seq);
                    box_html += '<span class="fields_wrapper">';
                    box_html += '<div class="form-group"><label for="serial" class="col-md-3 control-label"></label>';
                    box_html += '<div class="col-md-7 col-sm-12">';
                    box_html += '<input type="text"  class="form-control" name="serials[' + seq + ']" placeholder = {{ trans('general.more_serial_bulk') }}>';
                    box_html += '</div>';
                    box_html += '<div class="col-md-2 col-sm-12">';
                    box_html += '<a href="#" class="remove_field btn btn-default btn-sm"><i class="fa fa-minus"></i></a>';
                    box_html += '</div>';
                    box_html += '</div>';
                    box_html += '</span>';
                    $(wrapper).append(box_html);
                    // We have reached the maximum number of extra asset fields, so disable the button
                } else {
                    $(".add_field_button").attr('disabled');
                    $(".add_field_button").addClass('disabled');
                }
            });
            $(wrapper).on("click",".remove_field", function(e){ //user clicks on remove text
                $(".add_field_button").removeAttr('disabled');
                $(".add_field_button").removeClass('disabled');
                e.preventDefault();
                console.log("remove " + x);
                $(this).parent('div').parent('div').parent('span').remove();
                x--;
            })
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
