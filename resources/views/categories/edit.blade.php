@extends('layouts.app')

@section('content')
<h2>Ürün Kategorisi Güncelleme</h2>
{{ Form::open(['action' => ['CategoriesController@update', $category->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
	<div class="form-group">
		{{Form::label('name', 'Kategori Adı')}}
		{{Form::text('name', $category->name, ['class' => 'form-control'])}}
	</div>
	<div class="form-group">
		{{Form::label('description', 'Kategori Açıklama')}}
		{{Form::textArea('description', $category->description, ['class' => 'form-control'])}}
	</div>
	<div class="form-group">
		{{Form::label('parentCategory', 'Ana Kategori Seç')}}
		<select name="parentCategory" id="parentCategory">
			@if(count($parentCategoryOptions) > 0)
				<option value="0" {!!($category->parent_id==0) ? 'selected' : '' !!}>Ana Kategori</option>
				@foreach($parentCategoryOptions as $parentCategoryId => $parentCategoryName)
					<option {!!($category->parent_id == $parentCategoryId) ? 'selected' : '' !!} value="{{ $parentCategoryId }}">{{ $parentCategoryName }}</option>
				@endforeach
			@endif
		</select>
	</div>
	<div class="form-group">
		Şimdiki Logo: <a href="{{ url('storage/categories/original/'.$category->featured_logo) }}" target="_blank"><img src="{{ url('storage/categories/'.$category->thumb_featured_logo) }}"></a>
		<br>
		{{Form::label('featuredLogo', 'Tanıtıcı Resim (logo) Güncelle')}}
		{!! Form::file('featuredLogo', ['class' => 'form-control']) !!}
	</div>
	{{ Form::hidden('_method', 'PUT') }}
	{{ Form::submit('Kategori Güncelle', ['class' => 'btn btn-primary']) }}
{{ Form::close() }}

{{ Form::open(['action' => ['CategoriesController@destroy', $category->id], 'method' => 'POST']) }}
	{{ Form::hidden('_method', 'DELETE')}}
	{{ Form::submit('Kategori Sil', ['class' => 'btn btn-danger']) }}
{{ Form::close() }}
<a href="/admin/categories" class="btn btn-secondary">Kategorilere Dön</a>
@endsection