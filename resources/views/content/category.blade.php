@extends('masterPage')

@section('content')

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                @foreach($posts as $post)
                <h2>
                    <a href="/posts/{{$post->id}}">{{$post->title}}</a>
                </h2>
                <p class="lead">
                    by <a href="index.php">Start Bootstrap</a>
                </p>
                <!-- carbon libaray used toDayDateTimeString() -->
                <p><span class="glyphicon glyphicon-time"></span> 
                		Posted On {{ $post->created_at }}</p>
                <hr>
                @if($post->url)
                		<img class="img-responsive" src="../upload/{{$post->url}}" alt="">
                @endif
                <hr>
                <p>{{$post->body}}</p>
                <a class="btn btn-primary" href="/posts/{{$post->id}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

               
 
                <hr>
				@endforeach



               <form method="POST" action="/posts/store" enctype="multipart/form-data">
                 {{ csrf_field() }} <!-- Security and safety for form  -->
	               	<div class="form-group">
	               		<label for="title">Title</label>
	               		<input type="text" name="title" id="title" class="form-control">
	               	</div>

	               	<div class="form-group" >
	               		<label for="body">Body</label>
	               		<textarea name="body" id="body" class="form-control"></textarea>
	               	</div>

	               	<div class="form-group">
	               		<label for="url">Image</label>
	               		<input type="file" name="url" id="url"  class="form-control">
	               	</div>


	               	<div class="form-group" >
	               		<button type="submit" class="btn btn-primary">Add New Post</button>
	               	</div>
               </form>

               <!-- show all error -->
               @foreach($errors->all() as $error)
               		{{$error}}
               @endforeach

             <!-- Pager -->
 <!-- 
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>
-->

@stop