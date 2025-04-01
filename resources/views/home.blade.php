<x-layout title='Home' :search=false>
    <div class="page-header">
        <h1 class="page-title">
            Home
        </h1>
    </div>
    <div class="row row-cards">
        <x-indicador label='Produtos Disponíveis' :valor=$produtosDisponiveis />
        <x-indicador label='Variedade de Produtos' :valor=$variedadeProdutos />
        <x-indicador label='Vendas' :valor=$vendas />
        <x-indicador label='Valor em Vendas' :valor=$valorEmVendas />
        <x-indicador label='Produtos com Estoque Baixo (estoque < 5)' :valor=$produtosComEstoqueBaixo />
        <x-indicador label='Valor Total em Estoque' :valor=$valorTotalEmEstoque />
        <div class="col-12">
            <x-grafico-vendas :dados=$graficoVendas />
        </div>
    </div>
</x-layout>
