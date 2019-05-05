@extends('layouts.app')

@section('content')
	<h2>Ürün Detayı</h2>
	<hr>
	@if(isset($product))
		<div class="card">
			<a href="{{ url('storage/products/original/'.$product->featured_image) }}" target="_blank"><img src="{{ url('storage/products/'.$product->thumb_featured_image) }}" alt="{{$product->name}}"></a>
			<div class="card-header">
				Marka Adı: <strong>{{ $product->category->parent->name }}</strong>-
				Kategori: <strong>{{ $product->category->name }}</strong>
			</div>
			<div class="card-body">
				<h4 class="card-title">{{$product->name}}</h4>
				<div class="card-text">{{$product->description}}</div>
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item">Paket Tipi: {{$product->packagetype->name}}</li>
				<li class="list-group-item">Net Ağırlık: {{$product->net_weight}}</li>
				<li class="list-group-item">Birim Fiyat: {{$product->base_unit_price}}</li>
				@if(!is_null($product->sale_unit_price))
					<li class="list-group-item">Satış Fiyatı: {{$product->base_unit_price}}</li>
				@else
					<li class="list-group-item">Satış Fiyatı: {{$product->sale_unit_price}}</li>
				@endif
				@if(!is_null($product->boxtype->unit_number_in_box))
					<li class="list-group-item">Kutu/Koli Tipi: {{ $product->boxtype->unit_number_in_box }} paket</td>
				@else
					<li class="list-group-item">Kutu/Koli Tipi: Tek Ürün</li>
				@endif
				<li class="list-group-item">Stok Durumu: {{$product->quantity_in_stock}}</li>
			</ul>
			<div class="card-footer">
				<a href="/admin/products/{{$product->id}}/edit" class="btn btn-primary">Ürün Güncelle</a>
				<a href="/admin/products" class="btn btn-secondary">Ürünlere Dön</a>
			</div>
		</div>
	@else
		<div class="alert alert-danger">
			Sorgulamada hata oluştu. Lütfen tekrar deneyin.
		</div>
	@endif
@endsection