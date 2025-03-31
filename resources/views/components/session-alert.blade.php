@props(['type' => 'success', 'message'])

@if (session()->has($message))
    <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
        {{ session($message) }}
        <button type="button" class="close" data-dismiss="alert"></button>
    </div>
@endif

@if ($errors->any() && $type === 'danger')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Ocorreu um erro!</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert"></button>
    </div>
@endif
