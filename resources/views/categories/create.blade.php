@extends('layouts.app')

@section('content')
<h2>Ürün Kategorisi Ekleyin</h2>

<form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="name">Kategori Adı</label>
		<input type="text" name="name" id="name" class="form-control">
	</div>
	<div class="form-group">
		<label for="description">Kategori Açıklama</label>
		<textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
	</div>
	<div class="form-group">
		<label for="parentCategory">Ana Kategori Seç</label>
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
		<label for="featuredLogo">Tanıtıcı Resim (logo)</label>
		<input type="file" name="featuredLogo" id="featuredLogo" class="form-control">
	</div>
	<input type="submit" value="Kategori Ekle" class="btn btn-primary">
</form>
@endsection