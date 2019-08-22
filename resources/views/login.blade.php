@extends('masterPage')

@section('content')

<div class="col-md-8">

    <h3>Login</h3>
    <form method="POST" action="/login">
            

            {{ csrf_field() }}

     
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" name="email" value="{{ old('email')}}" class="form-control form-app" placeholder="Email Address">
                
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" value="{{ old('password')}}" class="form-control form-app" placeholder="Email Address">
                
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn-submit"> Sign In</button>
                
            </div>





    </form>
    
</div>

       @foreach($errors->all() as $error)
                    {{$error}}
        @endforeach
               

@stop