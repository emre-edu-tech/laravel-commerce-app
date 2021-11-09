@extends('layouts.app')

@section('content')
<h2>Ürün Ekleyin</h2>
<form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="category">Kategori:</label>
		<select name="category" id="category">
			<option>Marka/Kategori seçiniz</option>
			@if(count($categories) > 0)
				@foreach($categories as $category)
					<option value="{{$category->id}}">{{$category->parent->name}} - {{$category->name}}</option>
				@endforeach
			@endif
		</select>
	</div>

	<div class="form-group">
		<label for="name">Ürün Adı:</label>
		<input type="text" name="name" id="name" class="form-control">
	</div>

	<div class="form-group">
		<label for="description">Ürün Açıklama</label>
		<textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
	</div>

	<div class="form-group">
		<label for="packageType">Ambalaj Tipi</label>
		<select name="packageType" id="packageType">
			<option>Ambalaj Tipi Seçiniz</option>
			@if(count($packageTypes) > 0)
				@foreach($packageTypes as $packageType)
					<option value="{{ $packageType->id }}">{{ $packageType->name }}</option>
				@endforeach
			@endif
		</select>
	</div>

	<div class="form-group">
		<label for="boxType">Kutu/Koli Tipi</label>
		<select name="boxType" id="boxType">
			<option value="0">Tek Ürün</option>
			@if(count($boxTypes) > 0)
				@foreach($boxTypes as $boxType)
					<option value="{{ $boxType->id }}">{{ $boxType->unit_number_in_box }} paket</option>
				@endforeach
			@endif
		</select>
	</div>

	<div class="form-group">
		<label for="netWeight">Net Ağırlık</label>
		<input type="text" name="netWeight" id="netWeight" placeholder="Ağırlık - kg/g - lt/ml" class="form-control">
	</div>

	<div class="form-group">
		<label for="baseUnitPrice">Birim Fiyat</label>
		<input type="text" name="baseUnitPrice" id="baseUnitPrice" placeholder="... TL" class="form-control">
	</div>

	<div class="form-group">
		<label for="saleUnitPrice">Birim Satış Fiyat</label>
		<input type="text" name="saleUnitPrice" id="saleUnitPrice" placeholder="... TL" class="form-control">
	</div>

	<div class="form-group">
		<label for="quantityInStock">Stok Durumu</label>
		<input type="text" name="quantityInStock" id="quantityInStock" class="form-control">
	</div>	

	<div class="form-group">
		<label for="featuredImage">Ürün Resmi:</label>
		<input type="file" name="featuredImage" id="featuredImage" class="form-control">
	</div>
	
	<input type="submit" value="Ürün Ekle" class="btn btn-primary">
</form>
@endsection