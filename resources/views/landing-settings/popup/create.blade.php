<form method="post" action="{{ route('landing-settings.store') }}">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="section_name" id="sectionName" placeholder=""/>
                    <label for="sectionName">{{__("Section Name")}}</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="section_name_ar" id="sectionNameAr" placeholder=""/>
                    <label for="sectionNameAr">{{__("Arabic Section Name ")}}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
    </div>
</form>
