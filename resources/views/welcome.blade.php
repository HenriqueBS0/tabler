<x-layout title="Home">
	<div class="page">
		<div class="page-main">
			<div class="header py-4">
				<div class="container">
					<div class="d-flex">
						<a class="header-brand" href="./index.html">
							<img src="./demo/brand/tabler.svg" class="header-brand-img" alt="tabler logo">
						</a>
						<div class="d-flex order-lg-2 ml-auto">
							<div>
								<a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
									<span class="avatar"
										style="background-image: url(./demo/faces/female/25.jpg)"></span>
									<span class="ml-2 d-none d-lg-block">
										<span class="text-default">Jane Pearson</span>
										<small class="text-muted d-block mt-1">Administrator</small>
									</span>
								</a>
							</div>
						</div>
						<a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse"
							data-target="#headerMenuCollapse">
							<span class="header-toggler-icon"></span>
						</a>
					</div>
				</div>
			</div>
			<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-3 ml-auto">
							<form class="input-icon my-3 my-lg-0">
								<input type="search" class="form-control header-search" placeholder="Search&hellip;"
									tabindex="1">
								<div class="input-icon-addon">
									<i class="fe fe-search"></i>
								</div>
							</form>
						</div>
						<div class="col-lg order-lg-first">
							<ul class="nav nav-tabs border-0 flex-column flex-lg-row">
								<li class="nav-item">
									<a href="./index.html" class="nav-link active"><i class="fe fe-home"></i> Home</a>
								</li>
								<li class="nav-item">
									<a href="{{ route('produtos.index') }}" class="nav-link"><i class="fe fe-package"></i>
										Produtos</a>
								</li>
								<li class="nav-item">
									<a href="./form-venda.html" class="nav-link"><i class="fe fe-dollar-sign"></i>
										Venda</a>
								</li>
								<li class="nav-item">
									<a href="./produtos-excluidos.html" class="nav-link"><i class="fe fe-trash"></i>
										Lixeira</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="my-3 my-md-5">
				<div class="container">
					<div class="page-header">
						<h1 class="page-title">
							Home
						</h1>
					</div>
					<div class="row row-cards">
						<div class="col-6 col-sm-4 col-lg-2">
							<div class="card">
								<div class="card-body p-3 text-center">
									<div class="h1 m-0">4</div>
									<div class="text-muted mb-4">Produtos</div>
								</div>
							</div>
						</div>
						<div class="col-6 col-sm-4 col-lg-2">
							<div class="card">
								<div class="card-body p-3 text-center">
									<div class="h1 m-0">1</div>
									<div class="text-muted mb-4">Venda</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-layout>	