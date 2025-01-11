<style>
    .edit-name,
    .edit-ar-name {
        display: inline-block;
    }

    .display-name,
    .display-ar-name {
        cursor: pointer;
    }
</style>
<div class="card">
    <div class="card-header">
        <h5>{{ __('Landing Sections') }}</h5>
        <div
            style="position: absolute;position: absolute;top: 20px;{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 20px;">
            <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="{{ __('Create Section') }}"
                data-toggle="popover" title="{{ __('Create Section') }}" data-size="xl"
                data-url="{{ route('landing-settings.create') }}">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="sectionsTable">
                <thead>
                    <tr>
                        <th>{{ __('#') }}</th>
                        <th>{{ __('Section Name') }}</th>
                        <th>{{ __('Aribic Name') }}</th>
                        <th>{{ __('Order') }}</th>
                        <th>{{ __('Publish') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($landingSections) && $landingSections)
                        @foreach ($landingSections as $key => $landingSection)
                            <tr data-section-id="{{ $landingSection->id }}">
                                <td>{{ $key + 1 }}</td>
                                <td class="name-section editable-name" data-section-id="{{ $landingSection->id }}">
                                    <span class="display-name">{{ $landingSection->name }}</span>
                                    <div class="edit-name d-none">
                                        <input type="text" class="form-control name-input"
                                            value="{{ $landingSection->name }}">
                                    </div>
                                </td>
                                <td class="ar-name-section editable-ar-name"
                                    data-section-id="{{ $landingSection->id }}">
                                    <span class="display-ar-name">{{ $landingSection->ar_name }}</span>
                                    <div class="edit-ar-name d-none">
                                        <input type="text" class="form-control ar-name-input"
                                            value="{{ $landingSection->ar_name }}">
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $countBegin = 1;
                                        $numberOfSections = count($landingSections);
                                    @endphp
                                    <div class="dropdown dropdown-section-order-{{ $landingSection->order }}"
                                        id="orderSectionDropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            {{ $landingSection->order }}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            @for ($i = $countBegin; $i <= $numberOfSections; $i++)
                                                <a class="dropdown-item" href="javascript:void(0)"
                                                    data-section-id="{{ $landingSection->id }}"
                                                    data-selected-value="{{ $landingSection->order }}"
                                                    data-value-dropdown="{{ $i }}">{{ $i }}</a>
                                            @endfor
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input is_publish"
                                            {{ $landingSection->is_publish ? 'checked' : '' }} type="checkbox"
                                            role="switch" />
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('landing-settings.section.show', [$landingSection->id]) }}"
                                        class="action-btn btn-warning mx-1 btn btn-sm d-inline-flex align-items-center"
                                        data-toggle="popover" title="{{ __('View Standard') }}">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(() => {
            initDropdownChange();
            initChangePublished();
            enableInlineEditAr();
            enableInlineEdit();
        });

        function initDropdownChange() {
            let target = $("#orderSectionDropdown .dropdown-item");
            if (target.length <= 0) return;
            target.off("click").on("click", function() {
                let mainOrderDropdown = $($(this).parent().parent()[0]);
                let buttonDropdown = $(mainOrderDropdown.find("#dropdownMenuButton"));

                let lastOrder = $(this).attr("data-selected-value");
                let newOrder = $(this).attr("data-value-dropdown");


                let searchSectionDropdownHaveOrderToChange = $(`.dropdown-section-order-${newOrder}`);

                swapOrder(mainOrderDropdown, searchSectionDropdownHaveOrderToChange);
                $.ajax({
                    url: "{{ route('landing-settings.update-order') }}",
                    type: "POST",
                    data: {
                        section_old_order: lastOrder,
                        section_new_order: newOrder,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            show_toastr("success", response.message, "success");
                        } else {
                            show_toastr("error", response.message, "error");
                        }
                    },
                    error: function(xhr) {
                        show_toastr("error", "An error occurred. Please try again.", "error");
                    }
                });
            });
        }

        function swapOrder(oldSectionOrder, newSectionOrder) {
            let getTrTagMainOld = $(oldSectionOrder.parent().parent());
            let getTdNameSectionOld = $(getTrTagMainOld.find(".name-section"));

            let getTrTagMainNew = $(newSectionOrder.parent().parent());
            let getTdNameSectionNew = $(getTrTagMainNew.find(".name-section"));

            let value = getTdNameSectionOld.text();
            getTdNameSectionOld.text(getTdNameSectionNew.text());
            getTdNameSectionNew.text(value);

            let trId = getTrTagMainOld.attr("data-section-id");
            getTrTagMainOld.attr("data-section-id", getTrTagMainNew.attr("data-section-id"));
            getTrTagMainNew.attr("data-section-id", trId);

            let getTdPublishOld = getTrTagMainOld.find(".is_publish");
            let getTdPublishNew = getTrTagMainNew.find(".is_publish");
            let isCheckedOld = getTdPublishOld.prop("checked");
            let isCheckedNew = getTdPublishNew.prop("checked");
            getTdPublishOld.prop("checked", isCheckedNew);
            getTdPublishNew.prop("checked", isCheckedOld);

            let getTdActionOld = getTrTagMainOld.find("td:last-child");
            let getTdActionNew = getTrTagMainNew.find("td:last-child");
            let actionContentOld = getTdActionOld.html();
            let actionContentNew = getTdActionNew.html();
            getTdActionOld.html(actionContentNew);
            getTdActionNew.html(actionContentOld);

            let getTdNameSectionArOld = $(getTrTagMainOld.find(".ar-name-section"));
            let getTdNameSectionArNew = $(getTrTagMainNew.find(".ar-name-section"));
            let valueAr = getTdNameSectionArOld.text();
            getTdNameSectionArOld.text(getTdNameSectionArNew.text());
            getTdNameSectionArNew.text(valueAr);
        }

        function initChangePublished() {
            $(document).off("change").on('change', '.is_publish', function() {
                let isChecked = $(this).is(':checked');
                let sectionId = $(this).closest('tr').attr('data-section-id');

                $.ajax({
                    url: "{{ route('landing-settings.update-publish-status') }}",
                    type: "POST",
                    data: {
                        id: sectionId,
                        is_publish: isChecked ? 1 : 0,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            show_toastr("Success", response.message, "success");
                        } else {
                            show_toastr("Error", response.message, "error");
                        }
                    },
                    error: function(xhr) {
                        show_toastr("Error", "An error occurred. Please try again.", "error");
                    }
                });
            });
        }

        function enableInlineEdit() {
            $(document).on('dblclick', '.name-section', function() {
                
                
                let td = $(this);
                if(td.hasClass("on-edit-now")) return ;

                td.addClass("on-edit-now");
                let currentText = td.text().trim();
                let sectionId = td.closest('tr').data('section-id');

                let input = $(`<input type="text" class="form-control" value="${currentText}" />`);
                td.html('').append(input);

                input.on('keydown', function(e) {
                    if (e.key === "Enter") {
                        let newName = input.val().trim();
                        if (newName && newName !== currentText) {
                            $.ajax({
                                url: "{{ route('landing-settings.update-name') }}",
                                type: "POST",
                                data: {
                                    id: sectionId,
                                    name: newName,
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    if (response.success) {
                                        td.text(newName);
                                        show_toastr("Success", response.message, "success");
                                    } else {
                                        show_toastr("Error", response.message, "error");
                                        td.text(currentText);
                                    }
                                },
                                error: function() {
                                    show_toastr("Error", "An error occurred. Please try again.",
                                        "error");
                                    td.text(currentText);
                                }
                            });
                        } else {
                            td.text(currentText);
                        }
                    }
                });

                $(document).on('click', function(e) {
                    if (!td.is(e.target) && td.has(e.target).length === 0) {
                        let newText = input.val().trim();

                        if (newText === "" || newText !== currentText) {
                            td.text(currentText);
                        } else {
                            td.text(newText);
                        }
                        $(".on-edit-now").removeClass("on-edit-now");
                        $(document).off('click');
                    }
                });
            });
        }

        function enableInlineEditAr() {
            $(document).off("dblclick").on('dblclick', '.ar-name-section', function() {
                let td = $(this);

                if(td.hasClass("on-edit-now")) return ;

                td.addClass("on-edit-now");
                
                let currentText = td.text().trim();
                let sectionId = td.closest('tr').data('section-id');

                let input = $(`<input type="text" class="form-control" value="${currentText}" />`);
                td.html('').append(input);

                input.on('keydown', function(e) {
                    if (e.key === "Enter") {
                        let newName = input.val().trim();
                        if (newName && newName !== currentText) {
                            $.ajax({
                                url: "{{ route('landing-settings.update-ar-name') }}",
                                type: "POST",
                                data: {
                                    id: sectionId,
                                    ar_name: newName,
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    if (response.success) {
                                        td.text(newName);
                                        show_toastr("Success", response.message, "success");
                                    } else {
                                        show_toastr("Error", response.message, "error");
                                        td.text(currentText);
                                    }
                                },
                                error: function() {
                                    show_toastr("Error", "An error occurred. Please try again.",
                                        "error");
                                    td.text(currentText);
                                }
                            });
                        } else {
                            td.text(currentText);
                        }
                    }
                });

                $(document).on('click', function(e) {
                    if (!td.is(e.target) && td.has(e.target).length === 0) {
                        let newText = input.val().trim();

                        if (newText === "" || newText !== currentText) {
                            td.text(currentText);
                        } else {
                            td.text(newText);
                        }
                        $(".on-edit-now").removeClass("on-edit-now");
                        $(document).off('click');
                    }
                });
            })
        }
    </script>
@endpush
