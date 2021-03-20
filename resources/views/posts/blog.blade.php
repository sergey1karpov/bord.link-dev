@extends('layouts.app')

@section('content')



	<div class="row " style="margin: 0">

		{{-- <div class="col align-self-center">
			<h3 class="text-center align-self-center">Blog</h3>
			<hr>
		</div> --}}

		@if(isset($_GET['search']))
			@if(count($posts)>0)
				<h2>Результаты поиска по запросу <?=$_GET['search'] ?></h2>
				<p class="lead">Найдено{{count($posts)}} постов</p>
			@else
				<h2>По запросу <?=htmlspecialchars($_GET['search'])?> ничего не найдено</h2>
				<a href="{{route('post.index')}}">Показать все посты</a>
			@endif
		@endif
        <div class="mt-4"></div
		@foreach($blogs as $blog)

                <div class="col-sm-12 col-md-12 col-xl-6 col-lg-6 " style="padding: 0">
                    <div class="card card-blog" style="border: none">
                        <div class="card-body" style="padding: 5px">
                            <p><a href="{{route('blog.show', $blog->blog_id)}}" style="text-decoration: none; color: black"><b>BORD!MAG </b>· {{$blog->created_at->diffForHumans()}}</a></p>
                            <p><a href="{{route('blog.show', $blog->blog_id)}}" style="text-decoration: none; color: black; font-size:2em; line-height: 0.9;">{!!$blog->title!!}</a></p>
                            <p><a href="{{route('blog.show', $blog->blog_id)}}" style="text-decoration: none; color: black">{!!$blog->description!!}</a></p>
                        </div>
                        <a href="{{route('blog.show', $blog->blog_id)}}"><img src="{{$blog->img_link ?? $blog->img ?? asset('img/default.jpeg')}}" class="img-fluid "></a><br>
                    </div>
                </div>

		@endforeach

	</div>

    <div class="container">
        <ul class="pagination justify-content-center">
            <h5 style="font-size: 1rem; color: black";>{{$blogs->links()}}</h5>
        </ul>
    </div>

@endsection
