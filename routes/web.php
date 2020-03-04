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


//Route::get('users.index', function () {
//    return view('users.index');
//});

Route::get("users/{id}/followings/back", function($userId){
    return redirect(session("backUrl"));
})->name("followings.back");

Route::get("users/{id}/followers/back", function($userId){
    return redirect(session("backUrl"));
})->name("followers.back");

Route::get("detail/{id}/back", function($postId){
    return redirect(session("backUrl"));
})->name("detail.back");

//  アカウント作成
Route::get("signup", "Auth\RegisterController@showRegistrationForm")->name("signup.get");
Route::post("signup", "Auth\RegisterController@register")->name("signup.post");

//　ログイン認証
Route::get("login", "Auth\LoginController@showLoginForm")->name("login");
Route::post("login", "Auth\LoginController@login")->name("login.post");
Route::get("logout", "Auth\LoginController@logout")->name("logout.get");

Route::group(['middleware' => 'auth'], function () {
    Route::get("users/list", "UsersController@list")->name("users.list");
     
    Route::get("users/timeline", "UsersController@timeline")->name("users.timeline");
    
    Route::resource('users', 'UsersController', ['only' => ['index', "show"]]);
    
    Route::resource('posts', 'PostsController', ['only' => ['store', "destroy", "show"]]);
    
    Route::resource("comments", "CommentsController");
   
    Route::get("ranking/user", "UsersController@userrank")->name("ranking.user");
    Route::get("ranking/post", "PostsController@postrank")->name("ranking.post");

    Route::group(["prefix" => "users/{id}"], function () {
       Route::post("follow", "UserFollowController@store")->name("user.follow"); 
       Route::delete("unfollow", "UserFollowController@destroy")->name("user.unfollow");
       Route::get("followings", "UsersController@followings")->name("users.followings");
       Route::get("followers", "UsersController@followers")->name("users.followers");
       Route::get("favorites", "UsersController@favorites")->name("users.favorites");
    });
    
    Route::group(["prefix" => "posts/{id}"], function () {
       Route::post("favorite", "FavoritesController@store")->name("favorites.favorite");
       Route::delete("unfavorite", "FavoritesController@destroy")->name("favorites.unfavorite");
    });
    
    // Route::get("/posts", "PostsController@index");
    Route::match(["GET", "POST"], "/create", "PostsController@create");
});



