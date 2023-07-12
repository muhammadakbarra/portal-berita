@extends('master')

@section('content')
<div class="container padding">
    <h1 class="text-primary my-2">Add News</h1>
    <form action="/news" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="title">News Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" cols="30" rows="10"></textarea>
            </div>
        @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Select a Category</option>
                    @forelse($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @empty
                        <option value="">-- No Category --</option>
                    @endforelse
                </select>
            </div>
        @error('category_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
            <div class="form-group">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-control">
            </div>
        @error('thumbnail')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Tambah</button>
    
</form>
</div>
    
@endsection