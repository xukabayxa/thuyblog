@extends('site.layouts.master')
@section('title')
    <title>{{ $config->web_title  . ' - '. ucfirst($_SERVER['HTTP_HOST']) }}</title>
@endsection
@section('content')
    <section id="blog-header" class="parallax-section" style="background-image: url({{@$banner->image->path ?? ''}})">
        <div class="container">
            <div class="row">

                <div class="col-md-offset-2 col-md-8 col-sm-12">
                    <h3 class="wow bounceIn" data-wow-delay="0.9s">Thúy Nguyễn Blog</h3>
                </div>

            </div>
        </div>
    </section>

    <section id="blog" class="parallax-section">
        <div class="container">
            <div class="col-md-9 col-sm-8">
                <div class="row">

                    <style>
                        h2 {
                            font-size: 30px;
                            padding-bottom: 18px;
                            text-transform: uppercase;
                        }
                    </style>

                    @php
                        $delay = 0.9;
                        $step = 0.3;
                    @endphp


                    @foreach($posts as $post)
                        <div class="wow fadeInUp col-md-6 col-sm-12" data-wow-delay="{{$delay}}s">
                            <div class="blog-thumb">
                                <span class="blog-date">{{$post->category->name}} / {{$post->created_at->format('d-m-Y')}}</span>
                                <h3 class="blog-title"><a href="{{ route('front.blog-detail', ['slugCate' => $post->category->slug, 'slug' => $post->slug]) }}">{{$post->name}}</a></h3>
                                <h5 id="blog-author">by {{$post->user_create->name}}</h5>
                            </div>
                        </div>

                        @php
                            $delay += $step;
                        @endphp
                    @endforeach

                </div>

            </div>

            <div class="col-md-3 col-sm-4 wow fadeInUp" data-wow-delay="1.3s">

                <div class="blog-categories">
                    <h3>Chủ đề</h3>
                    @foreach($categories as $category)
                        <li><a href="{{ route('front.blog-detail', [$category->slug]) }}">{{ $category->name }}</a></li>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

@endsection

@push('scripts')
@endpush
