@extends('layouts.app')

@section('content')
	<h2>Kategori Detayı</h2>
	<hr>
	@if(isset($category))
		<div class="card">
			<div class="card-header">
				Ana Kategori: 
				@if($category->parent_id == 0)
					<strong>{{'Yok'}}</strong>
				@else
					{{ $category->parent->name }}
				@endif,
				Kategori: <strong>{{ $category->name }}</strong>
			</div>
			<div class="card-info"><strong>Kategori Açıklama:</strong> {{ $category->description }}</div>
			<div class="card-img">
				<strong>Logo:</strong>
				<a href="{{ url('storage/original/'.$category->featured_logo) }}" target="_blank"><img src="{{ url('storage/'.$category->thumb_featured_logo) }}"></a>
			</div>
			<div class="card-footer">
				<a href="/admin/categories/{{$category->id}}/edit" class="btn btn-primary">Kategori Güncelle</a>
				<a href="/admin/categories" class="btn btn-secondary">Kategorilere Dön</a>
			</div>
		</div>
	@else
		<div class="alert alert-danger">
			Sorgulamada hata oluştu. Lütfen tekrar deneyin.
		</div>
	@endif
@endsection