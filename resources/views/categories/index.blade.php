@extends('layouts.app')

@section('content')
	<h2>Ürün Kategorileri</h2>
	<form action="{{ route('categories.search') }}" method="post">
		@csrf
		<div class="form-group">
			<input type="text" name="searchTerm" id="searchTerm" class="form-control" placeholder="Arama Yap">
		</div>
		<div class="form-group">
			<input type="submit" value="Kategorilerde ara" class="btn btn-primary">
		</div>
	</form>
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