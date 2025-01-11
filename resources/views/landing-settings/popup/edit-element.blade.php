
<form method="post" action="{{ route('landing-settings.update-name-element', $landingElement->id) }}">
    @csrf
    @method('POST')
    @php
        $sectionElement=new \Nozom\LandingPagePackage\Models\LandingElement();
    @endphp
    <div class="modal-body">
        <div class="row">
            <div class="col-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="key" id="key" placeholder="" value="{{ $landingElement->name }}" required />
                    <label for="key">{{ __("Key") }}</label>
                </div>
            </div>

            <div class="col-6">
                <div class="form-floating mb-3">
                    <select class="form-control" name="type" id="type">
                        <option value="">{{ __("Select Type") }} </option>
                        <option value="{{ HTML }}" data-tag="{{ $landingElement->getElementByType(HTML) }}" {{ $landingElement->type == HTML ? 'selected' : '' }}>{{ __(HTML) }}</option>
                        <option value="{{ COLOR }}" data-tag="{{ $landingElement->getElementByType(COLOR) }}" {{ $landingElement->type == COLOR ? 'selected' : '' }}>{{ __(COLOR) }}</option>
                        <option value="{{ SWITCH_TYPE }}" data-tag="{{ $landingElement->getElementByType(SWITCH_TYPE) }}" {{ $landingElement->type == SWITCH_TYPE ? 'selected' : '' }}>{{ __(SWITCH_TYPE) }}</option>
                        <option value="{{ IMAGE }}" data-tag="{{ $landingElement->getElementByType(IMAGE) }}" {{ $landingElement->type == IMAGE ? 'selected' : '' }}>{{ __(IMAGE) }}</option>
                        <option value="{{ SVG }}" data-tag="{{ $landingElement->getElementByType(SVG) }}" {{ $landingElement->type == SVG ? 'selected' : '' }}>{{ __(SVG) }}</option>
                        <option value="{{ IMAGE_URL }}" data-tag="{{ $landingElement->getElementByType(IMAGE_URL) }}" {{ $landingElement->type == IMAGE_URL ? 'selected' : '' }}>{{ __(IMAGE_URL) }}</option>
                    </select>
                    <label for="type">{{ __("Type") }}</label>
                </div>
            </div>
            <div class="col-3" >
                <input type="hidden" id="elval" value="{{$landingElement->value}}">
                <input type="hidden" id="elval_ar" value="{{$landingElement->value_ar}}">
            </div>

            <div class="col-6" id="valueArea" style="display: none;">
                <div class="form-floating mb-3">
                    <div id="inputArea">
                        <!-- Add default value for element type -->
                        {!! $sectionElement->getElementByType($landingElement->type) !!}
                    </div>
                </div>
            </div>

            <div class="form-group col-md-12 mt-3" id="dropzoneArea" style="display: none;">
                <label for="files" class="form-label">{{ __('Upload Files') }}</label>
                <div class="col-md-12 dropzone browse-file" id="dropzonewidget">
                    <div class="dz-message" data-dz-message></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
    </div>

    <script>
        // Your existing Dropzone and change logic
        Dropzone.autoDiscover = false;
        myDropzone = new Dropzone("#dropzonewidget", {
            parallelUploads: 1,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            url: "{{ route('landing-settings.store-dropzone-file') }}",
            acceptedFiles: "image/*", // Accept only image files
            success: function(file, response) {
                if (response.is_success) {
                    $('#dropzonewidget').find('.dz-preview')[0].remove();
                    $("#value").val(response.path);
                    // dropzoneBtn(file, response);
                    show_toastr('{{ __('Success') }}', 'File Successfully Uploaded', 'success');
                } else {
                    myDropzone.removeFile(file);
                    show_toastr('{{ __('Error') }}', response.is_error, 'error');
                }
            },
            error: function(file, response) {

                
                
                myDropzone.removeFile(file);
                show_toastr('{{ __('Error') }}', 'File type and size must match with Storage setting.', 'error');
            }
        });
        // Prepopulate Dropzone with an image from a URL
        function addImageToDropzone(imageUrl) {
            // Create a new file object for Dropzone to handle the image URL
            var mockFile = { name: "image.jpg", size: 12345, type: 'image/jpeg' };

            // Add the image URL as a preview
            myDropzone.emit("addedfile", mockFile);
            myDropzone.emit("thumbnail", mockFile, imageUrl); // This URL will show as the image in the preview

            // Mark it as complete to avoid Dropzone treating it as a new upload
            myDropzone.emit("complete", mockFile);
        }
        
        $(document).ready(function () {
            addImageToDropzone("{{$landingElement->value}}");
            // Trigger change on page load based on the selected type
            var selectedOption =  $('#type').find(':selected');
                var dataTagValue = selectedOption.data('tag');
                var typeValue = selectedOption.val();

                // Show the input area and update its content based on the selected type
                if (dataTagValue != null) {
                    $('#inputArea').html(dataTagValue);
                    $('#valueArea').show();
                    // debugger;
                    $('#value').val($('#elval').val());
                    $('#value_ar').val($('#elval_ar').val());
                    
                    if (typeValue == 'Html') {
                        // Initialize summernote for HTML type
                        $('#value').summernote({
                            height: 250,
                        });
                        $('#value_ar').summernote({
                            height: 250,
                        });
                    } else if (typeValue == 'Image') {
                        // Show the Dropzone area for Image type
                        $('#dropzoneArea').show();
                        $('#valueArea').hide();
                    } else {
                        // Hide the dropzone area if not Image
                        $('#dropzoneArea').hide();
                    }
                } else {
                    // Hide both areas if no valid type is selected
                    $('#valueArea').hide();
                    $('#dropzoneArea').hide();
                }

            $('#type').change(function () {
                var selectedOption = $(this).find(':selected');
                var dataTagValue = selectedOption.data('tag');
                var typeValue = selectedOption.val();

                // Show the input area and update its content based on the selected type
                if (dataTagValue != null) {
                    $('#inputArea').html(dataTagValue);
                    $('#valueArea').show();
                    
                    if (typeValue == 'Html') {
                        // Initialize summernote for HTML type
                        $('.summernote').summernote({
                            height: 250,
                        });
                    } else if (typeValue == 'Image') {
                        // Show the Dropzone area for Image type
                        $('#dropzoneArea').show();
                        $('#valueArea').hide();
                    } else {
                        // Hide the dropzone area if not Image
                        $('#dropzoneArea').hide();
                    }
                } else {
                    // Hide both areas if no valid type is selected
                    $('#valueArea').hide();
                    $('#dropzoneArea').hide();
                }
            });
        });
    </script>
</form>