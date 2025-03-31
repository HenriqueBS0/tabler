@props(['search'])

<div class="row align-items-center">
    @if ($search)
        <div class="col-lg-3 ml-auto">
            <form action="{{ url()->current() }}" method="GET" class="d-flex">
                <div class="input-icon my-3 my-lg-0">
                    <input type="search" name="buscar" class="form-control header-search" placeholder="Buscar..."
                        tabindex="1" value="{{ request()->query('buscar') }}">
                    <div class="input-icon-addon">
                        <i class="fe fe-search"></i>
                    </div>
                </div>
                <button class="btn btn-primary ml-1" type="submit">Buscar</button>
            </form>
        </div>
    @endif
    <div class="col-lg order-lg-first">
        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
            <li class="nav-item">
                <a href="{{ route('home') }}" @class(['nav-link', 'active' => request()->routeIs('home')])><i class="fe fe-home"></i> Home</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('produtos.index') }}" @class(['nav-link', 'active' => request()->routeIs('produtos.*')])><i class="fe fe-package"></i>
                    Produtos</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('vendas.index') }}" @class(['nav-link', 'active' => request()->routeIs('vendas.*')])><i class="fe fe-dollar-sign"></i>
                    Venda</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('lixeira.index') }}" @class(['nav-link', 'active' => request()->routeIs('lixeira.index')])><i class="fe fe-trash"></i>
                    Lixeira</a>
            </li>
        </ul>
    </div>
</div>
