@extends('layouts.app')

@section('content')
<h2>Blog Kategorisi Güncelleme</h2>
<form action="{{ route('postcategories.update', $postcategory->id) }}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="name">Kategori Adı</label>
		<input type="text" name="name" id="name" class="form-control" value="{{ $postcategory->name }}">
	</div>
	<div class="form-group">
		<label for="description">Kategori Açıklama</label>
		<textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $postcategory->description }}</textarea>
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
</form>
@endsection