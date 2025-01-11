<div class="card">
    <div class="card-header">
        <h5>{{ __('Section Elements') }}</h5>
        <div
            style="position: absolute;position: absolute;top: 20px;{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 20px;">
            <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="{{ __('Create Section Element') }}"
                data-toggle="popover" title="{{ __('Create Section Element') }}" data-size="xl"
                data-url="{{ route('landing-settings.section.create-element', [$section->id]) }}">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('#') }}</th>
                        <th>{{ __('name') }}</th>
                        <th>{{ __('slug') }}</th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('value') }}</th>
                        <th>{{ __('Arabic value') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($sectionElements) && $sectionElements)
                        @foreach ($sectionElements as $key => $sectionElement)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $sectionElement->name }}</td>
                                <td>{{ $sectionElement->slug }}</td>
                                <td>{{ $sectionElement->type }}</td>
                                <td>{!! $sectionElement->getvalueByElementType() !!}</td>
                                <td>
                                    @if($sectionElement->value_ar)
                                        {!! $sectionElement->value_ar !!}
                                    @else
                                        No arabic name
                                    @endif
                                </td>                                
                                <td>
                                    <a data-url="{{ route('landing-settings.section.edit-element', [$section->id, $sectionElement->id]) }}"
                                        class="action-btn btn-info mx-1 btn btn-sm d-inline-flex align-items-center"
                                        data-ajax-popup="true" 
                                        data-title="{{ __('edit Section Element') }}" 
                                        data-toggle="popover" 
                                        title="{{ __('edit Section Element') }}" 
                                        data-size="xl">
                                        <i class="ti ti-edit"></i>
                                     </a>                                     
                                    {{-- <a href="{{ route('landing-settings.section.show', [$sectionElement->id]) }}"
                                        class="action-btn btn-warning mx-1 btn btn-sm d-inline-flex align-items-center"
                                        data-toggle="popover" title="{{ __('View Standard') }}">
                                        <i class="ti ti-eye"></i>
                                    </a> --}}
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
    <script src="{{ asset('assets/custom/js/dropzone.min.js') }}"></script>
@endpush
