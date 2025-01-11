<div class="card">
    <div class="card-header">
        <h5>{{ __('Elements') }}</h5>
        <div
            style="position: absolute;position: absolute;top: 20px;{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}: 20px;">
            <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="{{ __('Create Element') }}"
                data-toggle="popover" title="{{ __('Create Element') }}" data-size="xl"
                data-url="{{ route('landing-settings.create-element') }}">
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
                        <th>{{ __('Arabic Name') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($landingElements) && $landingElements)
                        @foreach ($landingElements as $key => $landingElement)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $landingElement->name }}</td>
                                <td>{{ $landingElement->slug }}</td>
                                <td>{{ $landingElement->type  }}</td>
                                <td>{!! $landingElement->getvalueByElementType() !!}</td>
                                <td>
                                    @if($landingElement->value_ar)
                                        {!! $landingElement->value_ar !!}
                                    @else
                                        No arabic name
                                    @endif
                                </td>  
                                <td>
                                    <a data-url="{{ route('landing-settings.edit-element', $landingElement->id) }}"
                                        class="action-btn btn-info mx-1 btn btn-sm d-inline-flex align-items-center" data-ajax-popup="true"
                                        data-title="{{ __('Edit Element') }}" data-toggle="popover"
                                        title="{{ __('Edit Element') }}" data-size="xl">
                                        <i class="ti ti-edit"></i>
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
    <script src="{{ asset('assets/custom/js/dropzone.min.js') }}"></script>
@endpush