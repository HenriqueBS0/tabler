<x-layout title='Lixeira'>
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Produtos excluídos</h3>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th class="w-1">#</th>
                                <th>Descrição</th>
                                <th>Valor unitário</th>
                                <th>Estoque</th>
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
                                        <a class="icon" href="{{ route('lixeira.restore', ['id' => $produto->id]) }}">
                                            <i class="fe fe-refresh-ccw"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($produtos->hasPages())
                    <div class="card-footer">
                        {{ $produtos->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
