<div class="alert alert-secondary alert-dismissible">
    <h4>{{ $title }}</h4>
    <p>{{ $message ?? '' }}</p>
    <div class="d-flex">
        <form action="{{ $action }}" method="POST">
            @csrf
            @method($method)
            <button class="btn btn-{{ $type }}" type="submit">Sim</button>
        </form>
        <button class="btn btn-secondary ml-1" data-dismiss="alert">Não</button>
    </div>
</div>
