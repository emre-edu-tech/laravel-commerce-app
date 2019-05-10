@extends('layouts.app')

@section('content')
	<h2>Blog Kategori Detayı</h2>
	<hr>
	@if(isset($postCategory))
		<div class="card">
			<div class="card-header">
				Ana Kategori: <strong>
				@if($postCategory->parent_category_id == 0)
					{{'yok'}}
				@else
					{{$postCategory->parent->name}}
				@endif
				</strong>
				Kategori: <strong>{{ $postCategory->name }}</strong>
			</div>
			<div class="card-info"><strong>Kategori Açıklama:</strong> {{ $postCategory->description }}</div>
			<div class="card-img">
				<strong>Kategori Resmi: </strong>
				<a href="{{ url('storage/postcategories/original/'.$postCategory->featured_image) }}" target="_blank"><img src="{{ url('storage/postCategories/'.$postCategory->thumb_featured_image) }}"></a>
			</div>
			<div class="card-footer">
				<a href="/admin/postcategories/{{$postCategory->id}}/edit" class="btn btn-primary">Kategori Güncelle</a>
				<a href="/admin/postcategories" class="btn btn-secondary">Kategorilere Dön</a>
			</div>
		</div>
	@else
		<div class="alert alert-danger">
			Sorgulamada hata oluştu. Lütfen tekrar deneyin.
		</div>
	@endif
@endsection