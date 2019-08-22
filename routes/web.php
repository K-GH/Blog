<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
Route::get('/posts', function () {
    return view('content.posts');
});
*/

//retrive all posts and categories
Route::get('/posts','PagesController@posts');






Route::get('/category/{name}','PagesController@category');	



Route::get('/masterPage', function () {
    return view('masterPage');
});

//Auth
Route::get('/register','RegisterationController@create');
Route::post('/register','RegisterationController@store');


Route::get('/login','SessionsController@create');
Route::post('/login','SessionsController@store');
//logout
Route::get('/logout','SessionsController@destroy');


Route::get('/access-denied','PagesController@accessDenied');


//test middleware with route
/*
Route::get('/editor',[

	'uses'=>'PagesController@editor' ,
	'as'=> 'content.admin' ,
	'middleware'=>'roles' ,
	'roles'=>['admin','editor']

	]);



Route::get('/admin',[

	'uses'=>'PagesController@admin' ,
	'as'=> 'content.admin' ,
	'middleware'=>'roles' ,
	'roles'=>['admin']

	]);

//add roles from admin
Route::post('/add-role',[

	'uses'=>'PagesController@addRole' ,
	'as'=> 'content.admin' ,
	'middleware'=>'roles' ,
	'roles'=>['admin']

	]);*/


// route group lw 3ndy kza route lel admin masln leh nafs middleware

Route::group(['middleware'=>'roles','roles'=>['Admin']],function(){

		Route::get('/admin','PagesController@admin');
		Route::get('/add-role','PagesController@addRole');
});

Route::group(['middleware'=>'roles','roles'=>['Editor','Admin']],function(){

		//add new post //route only to controller by7tag mn al view 7agten (method & action ) like (post & /posts/store)
		Route::post('/posts/store','PagesController@store');
		Route::get('/editor','PagesController@editor');
});

Route::group(['middleware'=>'roles','roles'=>['User','Editor','Admin']],function(){
		
		//url in like.js
		Route::post('/like','PagesController@like')->name('like');

		Route::post('/dislike','PagesController@dislike')->name('dislike');

		//lw ana 3awz a3rd kol post fe saf7a lewa7do ba3ml bl id bta3 al post
        Route::get('/posts/{post}','PagesController@post');

		//Add new comment
		Route::post('/posts/{post}/store','CommentsController@store'); 

});