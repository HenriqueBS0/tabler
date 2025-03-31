<x-layout title='Home' :search=false>
    <div class="page-header">
        <h1 class="page-title">
            Home
        </h1>
    </div>
    <div class="row row-cards">
        <x-indicador label='Produtos Disponíveis' valor="{{ $indicadores->produtosDisponiveis() }}" />
        <x-indicador label='Variedade de Produtos' valor="{{ $indicadores->variedadeProdutos() }}" />
        <x-indicador label='Vendas' valor="{{ $indicadores->vendas() }}" />
        <x-indicador label='Valor em Vendas' valor="{{ $indicadores->valorEmVendas() }}" />
        <x-indicador label='Produtos com Estoque Baixo' valor="{{ $indicadores->produtosComEstoqueBaixo() }}" />
        <x-indicador label='Valor Total em Estoque' valor="{{ $indicadores->valorTotalEmEstoque() }}" />
    </div>
</x-layout>
