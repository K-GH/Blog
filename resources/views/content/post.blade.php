@extends('masterPage')

@section('content')

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                
                         <h2>
                    <a href="/posts/{{$post->id}}">{{$post->title}}</a>
                </h2>
                <p class="lead">
                    by <a href="index.php">Start Bootstrap</a>
                </p>
                <!-- carbon libaray used toDayDateTimeString() -->
                <p><span class="glyphicon glyphicon-time"></span> 
                        Posted On {{ $post->created_at->toDayDateTimeString() }} - <strong>Category</strong>{{$post->category->name}}

                </p>
                <hr>
                @if($post->url)
                        <img class="img-responsive" src="../upload/{{$post->url}}" alt="">
                @endif
                <hr>
                <p>{{$post->body}}</p>

                <div class="comments">
                    @foreach($post->comments as $comment)
                        
                    <p class="comment"  >{{$comment->body}}</p>
                        <br>
                    @endforeach

                </div>


                 <form method="POST" action="/posts/{{ $post->id }}/store">
                 {{ csrf_field() }} <!-- Security and safety for form  -->
                   

                    <div class="form-group" >
                        <label for="body">Write something ....</label>
                        <textarea name="body" id="body" class="form-control"></textarea>
                    </div>

                    


                    <div class="form-group" >
                        <button type="submit" class="btn btn-primary">Add  Comment</button>
                    </div>
               </form>
        

                <hr>
               

               

                <hr>
				
               

@stop