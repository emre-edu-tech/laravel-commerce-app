@extends('layouts.app')

@section('content')
<h2>Ürün Güncelleme</h2>
<form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="category">Kategori Adı:</label>
		<select name="category" id="category">
			<option value="0">Kategori seçiniz</option>
			@if(count($categories) >0 )
				@foreach($categories as $category)
					<option {!!($product->category_id == $category->id) ? 'selected' : '' !!} value="{{$category->id}}">{{$category->name}}</option>
				@endforeach
			@endif
		</select>
	</div>

	<div class="form-group">
		<label for="name">Ürün Adı:</label>
		<input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control">
	</div>

	<div class="form-group">
		<label for="description">Ürün Açıklama</label>
		<textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $product->description }}</textarea>
	</div>

	<div class="form-group">
		<label for="packageType">Ambalaj Tipi</label>
		<select name="packageType" id="packageType">
			<option value="0">Ambalaj Tipi Seçiniz</option>
			@if(count($packageTypes) > 0)
				@foreach($packageTypes as $packageType)
					<option {!!($product->package_type_id == $packageType->id) ? 'selected' : '' !!} value="{{ $packageType->id }}">{{ $packageType->name }}</option>
				@endforeach
			@endif
		</select>
	</div>

	<div class="form-group">
		<label for="packageType">Kutu/Koli Tipi</label>
		<select name="boxType" id="boxType">
			<option {!!($product->box_type_id == 0) ? 'selected' : '' !!} value="0">Tek Ürün</option>
			@if(count($boxTypes) > 0)
				@foreach($boxTypes as $boxType)
					<option {!!($product->box_type_id == $boxType->id) ? 'selected' : '' !!} value="{{ $boxType->id }}">{{ $boxType->unit_number_in_box }} paket</option>
				@endforeach
			@endif
		</select>
	</div>

	<div class="form-group">
		<label for="packageType">Net Ağırlık</label>
		<input type="number" name="netWeight" id="netWeight" value="{{ $product->net_weight }}" class="form-control" placeholder="Ağırlık - kg/g - lt/ml">
	</div>

	<div class="form-group">
		<label for="baseUnitPrice">Birim Fiyat</label>
		<input type="text" name="baseUnitPrice" id="baseUnitPrice" value="{{ $product->base_unit_price }}" class="form-control" placeholder="... TL">
	</div>

	<div class="form-group">
		<label for="saleUnitPrice">Birim Satış Fiyat</label>
		<input type="text" name="saleUnitPrice" id="saleUnitPrice" value="{{ $product->sale_unit_price }}" class="form-control" placeholder="... TL">
	</div>

	<div class="form-group">
		<label for="quantityInStock">Stok Durumu</label>
		<input type="number" name="quantityInStock" id="quantityInStock" value="{{ $product->quantity_in_stock }}" class="form-control">
	</div>	

	<div class="form-group">
		Şimdiki Ürün Resmi: <a href="{{ url('storage/products/original/'.$product->featured_image) }}" target="_blank"><img src="{{ url('storage/products/'.$product->thumb_featured_image) }}"></a>
		<br>
		<label for="featuredImage">Tanıtıcı Resim (logo) Güncelle:</label>
		<input type="file" name="featuredImage" id="featuredImage" class="form-control">
	</div>

	<input type="hidden" name="_method" value="PUT">
	<input type="submit" value="Ürün Güncelle" class="btn btn-primary">
</form>

<form action="{{ route('products.destroy', $product->id) }}" method="post">
	@csrf
	<input type="hidden" name="_method" value="DELETE">
	<input type="submit" value="Ürün Sil" class="btn btn-danger">
</form>
<a href="/admin/products" class="btn btn-secondary">Ürünlere Dön</a>
@endsection