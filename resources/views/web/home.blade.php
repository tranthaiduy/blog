@extends('web.layout.master')

@section('title')
    Home
@endsection

@section('content')
<section class="section first-section">
    <div class="container-fluid">
        <div class="masonry-blog clearfix">

            @foreach ($highlight as $key => $post)
            @if ($key == 0)
                <div class="first-slot">
            @elseif ($key == 1)
                <div class="second-slot">
            @elseif ($key == 2)
                <div class="last-slot">
            @endif
                    <div class="masonry-box post-media">
                        <img src="{{ $post->imageUrl() }}" alt="" class="img-fluid">
                        <div class="shadoweffect">
                            <div class="shadow-desc">
                                <div class="blog-meta">
                                    <span class="bg-orange"><a href="{{ route('web.category', $post->category->slug) }}" title="">{{ $post->category->name }}</a></span>
                                    <h4><a href="{{ route('web.post', $post->slug) }}" title="">{{ $post->title }}</a></h4>
                                    <small>{{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }}</small>
                                    <small>by {{ $post->user->name }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-wrapper">
                    <div class="blog-top clearfix">
                        <h4 class="pull-left">Recent News <a href="#"><i class="fa-solid fa-fire"></i></a></h4>
                    </div>
                    
                    <div class="blog-list clearfix">
                        @foreach ($new as $post)
                        <div class="blog-box row">
                            <div class="col-md-4">
                                <div class="post-media">
                                    <a href="{{ route('web.post', $post->slug) }}" title="">
                                        <img src="{{ $post->imageUrl() }}" alt="" class="img-fluid">
                                        <div class="hovereffect"></div>
                                    </a>
                                </div>
                            </div>

                            <div class="blog-meta big-meta col-md-8">
                                <h4 style="margin-left: 1px;"><a href="{{ route('web.post', $post->slug) }}" title="">{{ $post->title }}</a></h4>
                                <p style="margin-left: 26px;">{{ $post->description }}</p>
                                <small style="margin-left: 20px;" class="firstsmall"><a class="bg-orange" href="{{ route('web.category', $post->category->slug) }}" title="">{{ $post->category->name }}</a></small>
                                <small><a href="tech-single.html" title="">{{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }} </a></small>
                                <small><a href="tech-author.html" title="">by {{ $post->user->name }} </a></small>
                                <small><a href="tech-single.html" title=""><i class="fa fa-eye"></i> {{ $post->view_counts }}</a></small>
                            </div>
                        </div>
                        

                        <hr class="invis">

                        @endforeach
                    </div>
                </div>
                
                <hr class="invis">

                
            </div>
        </div>
    </div>
</section>
@endsection
