@extends('blog.layouts.master') 
@section('title')
@if (isset($category))
    {{ $category->title }}
@else
    Latest
@endif
    Posts
@endsection
 
@section('content')
<!-- Latest Posts -->
<main class="posts-listing col-lg-8">
    <div class="container">
        <h1 class="mb-5">
            @if (isset($category))
                {{ $category->title }}
            @else
                Latest
            @endif
            Posts
        </h1>
        <div class="row">
            @forelse ($posts as $post)
            <!-- post -->
            <div class="post col-xl-6">
                <div class="post-thumbnail">
                    <a href="{{ route('post.show', $post->slug) }}"><img src="{{ asset($post->img) }}" alt="..." class="img-fluid"></a>
                </div>
                {{--
                <div class="post-thumbnail">
                    <a href="{{ route('post.show', $post->slug) }}"><img src="{{ asset('img').'/'.$post->img }}" alt="..." class="img-fluid"></a>
                </div>
                --}}
                <div class="post-details">
                    <div class="post-meta d-flex justify-content-between">
                        <div class="date meta-last">
                            {{ Carbon\Carbon::createFromTimeStamp(strtoTime($post->created_at))->toFormattedDateString() }}
                        </div>
                        <div class="category">
                            <a href="{{ route('category.show', $post->category->slug) }}">{{ $post->category->title }}</a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('post.show', $post->slug) }}">
                            <h3 class="h4">{{ $post->title }}</h3>
                        </a>
                        @auth
                            <div class="d-flex">
                                <div class="btn-group-vertical btn-group-sm" role="group" aria-label="Basic example">
                                    <a href="{{ route('post.edit', $post->slug) }}" class="btn {{--  btn-outline-primary  --}}"><i class="fa fa-pencil"></i></a>
                                    <form action="{{ route('post.destroy', $post->slug) }}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        @endauth
                    </div>
                    <p class="text-muted">{!! str_limit($post->body, 100) !!}</p>
                    <footer class="post-footer d-flex align-items-center">
                        <a href="{{ route('post.user', $post->user->id) }}" class="author d-flex align-items-center flex-wrap">
                            <div class="avatar"><img src="{{ asset($post->user->avatar) }}" alt="{{ $post->user->firstname }}" class="img-fluid"></div>
                            <div class="title"><span>{{ $post->user->firstname }}</span></div>
                        </a>
                        <div class="date"><i class="icon-clock"></i>
                            {{ Carbon\Carbon::createFromTimeStamp(strtoTime($post->created_at))->diffForHumans() }}
                        </div>
                        <div class="comments meta-last"><i class="icon-comment"></i>12</div>
                    </footer>
                </div>
            </div>
            @empty
                <h3>There are no products</h3>
            @endforelse
        </div>
        {{ $posts->links('blog.layouts.paginator') }}
    </div>
</main>
@endsection