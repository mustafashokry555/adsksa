<div
    {!! $attributes->merge(['class' => 'block w-full p-2 my-2 rounded-md shadow-sm border-gray-300  ']) !!} x-data="{ show:true}"
    x-show="show" x-init="setTimeout(() => { show=false}, 5000)">
    @if( session('flash', ['type', 'success']))
<div {!! $attributes->merge(['class' => 'alert alert-success']) !!} x-data="{ show:true}"
        x-show="show" x-init="setTimeout(() => { show=false}, 5000)">
    <strong>Success!</strong> {{ $slot }}
</div>
    @elseif( session('flash', ['type', 'info']))
<div class="alert alert-info">
    <strong>Info!</strong> {{ $slot }}
</div>
    @elseif( session('flash', ['type', 'warning']))
<div class="alert alert-warning">
    <strong>Warning!</strong> {{ $slot }}
</div>
    @elseif( session('flash', ['type', 'fail']))
<div class="alert alert-danger">
    <strong>Danger!</strong> {{ $slot }}
</div>

    @endif

</div>

