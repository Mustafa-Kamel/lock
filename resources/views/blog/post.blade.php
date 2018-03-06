@extends('blog.layouts.master') 

@section('title', $post->title)

@section('content')
<main class="post blog-post col-lg-8">
    <div class="container">
        <div class="post-single">
            <div class="post-thumbnail"><img src="{{ asset($post->img) }}" alt="{{ $post->title }}" class="img-fluid"></div>
            {{--  <div class="post-thumbnail"><img src="{{ asset('img').'/'.$post->img }}" alt="{{ $post->title }}" class="img-fluid"></div>  --}}
            <div class="post-details">
                <div class="post-meta d-flex justify-content-between">
                    <div class="category"><a href="{{ route('category.show', $post->category->slug) }}">{{ $post->category->title }}</a></div>
                </div>
                <div class="d-flex justify-content-between">
                    <h1>{{ $post->title }}<a href="{{ route('post.show', $post->slug) }}"><i class="fa fa-bookmark-o"></i></a></h1>
                    @auth
                        <div class="d-flex">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <form action="{{ route('post.destroy', $post->slug) }}" method="post">
                                    @csrf
                                    <a href="{{ route('post.edit', $post->slug) }}" class="btn {{--  btn-outline-primary  --}}"><i class="fa fa-pencil"></i></a>
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>
                <div class="post-footer d-flex align-items-center flex-column flex-sm-row">
                    <a href="{{ route('post.user', $post->user->id) }}" class="author d-flex align-items-center flex-wrap">
                        <div class="avatar"><img src="{{ asset($post->user->avatar) }}" alt="{{ $post->user->firstname }}" class="img-fluid"></div>
                        <div class="title"><span>{{ $post->user->firstname }}</span></div>
                    </a>
                    <div class="d-flex align-items-center flex-wrap">
                        <div class="date"><i class="icon-clock"></i> {{ Carbon\Carbon::createFromTimeStamp(strtoTime($post->created_at))->diffForHumans() }}</div>
                        <div class="views"><i class="icon-eye"></i> 500</div>
                        <div class="comments meta-last"><i class="icon-comment"></i>12</div>
                    </div>
                </div>
                <div class="post-body">
                    <p class="lead">{!! $post->body !!}
                    <blockquote class="blockquote">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                            et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                            ut aliquip.</p>
                        <footer class="blockquote-footer">Someone famous in
                            <cite title="Source Title">Source Title</cite>
                        </footer>
                    </blockquote>
                </div>





                
                <div class="post-tags"><a href="#" class="tag">#Business</a><a href="#" class="tag">#Tricks</a><a href="#" class="tag">#Financial</a>
                    <a href="#" class="tag">#Economy</a>
                </div>
                <div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row">
                    <a href="#" class="prev-post text-left d-flex align-items-center">
                        <div class="icon prev"><i class="fa fa-angle-left"></i></div>
                        <div class="text"><strong class="text-primary">Previous Post </strong>
                            <h6>I Bought a Wedding Dress.</h6>
                        </div>
                    </a>
                    <a href="#" class="next-post text-right d-flex align-items-center justify-content-end">
                        <div class="text"><strong class="text-primary">Next Post </strong>
                            <h6>I Bought a Wedding Dress.</h6>
                        </div>
                        <div class="icon next"><i class="fa fa-angle-right">   </i></div>
                    </a>
                </div>
                <div class="post-comments">
                    <header>
                        <h3 class="h6">Post Comments<span class="no-of-comments">(3)</span></h3>
                    </header>
                    <div class="comment">
                        <div class="comment-header d-flex justify-content-between">
                            <div class="user d-flex align-items-center">
                                <div class="image"><img src="img/user.svg" alt="..." class="img-fluid rounded-circle"></div>
                                <div class="title"><strong>Jabi Hernandiz</strong><span class="date">May 2016</span></div>
                            </div>
                        </div>
                        <div class="comment-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                        </div>
                    </div>
                    <div class="comment">
                        <div class="comment-header d-flex justify-content-between">
                            <div class="user d-flex align-items-center">
                                <div class="image"><img src="img/user.svg" alt="..." class="img-fluid rounded-circle"></div>
                                <div class="title"><strong>Nikolas</strong><span class="date">May 2016</span></div>
                            </div>
                        </div>
                        <div class="comment-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                        </div>
                    </div>
                    <div class="comment">
                        <div class="comment-header d-flex justify-content-between">
                            <div class="user d-flex align-items-center">
                                <div class="image"><img src="img/user.svg" alt="..." class="img-fluid rounded-circle"></div>
                                <div class="title"><strong>John Doe</strong><span class="date">May 2016</span></div>
                            </div>
                        </div>
                        <div class="comment-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                        </div>
                    </div>
                </div>
                <div class="add-comment">
                    <header>
                        <h3 class="h6">Leave a reply</h3>
                    </header>
                    <form action="#" class="commenting-form">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" name="username" id="username" placeholder="Name" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" name="username" id="useremail" placeholder="Email Address (will not be published)" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea name="usercomment" id="usercomment" placeholder="Type your comment" class="form-control"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-secondary">Submit Comment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection