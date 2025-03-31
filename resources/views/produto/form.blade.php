<x-layout title="Produtos" :search=false>
    <div class="row">
        <div class="col-lg-12">
            <form class="card" action="{{ $action }}" method="POST">
                @csrf
                @method(isset($produto) ? 'PUT' : 'POST')
                <div class="card-body">
                    <h3 class="card-title">{{ $title }}</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Descrição</label>
                                <input type="text" class="form-control" required maxlength="100" name="descricao"
                                    placeholder="Arroz..." value="{{ old('descricao', $produto->descricao ?? '') }}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Estoque</label>
                                <input type="number" required min="0" step="1" class="form-control"
                                    name="quantidade_estoque" placeholder="10..."
                                    value="{{ old('quantidade_estoque', $produto->quantidade_estoque ?? '') }}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Código de barras</label>
                                <input type="number" step="1" min="0" class="form-control"
                                    name="codigo_barras" placeholder="78978978978978" required
                                    value="{{ old('codigo_barras', $produto->codigo_barras ?? '') }}">
                            </div>
                        </div>
                        <div class="col-sm-6
                                    col-md-4">
                            <div class="form-group">
                                <label class="form-label">Valor unitário</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">R$</span>
                                    </span>
                                    <input type="number" min="0" step="0.01" class="form-control text-right"
                                        aria-label="Valor" name="valor" required
                                        value="{{ old('valor', $produto->valor ?? '') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-left" style="display: flex; justify-content: space-between">
                    <div>
                        <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Voltar para produtos</a>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout>
