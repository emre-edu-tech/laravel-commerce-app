@extends('layouts.app')

@section('content')
<h2>Ürün Güncelleme</h2>
{{ Form::open(['action' => ['ProductsController@update', $product->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}

	<div class="form-group">
		{{Form::label('category', 'Kategori:')}}
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
		{{Form::label('name', 'Ürün Adı:')}}
		{{Form::text('name', $product->name, ['class' => 'form-control'])}}
	</div>

	<div class="form-group">
		{{Form::label('description', 'Ürün Açıklama:')}}
		{{Form::textArea('description', $product->description, ['class' => 'form-control'])}}
	</div>

	<div class="form-group">
		{{Form::label('packageType', 'Ambalaj Tipi:')}}
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
		{{Form::label('boxType', 'Kutu/Koli Tipi:')}}
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
		{{Form::label('netWeight', 'Net Ağırlık')}}
		{{Form::text('netWeight', $product->net_weight, ['class' => 'form-control', 'placeholder' => 'Ağırlık - kg/g - lt/ml'])}}
	</div>

	<div class="form-group">
		{{Form::label('baseUnitPrice', 'Birim Fiyat')}}
		{{Form::text('baseUnitPrice', $product->base_unit_price, ['class' => 'form-control', 'placeholder' => '... TL'])}}
	</div>

	<div class="form-group">
		{{Form::label('saleUnitPrice', 'Birim Satış Fiyat')}}
		{{Form::text('saleUnitPrice', $product->sale_unit_price, ['class' => 'form-control', 'placeholder' => '... TL'])}}
	</div>

	<div class="form-group">
		{{Form::label('quantityInStock', 'Stok Durumu')}}
		{{Form::number('quantityInStock', $product->quantity_in_stock, ['class' => 'form-control'])}}
	</div>	

	<div class="form-group">
		Şimdiki Ürün Resmi: <a href="{{ url('storage/products/original/'.$product->featured_image) }}" target="_blank"><img src="{{ url('storage/products/'.$product->thumb_featured_image) }}"></a>
		<br>
		{{Form::label('featuredImage', 'Tanıtıcı Resim (logo) Güncelle')}}
		{!! Form::file('featuredImage', ['class' => 'form-control']) !!}
	</div>
	
	{{ Form::hidden('_method', 'PUT') }}
	{{Form::submit('Ürün Güncelle', ['class' => 'btn btn-primary'])}}
{{ Form::close() }}

{{ Form::open(['action' => ['ProductsController@destroy', $product->id], 'method' => 'POST']) }}
	{{ Form::hidden('_method', 'DELETE')}}
	{{ Form::submit('Ürün Sil', ['class' => 'btn btn-danger']) }}
{{ Form::close() }}
<a href="/admin/products" class="btn btn-secondary">Ürünlere Dön</a>
@endsection