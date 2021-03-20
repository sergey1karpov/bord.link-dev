@extends('layouts.app')

@section('content')

    <div type="hidden">@section('title'){{$blog->title}}@endsection</div>

<div class="row" style="margin: 0">
	<div class="col-12" style="padding: 0; margin-top: 10px">
		<div class="card" style="border: none">

			<div class="card-body" style="padding-left: 0; padding-right: 0">
				<div class="card-img__max text-center" >
					<img src="{{$blog->img_link ?? $blog->img ?? asset('img/default.jpeg')}}" class="img-fluid">
				</div>

				<div class="card-text mt-4" style="padding-left: 5px; padding-right: 5px">
                    <p><a href="{{route('blog.show', $blog->blog_id)}}" style="text-decoration: none; color: black; font-size:2em; line-height: 0.9;">{!!$blog->title!!}<br></a></p>
                    <p><a href="{{route('blog.show', $blog->blog_id)}}" style="text-decoration: none; color: black; ">{!!$blog->description!!}<br></a></p>
                </div>
				<div class="mt-3 mb-2">
                    <!-- uSocial -->
                    <script async src="https://usocial.pro/usocial/usocial.js?v=6.1.4" data-script="usocial" charset="utf-8"></script>
                    <div class="uSocial-Share" data-pid="339cedd65c9762615e04e5dc6a897d6c" data-type="share" data-options="round-rect,style1,default,absolute,horizontal,size48,eachCounter1,counter0,nomobile" data-social="vk,twi,fb,telegram"></div>
                    <!-- /uSocial -->
				</div>
				{{-- <div class="card-author">Автор:{{$post->name}}</div> --}}
				<div class="card-author mt-3 mb-3" style="padding-left: 5px">Опубликованно {{$blog->created_at->diffForHumans()}}</div>

				<a href="{{ route('blog.index') }}" class="btn btn-outline-primary btn-sm ml-1">Всё записи</a>
				<a href="/" class="btn btn-outline-primary btn-sm">На главную</a>
				@auth
				@if(Auth::user()->id == $blog->author_id)
				<a href="{{ route('blog.edit', ['id' => $blog->blog_id]) }}" class="btn btn-outline-primary btn-sm">Редактировать</a>
				<form action="{{route('blog.destroy', ['id' => $blog->blog_id])}}" method="post">
					@csrf
					@method('DELETE')
					<input type="submit" name="del" class="btn btn-outline-primary mt-1 btn-sm" value="Удалить">
				</form>
				@endif
				@endauth
			</div>
		</div>
	</div>
</div>

@endsection
