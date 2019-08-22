<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Post;
use App\User;
use App\Role;
use App\Category;
use App\Like;

use DB;

class PagesController extends Controller
{
    
//useing Post model to retrive all posts to posts view
    public function posts()
		   	{

		    	$posts=Post::all();
		    	$categories=Category::all();
		    	return view('content.posts',compact('posts','categories'));
		    }


		    /* public function categoryshow()
		   	{

		    	$categories=Category::all();
		    	return view('content.posts',compact('categories'));
		    }
*/


//useing Post model to retrive one posts to post view by post id
   public function post(Post $post)
		   {

		    //	$post=Post::find($id);
		    	//$post= DB::table('posts')->find($id);
		    	return view('content.post',compact('post'));
		    }

 public function store(Request $request)
		   {
		   		/*$this->validate(request(),[
		   				'title'=>'required | max:25',
		   				'body'=>'required',
		   				'url'=>'image | mimes:jpg,jpeg,gif,png '
		   			]);*/


		   		//Post::create(request()->all());
		   	   /* Post::create([
		   	    	'title'=>request('title'),
		   	    	'body'=>request('body'),
		   	    	'url'=>request('url'),
		   	    		]);*/

		   	    //rename img_name with real time+url
				$img_name=time() .'.'. $request->url->getClientOriginalExtension();

			

		    	$post = new Post;
		    	$post->title = request('title');
		    	$post->body =request('body');
		    	$post->url =$img_name;
		    	$post->category_id =request('category_id');
		    	$post->save();


		    	

		    	//rename img_name with real time+url
		    	
		 	     $request->url->move(public_path('upload'),$img_name);
		    	

		    	return redirect('posts');
		    }



		    public function category($name)
		    {

		    	$cat =DB::table('categories')->where('name',$name)->value('id');

		    	$posts =DB::table('posts')->where('category_id',$cat)->get();

		    	

		    	return view('content.category',compact('posts'));

		    }







		    public function admin()
		    {

		    	$users=User::all();

		    	//compact function is builtIn function to pass array to view
		    	return view('content.admin',compact('users'));

		    }



		    //add role from admin to all users
		    public function addRole(Request $request)
		    {
		    	$user= User::where('email', $request['email'])->first();
		    	$user->roles()->detach(); // 3aks attach y3ny 3ayz afsl role so roll = null

		    	if($request['role_user'])
		    	{
		    		$user->roles()->attach(Role::where('name', 'User')->first());
		    	}
		    	if($request['role_editor'])
		    	{
		    		$user->roles()->attach(Role::where('name', 'Editor')->first());
		    	}
		    	if($request['role_admin'])
		    	{
		    		$user->roles()->attach(Role::where('name', 'Admin')->first());
		    	}
		    		
		    	return redirect()->back();
		    }


		    public function editor()
		    {


		    	return view('content.editor');

		    }







		 public function accessDenied()
		 {


			return view('content.access-denied');

		 }


		 public function like(Request $request)
		 {
		 		 $like_s = $request->like_s;
				 $post_id = $request->post_id;

				 $like= DB::table('likes')->where('post_id',$post_id)->where('user_id',Auth::user()->id)->first();

				 if (!$like) {

				 	// fe 7alt lw 2asln lw msh 3aml like w dost 3aleh ya3ml new like
				 	$new_like= new like;
				 	$new_like->post_id= $post_id;
				 	$new_like->user_id= Auth::user()->id;
				 	$new_like->like = 1;
				 	$new_like->save();

				 	$is_like=1;

				 } // note 1 is like and 0 is dislike in DB becuase like is boolean datatype
				 elseif ($like->like == 1) {
				 	//fe 7alet lw 3aml like w dost 3aleh ashelo
				 	 
				 	 DB::table('likes')->where('post_id',$post_id)->where('user_id',Auth::user()->id)->delete();

				 	 $is_like=0;
				 }
				 elseif ($like->like == 0) {
				 	//fe 7alet lw ana dost 3la like w ana 2asln 3aml dislike ya3ml update weyb2a like bs
				 	 
				 	 DB::table('likes')->where('post_id',$post_id)->where('user_id',Auth::user()->id)->update(["like"=>1]);

				 	 $is_like=1;
				 	 $count_dislike=1;//pass ajax to remove from dislike_count-1 after update
				 }



				 $response=array(
				 	'is_like'=>$is_like,
				 	"postID"=> $post_id,
				 	"count_dislike"=>$count_dislike,
				 	);
				// to back action in like.js to live action in posts.blade.php
			 return response()->json($response,200);

		 }



		 public function dislike(Request $request)
		 {
		 		 $like_s = $request->like_s;
				 $post_id = $request->post_id;

				 $dislike= DB::table('likes')->where('post_id',$post_id)->where('user_id',Auth::user()->id)->first();

				 if (!$dislike) {

				 	// fe 7alt lw 2asln lw msh 3aml dislike w dost 3aleh ya3ml new dislike
				 	$new_like= new like;
				 	$new_like->post_id= $post_id;
				 	$new_like->user_id= Auth::user()->id;
				 	$new_like->like = 0;
				 	$new_like->save();

				 	$is_dislike=1;

				 } // note 1 is like and 0 is dislike in DB becuase like is boolean datatype
				 elseif ($dislike->like == 0) {
				 	//fe 7alet lw 3aml dislike w dost 3aleh ashelo
				 	 
				 	 DB::table('likes')->where('post_id',$post_id)->where('user_id',Auth::user()->id)->delete();

				 	 $is_dislike=0;
				 }
				 elseif ($dislike->like == 1) {
				 	//fe 7alet lw ana dost 3la dislike w ana 2asln 3aml like ya3ml update weyb2a dislike bs
				 	 
				 	 DB::table('likes')->where('post_id',$post_id)->where('user_id',Auth::user()->id)->update(["like"=>0]);

				 	 $is_dislike=1;
				 	 $count_like=1; //pass ajax to remove from like_count-1 after update
				 }



				 $response=array(
				 	'is_dislike'=>$is_dislike,
				 	"postID"=> $post_id,
				 	"count_like"=>$count_like,
				 	);
				// to back action in like.js to live action in posts.blade.php
			 return response()->json($response,200);

		 }

}
