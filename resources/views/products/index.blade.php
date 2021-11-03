@extends('layouts.app')
@section('content')
<h2>Ürünlerimiz</h2>
<form action="{{ route('products.search') }}" method="post">
	@csrf
	<div class="form-group">
		<input type="text" name="searchTerm" id="searchTerm" class="form-control" placeholder="Arama Yap">
	</div>
	<div class="form-group">
		<input type="submit" value="Ürünlerde ara" class="btn btn-primary">
	</div>
</form>
@if(count($products) > 0)
	<table class="table">
		<tr>
			<th>Marka</th>
			<th>Kategori Adı</th>
			<th>Ürün Adı</th>
			<th>Ürün Detay</th>
			<th>Paket Tipi</th>
			<th>Net Ağırlık</th>
			<th>Birim Fiyat</th>
			<th>Satış Fiyatı</th>
			<th>Kutu Tipi</th>
			<th>Stok Durumu</th>
			<th>Ürün Detay</th>
		</tr>
		@foreach($products as $product)
		<tr>
			<td>{{ $product->category->parent->name }}</td>
			<td>{{ $product->category->name }}</td>
			<td><a href="/admin/products/{{$product->id}}/edit"><strong>{{$product->name}}</strong></a></td>
			<td>{{ Str::limit($product->description, $limit = 250, $end = '...') }}</td>
			<td>{{ $product->packagetype->name}}</td>
			<td>{{ $product->net_weight }}</td>
			<td>{{ $product->base_unit_price }}</td>
			@if(!is_null($product->sale_unit_price))
				<td>{{ $product->sale_unit_price }}</td>
			@else
				<td>{{ $product->base_unit_price }}</td>
			@endif
			@if(!is_null($product->boxtype->unit_number_in_box))
				<td>{{ $product->boxtype->unit_number_in_box }} paket</td>
			@else
				<td>Tek Ürün</td>
			@endif
			<td>{{$product->quantity_in_stock}}</td>
			<td><a href="/admin/products/{{$product->id}}">İncele</a></td>
		</tr>
		@endforeach
	</table>
@else
	<p class="alert alert-danger">Herhangi bir ürün bulunamadı</p>
@endif
@endsection