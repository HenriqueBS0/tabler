<x-layout title="Produtos">

    @isset($produtoDestroy)
        <x-confirm title='Excluir Registro' method='delete'
            action="{{ route('produtos.destroy', ['produto' => $produtoDestroy->id]) }}" type='danger'
            message="Deseja realmente excluir o produto '{{ $produtoDestroy->id }} - {{ $produtoDestroy->descricao }}'?" />
    @endisset
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Produtos</h3>
                    <div class="card-options">
                        <a href="{{ route('produtos.create') }}" class="btn btn-azure">Adicionar</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th class="w-1">#</th>
                                <th>Descrição</th>
                                <th>Valor unitário</th>
                                <th>Estoque</th>
                                <th>Data última venda</th>
                                <th>Total de vendas</th>
                                <th class="w-1"></th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produtos as $produto)
                                <tr>
                                    <td><span class="text-muted">{{ $produto->id }}</span></td>
                                    <td>{{ $produto->descricao }}</td>
                                    <td>
                                        R$ {{ $produto->valor_formatado }}
                                    </td>
                                    <td>
                                        {{ $produto->quantidade_estoque }}
                                    </td>
                                    <td>
                                        08/09/2019
                                    </td>
                                    <td>
                                        R$ 30,00
                                    </td>
                                    <td>
                                        <a class="icon"
                                            href="{{ route('produtos.edit', ['produto' => $produto->id]) }}">
                                            <i class="fe fe-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="icon"
                                            href="{{ route('produtos.index', ['idDestroy' => $produto->id]) }}">
                                            <i class="fe fe-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $produtos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout>
