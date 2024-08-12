@extends('site.layouts.master')
@section('title')
    <title>{{ $config->web_title  . ' - '. ucfirst($_SERVER['HTTP_HOST']) }}</title>
@endsection
@section('content')
    <div ng-controller="Contact">
        <!-- =========================
  HOME SECTION
============================== -->
        <section id="home" class="parallax-section">
            <div class="container">
                <div class="row">

                    <div class="col-md-offset-1 col-md-10 col-sm-12">
                        {{--                    <h3 class="wow bounceIn" data-wow-delay="0.9s">--}}
                        {{--                      {{ $config->line_text_1 }}--}}
                        {{--                    </h3>--}}
                        {{--                    <h1 class="wow fadeInUp" data-wow-delay="1.6s">--}}
                        {{--                      {!! $config->line_text_2 !!}--}}
                        {{--                    </h1>--}}
{{--                        <a href="#overview" class="wow fadeInUp smoothScroll btn btn-default" data-wow-delay="2s">  {{ $config->line_text_3 }}</a>--}}
                    </div>

                </div>
            </div>
        </section>


        <!-- =========================
            OVERVIEW SECTION
        ============================== -->
        <section id="overview" class="parallax-section">
            <div class="container">
                <div class="row">

                    <div class="col-md-6 col-sm-12">
                        <img src="{{@$bannerTrangchu[2]->image->path ?? ''}}" class="img-responsive" alt="Overview">
                        <blockquote class="wow fadeInUp" data-wow-delay="1.9s">
                            {{ $config->about1 }}
                        </blockquote>
                    </div>

                    <div class="col-md-1"></div>

                    <div class="wow fadeInUp col-md-4 col-sm-12" data-wow-delay="1s">
                        <div class="overview-detail">
                            <h2>Đôi nét về tôi</h2>
                            {!! $config->about2 !!}
                            <a href="#newsletter" class="btn btn-default smoothScroll">Để lại tin nhắn</a>
                        </div>
                    </div>

                    <div class="col-md-1"></div>

                </div>
            </div>
        </section>


        <!-- =========================
            TRAINER SECTION
        ============================== -->


        <!-- =========================
            NEWSLETTER SECTION
        ============================== -->
        <section id="newsletter" class="parallax-section">
            <div class="container">
                <div class="row">

                    <div class="wow fadeInUp col-md-offset-2 col-md-8 col-sm-offset-1 col-sm-10" data-wow-delay="0.9s">
                        <h2>Signup Newsletter</h2>
                        <p ng-if="! sendSuccess" style="font-weight: bold">Để lại lời nhắn cho mình</p>
                        <p ng-if="sendSuccess" style="font-weight: bold">Cảm ơn bạn đã để lại lời nhắn. Chúc bạn một ngày tốt lành!</p>

                        <div class="newsletter_detail" ng-if="! sendSuccess">

                            <div  id="newsletter-signup">
                                <div class="col-md-6 col-sm-6">
                                    <input name="name" type="text" class="form-control" id="name" ng-model="contact.user_name" placeholder="Họ tên">
                                    <div class="help-block with-errors" ng-if="errors && errors.user_name">
                                        <ul class="list-unstyled" style="text-align: left; color: darkred">
                                            <li><% errors.user_name[0] %></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <input name="email" type="text" class="form-control" ng-model="contact.email" id="email" placeholder="Email">
                                    <div class="help-block with-errors" ng-if="errors && errors.email">
                                        <ul class="list-unstyled" style="text-align: left; color: darkred">
                                            <li><% errors.email[0] %></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <textarea class="form-control" rows="3"  ng-model="contact.content" placeholder="Nội dung"></textarea>
                                    <div class="help-block with-errors" ng-if="errors && errors.content">
                                        <ul class="list-unstyled" style="text-align: left; color: darkred">
                                            <li><% errors.content[0] %></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8">
                                    <input name="submit" type="submit" ng-click="submit()"  class="form-control" id="submit" value="Gửi đi">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section id="blog" class="parallax-section">
            <div class="container">
                <div class="row">
                    @php
                        $delay = 0.9;
                        $step = 0.3;
                    @endphp
                    <div class="col-md-12 col-sm-12 text-center">
                        <h2>Chuyện chia sẻ</h2>
                        <p>Những chia sẻ của mình</p>
                    </div>

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
        </section>

    </div>
@endsection

@push('scripts')
    <script>
        $(function(){
            jQuery(document).ready(function() {
                $('#home').backstretch([
                    "{{@$bannerTrangchu[0]->image->path ?? ''}}",
                    "{{@$bannerTrangchu[1]->image->path ?? ''}}",

                ],  {duration: 3000, fade: 750});
            });
        })
    </script>

    <script>
        // $(function(){
        //     jQuery(document).ready(function() {
        //         $('#home').backstretch([
        //             "images/home-bg-slider-img1.jpg",
        //         ],  {duration: 2000, fade: 750});
        //     });
        // })
    </script>
    @push('scripts')
        <script>
            app.controller('Contact', function ($scope, $http) {
                $scope.contact = {};
                $scope.submit = function() {
                    var url = "{{route('send.contact')}}";
                    $scope.loading = true;
                    jQuery.ajax({
                        url: url,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{!! csrf_token() !!}'
                        },
                        data: $scope.contact,
                        beforeSend: function() {
                            jQuery('.loading').show();
                        },
                        success: function(response) {
                            if (response.success) {
                                $scope.errors = null;
                                $scope.sendSuccess = true;
                            } else {
                                $scope.errors = response.errors;
                            }
                        },
                        error: function(err) {
                            console.log(err);
                        },
                        complete: function() {
                            jQuery('.loading').hide();
                            $scope.$apply();
                        }
                    });
                }
            })
        </script>
    @endpush
@endpush
