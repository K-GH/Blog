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
                		Posted On {{ $post->created_at->toDayDateTimeString() }}- <strong> Category/  </strong>
                            <a href="../category/{{  $post->category->name}}">
                                                        {{  $post->category->name}}
                            </a>

                        {{  $post->category->name}}
                </p>
                <hr>
                @if($post->url)
                		<img class="img-responsive" src="upload/{{$post->url}}" alt="">
                @endif
                <hr>
                <p>{{$post->body}}</p>
                <a class="btn btn-primary" href="/posts/{{$post->id}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    @php
                        $like_count=0;
                        $dislike_count=0;
                        $like_status="btn-secondry";
                        $dislike_status="btn-secondry";

                    @endphp
                    @foreach($post->likes as $like)

                    @php
                        if($like->like == 1)
                        {
                            $like_count++;
                        }

                        if($like->like == 0)
                        {
                            $dislike_count++;
                        }
                        if(Auth::check())
                        {

                            if($like->like == 1 && $like->user_id == Auth::user()->id )
                            {
                                $like_status="btn-success";
                            }
                            if($like->like == 0 && $like->user_id == Auth::user()->id )
                            {
                                $dislike_status="btn-danger";
                            }
                        }

                    @endphp
                  @endforeach



                <button type="button" data-like="{{ $like_status }}" data-postid="{{ $post->id }}_l" 
                class=" like btn {{ $like_status }}">Like <span class="glyphicon glyphicon-thumbs-up"></span>
                <p><span class="like_count">{{$like_count}}</span></p></button> 

                <button type="button"  data-like="{{ $dislike_status }}" data-postid="{{ $post->id }}_d" 
                class="dislike btn {{ $dislike_status }}">Dislike <span class="glyphicon glyphicon-thumbs-down"></span> <p><span class="dislike_count">{{$dislike_count}}</span></p></button> 
              
                <hr>

               
                <i class="far fa-thumbs-down"></i>
                <hr>
				@endforeach


                <!-- Admin only Add Posts -->
                @if(Auth::check())

                    @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Editor'))

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

                        <div class="form-group">
                            <select  name="category_id">
                                @foreach($categories as $cat)
                                  <option value="{{$cat->id}}"  >{{$cat->name}}</option>
                                 @endforeach
                            </select>
                        </div>


    	               	<div class="form-group" >
    	               		<button type="submit" class="btn btn-primary">Add New Post</button>
    	               	</div>
                   </form>

                   @endif
               @endif

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