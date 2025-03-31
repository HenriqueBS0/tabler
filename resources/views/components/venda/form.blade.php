<form class="card" action="{{ route('vendas.store') }}" method="POST">
    @csrf
    @method('POST')
    <div class="card-body">
        <h3 class="card-title">Realizar venda de um produto</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Produto</label>
                    <select class="form-control custom-select" required id='produto_id' name="produto_id">
                        @foreach ($produtos as $produto)
                            <option value="{{ $produto['id'] }}">{{ $produto['descricao'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    <label class="form-label">Quantidade</label>
                    <input type="number" id='quantidade' name="quantidade" value="{{ old('quantidade', 0) }}"
                        class="form-control" placeholder="Digite aqui a quantidade" required>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    <label class="form-label">Valor unitário</label>
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                        </span>
                        <input type="number" step="0.01" id='valor' name="valor"
                            class="form-control text-right" aria-label="Valor" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    <label class="form-label">Valor total</label>
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                        </span>
                        <input type="text" id="valor-total" class="form-control text-right" aria-label="Valor"
                            disabled="disabled" title="Este campo não pode ser alterado">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-12">
                <div class="form-group">
                    <div class="form-label">&nbsp;</div>
                    <div class="custom-controls-stacked">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="atualizar_valor_produto" checked>
                            <span class="custom-control-label">Atualizar valor unitário do
                                produto</span>
                        </label>
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
<script>
    const produtos = @json($produtos);

    const produtoSelect = document.getElementById("produto_id");
    const quantidadeInput = document.getElementById("quantidade");
    const valorInput = document.getElementById("valor");
    const valorTotalInput = document.getElementById("valor-total");

    function atualizarValores() {
        const produtoSelecionado = produtos.find(p => p.id == produtoSelect.value);

        if (produtoSelecionado) {
            // Define o valor unitário
            valorInput.value = produtoSelecionado.valor.toFixed(2);

            // Define a quantidade máxima permitida
            quantidadeInput.max = produtoSelecionado.quantidade_estoque;

            // Atualiza o valor total
            atualizarValorTotal();
        }
    }

    function atualizarValorTotal() {
        const quantidade = parseFloat(quantidadeInput.value) || 0;
        const valorUnitario = parseFloat(valorInput.value) || 0;
        valorTotalInput.value = (quantidade * valorUnitario).toFixed(2);
    }

    // Eventos para atualizar os valores
    produtoSelect.addEventListener("change", atualizarValores);
    quantidadeInput.addEventListener("input", atualizarValorTotal);
    valorInput.addEventListener("input", atualizarValorTotal);

    // Inicializa os valores ao carregar a página
    atualizarValores();
</script>
