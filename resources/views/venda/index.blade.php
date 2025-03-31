<x-layout title='Vendas'>
    <div class="row">
        <div class="col-lg-12">
            <x-venda.form :$produtos />
        </div>
    </div>
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Últimas vendas realizadas</h3>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th class="w-1">#</th>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Valor unitário</th>
                                <th>Valor total da venda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendas as $venda)
                                <tr>
                                    <td><span class="text-muted">{{ $venda->id }}</span></td>
                                    <td>{{ $venda->produto->descricao }}</td>
                                    <td>{{ $venda->quantidade }}</td>
                                    <td>
                                        R$ {{ $venda->valor_formatado }}
                                    </td>
                                    <td>
                                        R$ {{ $venda->valor_total_formatado }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($vendas->hasPages())
                    <div class="card-footer">
                        {{ $vendas->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
