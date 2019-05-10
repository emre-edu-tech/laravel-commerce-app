@extends('layouts.app')

@section('content')
<h2>Blog Kategorisi Ekleyin</h2>
{{ Form::open(['action' => 'PostCategoriesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
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
			<option value="0">Ana kategori yok</option>
			@if(count($parentCategories) > 0)
				@foreach($parentCategories as $parentCategory)
					<option value="{{$parentCategory->id}}">{{$parentCategory->name}}</option>
					@if(count($parentCategory->children)>0)
						@foreach($parentCategory->children as $child)
							<option value="{{$child->id}}">-- {{$child->name}}</option>
						@endforeach
					@endif
				@endforeach
			@endif
		</select>
	</div>
	<div class="form-group">
		{{Form::label('featuredImage', 'Tanıtıcı Resim (logo)')}}
		{!! Form::file('featuredImage', ['class' => 'form-control']) !!}
	</div>
	{{Form::submit('Kategori Ekle', ['class' => 'btn btn-primary'])}}
{{ Form::close() }}
@endsection