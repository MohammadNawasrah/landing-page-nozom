<form method="post" action="{{ route('landing-settings.section.post-element',[$section->id]) }}">
    @csrf
    @php
    $sectionElement=new \Nozom\LandingPagePackage\Models\SectionElement();
    @endphp
    <div class="modal-body">
        <div class="row">
            <div class="col-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="key" id="key" placeholder=""/>
                    <label for="key">{{__("key")}}</label>
                </div>
            </div>
               
            <div class="col-6">
                <div class="form-floating mb-3">
                    <select  class="form-control" name="type" id="type">
                        <option value="">{{__("Select Type")}} </option>
                        <option value= "{{HTML}}" data-tag="{{$sectionElement->getElementByType(HTML)}}">{{__(HTML)}} </option>
                        <option value="{{COLOR}}" data-tag="{{$sectionElement->getElementByType(COLOR)}}">{{__(COLOR)}} </option>
                        <option value="{{SWITCH_TYPE}}" data-tag="{{$sectionElement->getElementByType(SWITCH_TYPE)}}">{{__(SWITCH_TYPE)}} </option>
                        <option value="{{IMAGE}}" data-tag="{{$sectionElement->getElementByType(IMAGE)}}">{{__(IMAGE)}} </option>
                        <option value="{{SVG}}" data-tag="{{$sectionElement->getElementByType(SVG)}}">{{__(SVG)}} </option>
                        <option value="{{IMAGE_URL}}" data-tag="{{$sectionElement->getElementByType(IMAGE_URL)}}">{{__(IMAGE_URL)}} </option>

                    </select>
                    <label for="type">{{__("Type")}}</label>
                </div>
            </div>
            
            <div class="col-3">
            </div>
            <div class="col-6" id="valueArea" style="display: none;">
                <div class="form-floating mb-3">
                <div id="inputArea">

                </div>
                </div>
            </div>
            <div class="form-group col-md-12 mt-3" id="dropzoneArea" style="display: none;">
                <label for="files" class="form-label">{{ __('Upload Files') }}</label>
                <div class="col-md-12 dropzone browse-file" id="dropzonewidget">
                    <div class="dz-message" data-dz-message>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
    </div>
    <script>
       Dropzone.autoDiscover = false;

myDropzone = new Dropzone("#dropzonewidget", {
    maxFiles: 1,
    parallelUploads: 1,
    headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
    url: "{{ route('landing-settings.store-dropzone-file') }}",
    acceptedFiles: "image/*", // Accept only image files
    success: function(file, response) {
        if (response.is_success) {
            $("#value").val(response.path);
            dropzoneBtn(file, response);
            show_toastr('{{ __('Success') }}', 'File Successfully Uploaded', 'success');
        } else {
            myDropzone.removeFile(file);
            show_toastr('{{ __('Error') }}', response.is_error, 'error');
        }
    },
    error: function(file, response) {
        myDropzone.removeFile(file);
        show_toastr('{{ __('Error') }}',
            'File type and size must match with Storage setting.', 'error');
    }
});

myDropzone.on("sending", function(file, xhr, formData) {
    formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
});

function dropzoneBtn(file, response) {
    var html = document.createElement('span');
    var download = document.createElement('a');
    download.setAttribute('href', response.download);
    download.setAttribute('class', "action-btn btn-primary mx-1 btn btn-sm d-inline-flex align-items-center");
    download.setAttribute('data-toggle', "popover");
    download.setAttribute('download', "");
    download.setAttribute('title', "{{ __('Download') }}");
    download.innerHTML = "<i class='ti ti-download'></i>";
    html.appendChild(download);

    var del = document.createElement('a');
    del.setAttribute('href', response.delete);
    del.setAttribute('class', "action-btn btn-danger mx-1 btn btn-sm d-inline-flex align-items-center");
    del.setAttribute('data-toggle', "popover");
    del.setAttribute('title', "{{ __('Delete') }}");
    del.innerHTML = "<i class='ti ti-trash'></i>";

    del.addEventListener("click", function(e) {
        e.preventDefault();
        e.stopPropagation();
        if (confirm("Are you sure ?")) {
            var btn = $(this);
            $.ajax({
                url: btn.attr('href'),
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.is_success) {
                        $("#" + response.id).remove();
                        btn.closest('.dz-image-preview').remove();
                        show_toastr('{{ __('Success') }}', 'File Successfully Deleted', 'success');
                    } else {
                        show_toastr('{{ __('Error') }}', 'Something Went Wrong.', 'error');
                    }
                },
                error: function(response) {
                    show_toastr('{{ __('Error') }}', 'Something Went Wrong.', 'error');
                }
            });
        }
    });
    html.appendChild(del);

    file.previewTemplate.appendChild(html);
}

        $(document).ready(function () {
     
            $('#type').change(function () {
                var selectedOption = $(this).find(':selected');
                var dataTagValue = selectedOption.data('tag');
            if(dataTagValue!=null)
            {
                $('#inputArea').html(dataTagValue);
                $('#valueArea').show();
           if(selectedOption.val() =='Html')
            {
                $('.summernote').summernote({
                height: 250,
            });
            }
            else if(selectedOption.val() == "Image")
            {
                $('#dropzoneArea').show();
                $('#valueArea').hide();
            }
            else{
                $('#dropzoneArea').hide();

            }
            

            }
            else{
                $('#valueArea').hide();
                $('#dropzoneArea').hide();


            }
            });
        });
    </script>
</form>
