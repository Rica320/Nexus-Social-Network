<?php

// ======================= AUTHENTICATION =======================

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// ======================= HOME PAGE =======================

Route::get('/', 'Auth\LoginController@home');


// ======================= ADMIN PAGES =======================

Route::get('admin', 'AdminController@show')->name('admin');
Route::get('admin/statistics', 'AdminController@showStatistics');

Route::get('admin/report/{username}', 'ReportController@show');

// ======================= STATIC PAGES =======================



Route::get('features', function () {
    return view('pages.features');
})->name('features');

Route::get('about', function () {
    return view('pages.about');
})->name('about');

Route::get('contacts', function () {
    return view('pages.contacts');
})->name('contacts');

Route::get('home', function () {
    return view('pages.home');
})->name('home');

Route::get('404', function () {
    return view('pages.404');
})->name('not_found');

// ======================= DYNAMIC PAGES =======================

Route::get('post/{id}', 'PostController@show')->name('post');
Route::get('profile/{username}', 'ProfileController@show')->name('profile');
Route::get('group/{name}', 'GroupController@show')->name('group');
Route::get('search/{query}', 'SearchController@show')->name('search');
Route::get('messages/{sender_username}', 'MessagesController@show')->name('messages');
Route::get('user/friends/requests', 'FriendsRequestController@show');

// ======================================= APIS ========================================


// ======================= FEED POSTS =======================

Route::get('api/post/feed/{type_feed}', 'PostController@feed');

// ======================= SEARCH ITEMS =======================

Route::get('api/search/{query_string}/type/{type_search}', 'SearchController@search');

// ======================= GROUP CRUD =======================

Route::post('api/group', 'GroupController@create');
Route::post('api/group/{name}', 'GroupController@edit')->name('editGroup');
Route::delete('api/group/{name}', 'GroupController@delete');

// ======================= PROFILE CRUD =======================

Route::post('api/profile/{id}', 'ProfileController@edit')->name('editProfile');
Route::delete('api/profile/{username}', 'ProfileController@delete');

// ======================= OWNER CRUD =======================

Route::post('api/group/{id_group}/owner/{id_user}', 'GroupController@addGroupOwner'); // talvez n seja post
Route::delete('api/group/{id_group}/owner/{id_user}', 'GroupController@removeGroupOwner');


// ======================= MEMBER CRUD =======================

Route::get('api/group/{id_group}/member/{id_user}', 'GroupController@getGroupMembers');
Route::post('api/group/member', 'GroupController@addGroupMember');
Route::delete('api/group/{id_group}/member/{id_user}', 'GroupController@removeGroupMember');


// ======================= POST CRUD =======================

Route::post('api/post', 'PostController@create');
Route::post('api/post/{id}', 'PostController@edit')->name('editPost');
Route::delete('api/post/{id}', 'PostController@delete');


// ======================= ADMIN REPORTS =======================

Route::get('api/admin/pendent_reports/{query_string}', 'AdminController@usersReportesPending');
Route::get('api/admin/past_reports/{query_string}', 'AdminController@usersReportesPast');


// ======================= LIKE POST/COMMENT =======================

Route::post('api/like_post', 'LikeController@toggle');
Route::post('api/like_comment', 'CommentLikeController@toggle');


// ======================= Messages ===========================

Route::post('api/message/{id}', 'MessagesController@create');

// ======================= COMMENTING CRUD  =======================

Route::post('api/comment/{id_post}', 'CommentController@create');
Route::put('api/comment', 'CommentController@edit');
Route::delete('api/comment/{id_comment}', 'CommentController@delete');

// ======================= NOTIFICATIONS ==========================

Route::get('api/user/notifications', 'NotificationController@get');
Route::put('api/user/notification/{id}/seen', 'NotificationController@markAsSeen');

// ======================= FRIENDS REQUEST ========================

Route::put('api/user/friend/request/{id_sender}/accept', 'FriendsRequestController@accept');
Route::put('api/user/friend/request/{id_sender}/reject', 'FriendsRequestController@reject');
Route::post('api/user/friend/request/{id_rcv}/send', 'FriendsRequestController@send');
Route::delete('api/user/friend/{id}', 'FriendsRequestController@delete');


// ======================= Reports ==========================
Route::put('api/report/reject_all/{userID}', 'ReportController@rejectAll');
Route::post('api/report', 'ReportController@create');
Route::put('api/report', 'ReportController@edit');
Route::delete('api/report/{id}', 'ReportController@delete');

Route::put('api/user/ban/{userID}/{time_option}', 'ReportController@banUser');
