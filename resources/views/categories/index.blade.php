@extends('layouts.app')

@section('content')
	<h2>Ürün Kategorileri</h2>
	{{ Form::open(['action' => 'CategoriesController@search', 'method' => 'POST']) }}
		<div class="form-group">
			{{Form::text('searchTerm', '', ['class' => 'form-control', 'placeholder' => 'Arama yap']) }}
		</div>
		<div class="form-group">
			{{ Form::submit('Kategorilerde ara', ['class' => 'btn btn-primary']) }}
		</div>
	{{ Form::close() }}
	@if(count($categories) > 0)
		<table class="table">
			<tr>
				<th>Ana Kategori</th>
				<th>Kategori Adı</th>
				<th>Logo</th>
				<th>Kategori Detay</th>
			</tr>
			@foreach($categories as $category)
			<tr>
				@if($category->parent_id == 0)
					<td>{{'Yok'}}</td>
				@else
					<td>{{$category->parent->name}}</td>
				@endif
				<td><a href="/admin/categories/{{$category->id}}/edit"><strong>{{$category->name}}</strong></a></td>
				<td>{{ $category->description }}</td>
				<td><a href="/admin/categories/{{$category->id}}">İncele</a></td>
			</tr>
			@endforeach
		</table>
	@else
		<p class="alert alert-danger">Herhangi bir kategori bulunamadı</p>
	@endif
@endsection