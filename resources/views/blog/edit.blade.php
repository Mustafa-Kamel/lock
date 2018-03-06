@extends('blog.layouts.masterAdmin')
@push('head')
    <script src="https://cdn.ckeditor.com/4.8.0/full/ckeditor.js"></script>
@endpush

@section('content')
<main class="posts blog-post col-lg-10 offset-md-1">
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Update {{ $post->title }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('post.update', $post->slug) }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT')}}
                    <div class="form-group row">
                        <label for="title" class="col-md-2 col-form-label text-md-left">Title *</label>
                        <div class="col-md-9">
                            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                        value="@if(NULL !== old('title')){{ old('title') }}@else{{ $post->title }}@endif" required autofocus>
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="slug" class="col-md-2 col-form-label text-md-left">Slug</label>
                        <div class="col-md-9">
                            <input id="slug" type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug"
                                value="@if(NULL !== old('slug')){{ old('slug') }}@else{{ $post->slug }}@endif">
                                @if ($errors->has('slug'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="slug" class="col-md-2 col-form-label text-md-left">Category *</label>
                        <div class="col-md-9">
                            <select class="form-control form-control-3:md{{ $errors->has('category_id') ? ' is-invalid' : '' }}" name="category_id" id="category_id">
                            <option selected>Select one</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"{{ /* old('category_id') */$post->category_id == $category->id ? ' selected' : '' }}>{{ $category->title }}</option>
                            @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="img" class="col-md-2 col-form-label text-md-left">Post Cover</label>
                        <div class="col-md-9">
                            <input id="img" type="file" class="form-control{{ $errors->has('img') ? ' is-invalid' : '' }}" name="img"
                                value="@if(NULL !== old('img')){{ old('img') }}@else{{ $post->img }}@endif">
                                @if ($errors->has('img'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('img') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="body" class="col-md-2 col-form-label text-md-left">Post Body *</label>
                        <div class="col-md-9">
                            <textarea id="body" type="text" class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" name="body" style="height: 200px;">@if(NULL !== old('body')){{ old('body') }}@else{{ $post->body }}@endif
                            </textarea>
                                @if ($errors->has('body'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4 text-center">
                            <button type="submit" class="btn btn-primary">Save Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@push('script')
    <script>
        CKEDITOR.replace('body');
    </script>
@endpush