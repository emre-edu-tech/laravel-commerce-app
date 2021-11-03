@extends('layouts.app')

@section('content')
<h2>Ürün Kategorisi Güncelleme</h2>
<form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="name">Kategori Adı</label>
		<input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}">
	</div>
	<div class="form-group">
		<label for="description">Kategori Açıklama</label>
		<textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $category->description }}</textarea>
	</div>
	<div class="form-group">
		<label for="parentCategory">Ana Kategori Seç</label>
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
		<label for="featuredLogo">Tanıtıcı Resim (logo) Güncelle</label>
		<input type="file" name="featuredLogo" id="featuredLogo" class="form-control">
	</div>
	<input type="hidden" name="_method" value="PUT">
	<input type="submit" value="Kategori Güncelle" class="btn btn-primary">
</form>

<form action="{{ route('categories.destroy', $category->id) }}" method="post">
	@csrf
	<input type="hidden" name="_method" value="DELETE">
	<input type="submit" value="Kategori Sil" class="btn btn-danger">
</form>
<a href="/admin/categories" class="btn btn-secondary">Kategorilere Dön</a>
@endsection