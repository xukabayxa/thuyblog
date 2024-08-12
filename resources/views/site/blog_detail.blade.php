@extends('site.layouts.master')
@section('title')
    <title>{{ $config->web_title  . ' - '. ucfirst($_SERVER['HTTP_HOST']) }}</title>
@endsection
@section('content')
    <section id="blog-header" class="parallax-section" style="background-image: url({{$post->image->path ?? ''}})">
        <div class="container">
            <div class="row">

                <div class="col-md-offset-2 col-md-8 col-sm-12">
                    <h3 class="wow bounceIn" data-wow-delay="0.9s">Blog Thúy Nguyễn</h3>
                    <h1 class="wow fadeInUp" data-wow-delay="1.6s">{{$post->name}}</h1>
                </div>

            </div>
        </div>
    </section>

    <section id="blog" class="parallax-section">
        <div class="container">
            <div class="row">

                <style>
                    h2 {
                        font-size: 30px;
                        padding-bottom: 18px;
                        text-transform: uppercase;
                    }
                </style>
                <div class="col-md-8 col-sm-7">
                    <div class="blog-content wow fadeInUp" data-wow-delay="1s">
                        <h3>{{$post->name}}</h3>
                        <span class="meta-date"><a href="#">{{$post->created_at->format('d/m/Y')}}</a></span>
                        <span class="meta-author"><a href="#blog-author">{{$post->user_create->name}}</a></span>
                        <div class="blog-clear"></div>

                        {!! $post->body !!}
                    </div>
                </div>

                <div class="col-md-4 col-sm-5 wow fadeInUp" data-wow-delay="1.3s">

                    <div class="blog-categories">
                        <h3>Chủ đề</h3>
                        @foreach($categories as $category)
                            <li><a href="{{ route('front.blog-detail', [$category->slug]) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </div>

                    <div class="recent-post">
                        <h3>Bài viết khác</h3>
                        @foreach($postsRelated as $post_ )
                            <div class="media">
                                <div class="media-object pull-left">
                                    <a href="{{ route('front.blog-detail', ['slugCate' => $post_->category->slug, 'slug' => $post_->slug]) }}"><img src="{{ $post_->image->path ?? '' }}" class="img-responsive" alt="blog"></a>
                                </div>
                                <div class="media-body">
                                    <h5>{{$post_->created_at->format('d/m/Y')}}</h5>
                                    <h4 class="media-heading"><a href="{{ route('front.blog-detail', ['slugCate' => $post_->category->slug, 'slug' => $post_->slug]) }}">{{$post_->name}}</a></h4>
                                </div>
                            </div>
                        @endforeach


                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection

@push('scripts')
@endpush
