@extends('layouts.app')

@section('content')
<h2>Ürün Ekleyin</h2>
{{ Form::open(['action' => 'ProductsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}

	<div class="form-group">
		{{Form::label('category', 'Kategori:')}}
		<select name="category" id="category">
			<option>Marka/Kategori seçiniz</option>
			@if(count($categories) >0 )
				@foreach($categories as $category)
					<option value="{{$category->id}}">{{$category->parent->name}} - {{$category->name}}</option>
				@endforeach
			@endif
		</select>
	</div>

	<div class="form-group">
		{{Form::label('name', 'Ürün Adı:')}}
		{{Form::text('name', '', ['class' => 'form-control'])}}
	</div>

	<div class="form-group">
		{{Form::label('description', 'Ürün Açıklama:')}}
		{{Form::textArea('description', '', ['class' => 'form-control'])}}
	</div>

	<div class="form-group">
		{{Form::label('packageType', 'Ambalaj Tipi:')}}
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
		{{Form::label('boxType', 'Kutu/Koli Tipi:')}}
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
		{{Form::label('netWeight', 'Net Ağırlık')}}
		{{Form::text('netWeight', '', ['class' => 'form-control', 'placeholder' => 'Ağırlık - kg/g - lt/ml'])}}
	</div>

	<div class="form-group">
		{{Form::label('baseUnitPrice', 'Birim Fiyat')}}
		{{Form::text('baseUnitPrice', '', ['class' => 'form-control', 'placeholder' => '... TL'])}}
	</div>

	<div class="form-group">
		{{Form::label('saleUnitPrice', 'Birim Satış Fiyat')}}
		{{Form::text('saleUnitPrice', '', ['class' => 'form-control', 'placeholder' => '... TL'])}}
	</div>

	<div class="form-group">
		{{Form::label('quantityInStock', 'Stok Durumu')}}
		{{Form::number('quantityInStock', '', ['class' => 'form-control'])}}
	</div>	

	<div class="form-group">
		{{Form::label('featuredImage', 'Ürün Resmi:')}}
		{!! Form::file('featuredImage', ['class' => 'form-control']) !!}
	</div>
	
	{{Form::submit('Ürün Ekle', ['class' => 'btn btn-primary'])}}
{{ Form::close() }}
@endsection