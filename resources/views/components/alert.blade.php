@php
    $flash = session('flash');
@endphp

@if ($flash)
    <div
        {!! $attributes->merge(['class' => 'block w-full p-2 my-2 rounded-md shadow-sm border-gray-300']) !!}
        x-data="{ show:true }"
        x-show="show"
        x-init="setTimeout(() => { show=false }, 5000)"
    >
        @if ($flash['type'] === 'success')
            <div class="alert alert-success">
                <strong>Success!</strong> {{ $flash['message'] }}
            </div>
        @elseif ($flash['type'] === 'info')
            <div class="alert alert-info">
                <strong>Info!</strong> {{ $flash['message'] }}
            </div>
        @elseif ($flash['type'] === 'warning')
            <div class="alert alert-warning">
                <strong>Warning!</strong> {{ $flash['message'] }}
            </div>
        @elseif ($flash['type'] === 'fail')
            <div class="alert alert-danger">
                <strong>Danger!</strong> {{ $flash['message'] }}
            </div>
        @endif
    </div>
@endif
