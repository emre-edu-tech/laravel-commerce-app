@extends('layouts.app')

@section('content')
<h2>Blog Kategorisi Ekleyin</h2>
<form action="{{ route('postcategories.store') }}" method="post" enctype="multipart/form-data">
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
		<label for="featuredImage">Tanıtıcı Resim (logo)</label>
		<input type="file" name="featuredImage" id="featuredImage" class="form-control">
	</div>
	<input type="submit" value="Kategori Ekle" class="btn btn-primary">
</form>
@endsection