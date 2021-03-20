@extends('layouts.layout')

@section('content')

<div class="row text-center" >

    <div class="col-12 mt-5" style="padding: 0">
        <div id="carouselExampleControls6" class="carousel slide mt-4" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class=" img-fluid" src="{{asset('img/1.png')}}" alt="First slide" width="250">
                </div>
                <div class="carousel-item">
                    <img class=" img-fluid" src="{{asset('img/3.png')}}" alt="First slide" width="250">
                </div>

            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls6" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls6" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    </div>
</div>


@endsection

{{--@section('content2')--}}
{{--    <div class="row text-center d-lg-none">--}}
{{--        <div class="col-sm-6 col-lg-6 col-md-6 col-xl-6 d-lg-none mt-3" style="padding: 0">--}}
{{--            <h1 style=" font-size: 40px; padding-left: 20px; padding-right: 20px; color: #343434">Your collection of microservices for social networks</h1>--}}
{{--            <h5 class="mt-3" style=" font-size: 20px; padding-left: 20px; padding-right: 20px; color: #343434">You personal/band page with basic information, posts and calendar of latest events</h5>--}}
{{--            <hr>--}}
{{--            <h5 style=" font-size: 20px; padding-left: 20px; padding-right: 20px; color: #343434">Page with all you events and possibility add information about event: add cover, main information(datetime, place...), add social network links, and links to buy tickets</h5>--}}
{{--            <hr>--}}
{{--            <h5 style=" font-size: 20px; padding-left: 20px; padding-right: 20px; color: #343434">Page with you audio/video releases with possibility add all information: add release cover, playlist from VK, Yandex Music, Soundcloud and other services, add link to buy/listen you release</h5>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

{{--d-none d-xl-block--}}
{{--d-lg-none--}}

{{--@section('content2')--}}

{{--<div class="row text-center" >--}}
{{--    <div class="col-sm-12 col-lg-12 col-md-12 col-xl-12 mt-5 mb-5" style="padding: 0">--}}
{{--        <h1 style=" font-size: 5vh; padding-left: 20px; padding-right: 20px; color: #414141">Your personal page consists of several blocks</h1>--}}
{{--        <h1 style=" font-size: 2vh; padding-left: 20px; padding-right: 20px; color: #414141; font-family: 'Jaldi', sans-serif;">block with your personal information</h1>--}}
{{--        <h1 style=" font-size: 2vh; padding-left: 20px; padding-right: 20px; color: #414141; font-family: 'Jaldi', sans-serif;">block with various events</h1>--}}
{{--        <h1 style=" font-size: 2vh; padding-left: 20px; padding-right: 20px; color: #414141; font-family: 'Jaldi', sans-serif;">block for audio / video releases</h1>--}}
{{--        <h1 style=" font-size: 2vh; padding-left: 20px; padding-right: 20px; color: #414141; font-family: 'Jaldi', sans-serif;">block with your posts</h1>--}}
{{--        <h1 style=" font-size: 2vh; padding-left: 20px; padding-right: 20px; color: #414141; font-family: 'Jaldi', sans-serif;">in the footer which is attached below, there are links to your social networks</h1>--}}

{{--        <div id="carouselExampleControls" class="carousel slide mt-4" data-ride="carousel">--}}
{{--            <div class="carousel-inner">--}}
{{--                <div class="carousel-item active">--}}
{{--                    <img class=" img-fluid" src="{{asset('img/test2.png')}}" alt="First slide" width="250">--}}
{{--                </div>--}}
{{--                <div class="carousel-item">--}}
{{--                    <img class=" img-fluid" src="{{asset('img/test6.png')}}" alt="First slide" width="250">--}}
{{--                </div>--}}
{{--                <div class="carousel-item">--}}
{{--                    <img class=" img-fluid" src="{{asset('img/test7.png')}}" alt="First slide" width="250">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">--}}
{{--                <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
{{--                <span class="sr-only">Previous</span>--}}
{{--            </a>--}}
{{--            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">--}}
{{--                <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
{{--                <span class="sr-only">Next</span>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--@endsection--}}

{{--@section('content3')--}}

{{--    <div class="row text-center">--}}
{{--        <div class="col-sm-12 col-lg-12 col-md-12 col-xl-12 mt-5 mb-5" style="padding: 0">--}}
{{--            <h1 style=" font-size: 5vh; padding-left: 20px; padding-right: 20px; color: #414141">This is your event page</h1>--}}
{{--            <h1 style=" font-size: 2vh; padding-left: 20px; padding-right: 20px; color: #414141; font-family: 'Jaldi', sans-serif;">you can add your future events</h1>--}}
{{--            <h1 style=" font-size: 2vh; padding-left: 20px; padding-right: 20px; color: #414141; font-family: 'Jaldi', sans-serif;">add links to the meeting on social networks</h1>--}}
{{--            <h1 style=" font-size: 2vh; padding-left: 20px; padding-right: 20px; color: #414141; font-family: 'Jaldi', sans-serif;">attach ticket purchase links</h1>--}}
{{--            <h1 style=" font-size: 2vh; padding-left: 20px; padding-right: 20px; color: #414141; font-family: 'Jaldi', sans-serif;">attach your own posters and manage the description of the event</h1>--}}

{{--            <div id="carouselExampleControls2" class="carousel slide mt-4" data-ride="carousel">--}}
{{--                <div class="carousel-inner">--}}
{{--                    <div class="carousel-item active">--}}
{{--                        <img class=" img-fluid" src="{{asset('img/test8.png')}}" alt="First slide" width="250">--}}
{{--                    </div>--}}
{{--                    <div class="carousel-item">--}}
{{--                        <img class=" img-fluid" src="{{asset('img/test9.png')}}" alt="First slide" width="250">--}}
{{--                    </div>--}}
{{--                    <div class="carousel-item">--}}
{{--                        <img class=" img-fluid" src="{{asset('img/test10.png')}}" alt="First slide" width="250">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <a class="carousel-control-prev" href="#carouselExampleControls2" role="button" data-slide="prev">--}}
{{--                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
{{--                    <span class="sr-only">Previous</span>--}}
{{--                </a>--}}
{{--                <a class="carousel-control-next" href="#carouselExampleControls2" role="button" data-slide="next">--}}
{{--                    <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
{{--                    <span class="sr-only">Next</span>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--@endsection--}}

{{--@section('content4')--}}

{{--    <div class="row text-center">--}}
{{--        <div class="col-sm-12 col-lg-12 col-md-12 col-xl-12 mt-5 mb-5" style="padding: 0">--}}
{{--            <h1 style=" font-size: 5vh; padding-left: 20px; padding-right: 20px; color: #414141">This is a page with your playlists and videos</h1>--}}
{{--            <h1 style=" font-size: 2vh; padding-left: 20px; padding-right: 20px; color: #414141; font-family: 'Jaldi', sans-serif;">you can add your own playlist / video</h1>--}}
{{--            <h1 style=" font-size: 2vh; padding-left: 20px; padding-right: 20px; color: #414141; font-family: 'Jaldi', sans-serif;">attach a link to any player to the playlist / video recording</h1>--}}
{{--            <h1 style=" font-size: 2vh; padding-left: 20px; padding-right: 20px; color: #414141; font-family: 'Jaldi', sans-serif;">adding links to the services of buying and listening to music</h1>--}}
{{--            <h1 style=" font-size: 2vh; padding-left: 20px; padding-right: 20px; color: #414141; font-family: 'Jaldi', sans-serif;">indicate any additional information</h1>--}}

{{--            <div id="carouselExampleControls3" class="carousel slide mt-4" data-ride="carousel">--}}
{{--                <div class="carousel-inner">--}}
{{--                    <div class="carousel-item active">--}}
{{--                        <img class=" img-fluid" src="{{asset('img/test11.png')}}" alt="First slide" width="250">--}}
{{--                    </div>--}}
{{--                    <div class="carousel-item">--}}
{{--                        <img class=" img-fluid" src="{{asset('img/test12.png')}}" alt="First slide" width="250">--}}
{{--                    </div>--}}
{{--                    <div class="carousel-item">--}}
{{--                        <img class=" img-fluid" src="{{asset('img/test13.png')}}" alt="First slide" width="250">--}}
{{--                    </div>--}}
{{--                    <div class="carousel-item">--}}
{{--                        <img class=" img-fluid" src="{{asset('img/test14.png')}}" alt="First slide" width="250">--}}
{{--                    </div>--}}
{{--                    <div class="carousel-item">--}}
{{--                        <img class=" img-fluid" src="{{asset('img/test15.png')}}" alt="First slide" width="250">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <a class="carousel-control-prev" href="#carouselExampleControls3" role="button" data-slide="prev">--}}
{{--                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
{{--                    <span class="sr-only">Previous</span>--}}
{{--                </a>--}}
{{--                <a class="carousel-control-next" href="#carouselExampleControls3" role="button" data-slide="next">--}}
{{--                    <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
{{--                    <span class="sr-only">Next</span>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--@endsection--}}

{{--@section('content5')--}}

{{--    <div class="row text-center">--}}
{{--        <div class="col-sm-12 col-lg-12 col-md-12 col-xl-12 mt-5 mb-5" style="padding: 0">--}}
{{--            <h1 style=" font-size: 5vh; padding-left: 20px; padding-right: 20px; color: #414141">You can use our service as a regular blog</h1>--}}
{{--            <h1 style=" font-size: 2vh; padding-left: 20px; padding-right: 20px; color: #414141; font-family: 'Jaldi', sans-serif;">ability to add text entries up to 5000 thousand characters</h1>--}}
{{--            <h1 style=" font-size: 2vh; padding-left: 20px; padding-right: 20px; color: #414141; font-family: 'Jaldi', sans-serif;">attach photo / video materials to the recording</h1>--}}
{{--            <h1 style=" font-size: 2vh; padding-left: 20px; padding-right: 20px; color: #414141; font-family: 'Jaldi', sans-serif;">add captions for posts</h1>--}}

{{--            <div id="carouselExampleControls4" class="carousel slide mt-4" data-ride="carousel">--}}
{{--                <div class="carousel-inner">--}}
{{--                    <div class="carousel-item active">--}}
{{--                        <img class=" img-fluid" src="{{asset('img/test16.png')}}" alt="First slide" width="250">--}}
{{--                    </div>--}}
{{--                    <div class="carousel-item">--}}
{{--                        <img class=" img-fluid" src="{{asset('img/test17.png')}}" alt="First slide" width="250">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <a class="carousel-control-prev" href="#carouselExampleControls4" role="button" data-slide="prev">--}}
{{--                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
{{--                    <span class="sr-only">Previous</span>--}}
{{--                </a>--}}
{{--                <a class="carousel-control-next" href="#carouselExampleControls4" role="button" data-slide="next">--}}
{{--                    <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
{{--                    <span class="sr-only">Next</span>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--@endsection--}}
