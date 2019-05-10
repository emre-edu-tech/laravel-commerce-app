@extends('layouts.app')

@section('content')
<h2>Ürün Kategorisi Ekleyin</h2>
{{ Form::open(['action' => 'CategoriesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
	<div class="form-group">
		{{Form::label('name', 'Kategori Adı')}}
		{{Form::text('name', '', ['class' => 'form-control'])}}
	</div>
	<div class="form-group">
		{{Form::label('description', 'Kategori Açıklama')}}
		{{Form::textArea('description', '', ['class' => 'form-control'])}}
	</div>
	<div class="form-group">
		{{Form::label('parentCategory', 'Ana Kategori Seç')}}
		<select name="parentCategory" id="parentCategory">
			<option value="0">Ana Kategori Yok</option>
			@if(count($parentCategoryOptions) > 0)
				@foreach($parentCategoryOptions as $parentCategoryId => $parentCategoryName)
					<option value="{{ $parentCategoryId }}">{{ $parentCategoryName }}</option>
				@endforeach
			@endif
		</select>
	</div>
	<div class="form-group">
		{{Form::label('featuredLogo', 'Tanıtıcı Resim (logo)')}}
		{!! Form::file('featuredLogo', ['class' => 'form-control']) !!}
	</div>
	{{Form::submit('Kategori Ekle', ['class' => 'btn btn-primary'])}}
{{ Form::close() }}
@endsection