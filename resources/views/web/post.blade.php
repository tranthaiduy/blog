@extends('web.layout.master')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
<section class="section single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-title-area text-center">
                        <ol class="breadcrumb hidden-xs-down">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/category">Blog</a></li>
                            <li class="breadcrumb-item active">{{ $post->title }}</li>
                        </ol>

                        <span class="color-orange"><a href="{{ route('web.category', $post->category->slug) }}">{{ $post->category->name }}</a></span>

                        <h3>{{ $post->title }}</h3>

                        <div class="blog-meta big-meta">
                            <small>{{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }} </small>
                            <small>by {{ $post->user->name }} </small>
                            <small><i class="fa fa-eye"></i> {{ $post->view_counts }}</small>
                        </div>

                        <div class="post-sharing">
                            <ul class="list-inline">
                                <li><a href="#" class="fb-button btn btn-primary"><i class="fa-brands fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                                <li><a href="#" class="tw-button btn btn-primary"><i class="fa-brands fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="single-post-media">
                        <img src="{{ $post->imageUrl() }}" alt="" class="img-fluid">
                    </div>

                    <div class="blog-content">  
                        <div class="pp">
                            <p>{{ $post->description }}</p>

                            <p>{!! $post->content !!}</p>

                        </div>
                    </div>

                    <hr class="invis1">

                    <div class="custombox clearfix">
                        <h4 class="small-title">You may also like</h4>
                        <div class="row">
                            @foreach ($relate as $item)
                            <div class="col-lg-6">
                                <div class="blog-box">
                                    <div class="post-media">
                                        <a href="{{ route('web.post', $item->slug) }}" title="">
                                            <img src="{{ $item->imageUrl() }}" alt="" class="img-fluid">
                                            <div class="hovereffect">
                                                <span class=""></span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="blog-meta">
                                        <h4><a href="{{ route('web.post', $item->slug) }}" title="">{{ $item->title }}</a></h4>
                                        <small>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</small>
                                        <small>by {{ $item->user->name }} </small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <hr class="invis1">

                    <div class="custombox clearfix">
                        <h4 class="small-title">{{ $post->comments()->count() }} Comments</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="comments-list">
                                    @foreach ($post->comments as $comment)
                                    <div class="media">
                                        <!-- <a class="media-left" href="#">
                                            <img src="upload/author.jpg" alt="" class="rounded-circle">
                                        </a> -->
                                        <div class="media-body">
                                            <h4 class="media-heading user_name">{{ $comment->user->name }} <small>{{ \Carbon\Carbon::parse($comment->created_at)->format('d-m-Y') }}</small></h4>
                                            <p>{{ $comment->content }}</p>
                                            <a href="#" class="btn btn-primary btn-sm">Reply</a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="invis1">

                    @if (\Illuminate\Support\Facades\Auth::check())
                    <div class="custombox clearfix">
                        <h4 class="small-title">Leave a Reply</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{ route('web.post.comment', $post->id) }}" class="form-wrapper" method="post">
                                    @csrf
                                    <textarea class="form-control" name="content" placeholder="Your comment"></textarea>
                                    <button type="submit" class="btn btn-primary">Submit Comment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
            
                <div class="sidebar">
                    <div class="widget">
                        <h2 class="widget-title">Highlight Posts</h2>
                        <div class="blog-list-widget">
                            @foreach ($highlight as $item)
                            <div class="blog-box">
                                <div class="post-media">
                                    <a href="{{ route('web.post', $item->slug) }}" title="">
                                        <img style="height: 150px;" src="{{ $item->imageUrl() }}" alt="" class="">
                                        <div class="hovereffect">
                                            <span class=""></span>
                                        </div>
                                    </a>
                                </div>
                                <div class="blog-meta">
                                    <h4><a href="{{ route('web.post', $item->slug) }}" title="">{{ $item->title }}</a></h4>
                                </div>
                            </div>
                            
                            <hr class="invis">
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection
