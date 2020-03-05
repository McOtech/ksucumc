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

// use Illuminate\Routing\Route;
// use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('index');
})->name('index');

Auth::routes();

Route::get('/cohort/index', 'CohortController@index')->name('cohorts.index');

Route::get('/cohort/show/{cohort}', 'CohortController@showProfile')->name('cohort');

Route::get('event/{event}', 'EventsController@index')->name('event.show');

Route::get('/event/gallery/{event}/show', 'EventImageController@show')->name('gallery.show');

Route::get('/cohort/gallery/{cohort}/show', 'CohortImageController@show')->name('cohort-gallery.show');

Route::get('/videos/index', 'EventVideoController@index')->name('videos.index');

Route::get('/event/videos/{event}', 'EventVideoController@show')->name('video.show');

Route::get('/event/videos/{event}/{event_video}', 'EventVideoController@view')->name('video.view');

Route::get('cohort/members/{cohort}', 'CohortController@showMembers')->name('members.show');

Route::get('cohort/alumni/{cohort}', 'CohortController@showAlumni')->name('alumni.index');

Route::get('sermons/index', 'SermonController@index')->name('sermon.index');

Route::get('sermons/{sermon}', 'SermonController@show')->name('sermon.show');

Route::get('library/{id}', function ($id) {
    return view('ministries.library');
})->name('library.show');

//Administrator routes
Route::get('/admin', function (){
    return view('admin.dashboard');
})->name('dashboard-admin');

Route::group(['middleware' => ['auth']], function () {
    /* ADMINISTRATOR ROUTES */

    //displays cohorts index page
    Route::get('/cohort/{cohort}/show', 'CohortController@show')->name('cohort.show');

    Route::get('/cohort/{cohort}/info/edit', 'CohortController@showInfo')->name('cohort.edit');

    //Creates new ministry
    Route::post('/cohort', 'CohortController@store')->name('cohort.store');

    //Updates ministry
    Route::patch('/cohort/{cohort}', 'CohortController@update')->name('cohort.update');

    //Deletes ministry
    Route::delete('/cohort/{cohort}/delete', 'CohortController@delete')->name('cohort.delete');

    //show create new ministry page
    Route::get('/ministry/create', 'CohortController@createMinistry')->name('ministry.create');

    //show create new committee page
    Route::get('/committee/create', 'CohortController@createCommittee')->name('committee.create');

    //show create new board page
    Route::get('/board/create', 'CohortController@createBoard')->name('board.create');

    //avails create new leader page
    Route::get('/leaders/create', 'MembershipController@create')->name('leader.create');

    //createS new leader
    Route::post('/leaders', 'MembershipController@store')->name('leader.store');

    //shows leader profile
    Route::get('/member/{user}/show', 'MembershipController@show')->name('leader.show');

    //updates leader profile
    Route::patch('/leaders/{leader}', 'MembershipController@update')->name('leader.update');

    //updates membership profile
    Route::patch('/member/{cohort}/{member}', 'MembershipController@updateMember')->name('member.update');

    //delete leader profile
    Route::delete('/leaders/{leader}/delete', 'MembershipController@delete')->name('leader.delete');

    //delete membership profile
    Route::delete('/member/{cohort}/{member}/delete', 'MembershipController@deleteMember')->name('member.delete');

    /* ------- PERMISSIONS ------- */
    Route::post('/permission', 'PermissionsController@store')->name('permission.store');

    Route::delete('/permission/{permission}', 'PermissionsController@delete')->name('permission.delete');

    //shows past events
    Route::get('/past-events/{cohort}/edit', 'EventsController@show')->name('event.edit');

    //shows scheduled events
    Route::get('/events/{cohort}/create', 'EventsController@create')->name('event.create');

    //stores new events
    Route::post('/events/{cohort}', 'EventsController@store')->name('event.store');

    //updates events
    Route::patch('/events/{cohort}/{event}/edit', 'EventsController@update')->name('event.update');

    //updates events status
    Route::patch('/events/{cohort}/{event}/status/edit', 'EventsController@updateStatus')->name('event-status.update');

    //updates events
    Route::delete('/events/{cohort}/{event}', 'EventsController@delete')->name('event.delete');

    /*------- VIDEOS --------*/


    Route::get('/event-videos/{event}/create', 'EventVideoController@create')->name('event-video.create');

    Route::post('/event-video', 'EventVideoController@store')->name('event-video.store');

    Route::patch('/event-video/{event_video}/edit', 'EventVideoController@update')->name('event-video.update');

    Route::delete('/event-video/{event_video}', 'EventVideoController@delete')->name('event-video.delete');

    /*------- EVENT IMAGES ------- */

    Route::get('/event-images/{event}/create', 'EventImageController@create')->name('event-image.create');

    Route::post('/event-images/{event}', 'EventImageController@store')->name('event-image.store');

    Route::patch('/event-images/{eventImage}/edit', 'EventImageController@update')->name('event-image.update');

    Route::delete('/event-images/{eventImage}', 'EventImageController@delete')->name('event-image.delete');

    /*------- COHORT IMAGES ------- */

    Route::get('/cohort-images/{cohort}/create', 'CohortImageController@create')->name('cohort-image.create');

    Route::post('/cohort-images/{cohort}', 'CohortImageController@store')->name('cohort-image.store');

    Route::patch('/cohort-images/{cohortImage}/edit', 'CohortImageController@update')->name('cohort-image.update');

    Route::delete('/cohort-images/{cohortImage}', 'CohortImageController@delete')->name('cohort-image.delete');

    /*------- SERMONS ------- */

    Route::get('/sermon', 'SermonController@create')->name('sermon.create');

    Route::post('/sermon', 'SermonController@store')->name('sermon.store');

    Route::patch('/sermon/{sermon}/edit', 'SermonController@update')->name('sermon.update');

    Route::delete('/sermon/{sermon}', 'SermonController@delete')->name('sermon.delete');

    /*------- ALERTS ------- */

    Route::get('/alert', 'AlertController@create')->name('alert.create');

    Route::get('/alert/index', 'AlertController@index')->name('alert.index');

    Route::post('/alert', 'AlertController@store')->name('alert.store');

    Route::patch('/alert/{alert}/edit', 'AlertController@update')->name('alert.update');

    Route::delete('/alert/{alert}', 'AlertController@delete')->name('alert.delete');


    /*user settings */

    //user details
    Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');
    Route::post('/profile/details', 'ProfileController@storeDetails')->name('details.store');
    Route::patch('/profile/details/{profile}', 'ProfileController@updateDetails')->name('details.update');

    //user contacts
    Route::post('/profile/contacts', 'ProfileController@storeContacts')->name('contacts.store');
    Route::patch('/profile/contacts/{user}', 'ProfileController@updateContacts')->name('contacts.update');

    //user image
    Route::post('/profile/image', 'ProfileController@storeImage')->name('image.store');
    Route::patch('/profile/image/{user}', 'ProfileController@updateImage')->name('image.update');

    /* -------PHOTOS HANDLER------- */

    Route::get('/photo/create', 'PhotoController@create')->name('photo.create');
    Route::post('/photo', 'PhotoController@store')->name('photo.store');
    Route::get('/photo', 'PhotoController@index')->name('photo.index');
    Route::patch('/photo/{photo}/edit', 'PhotoController@update')->name('photo.update');
    Route::delete('/photo/{photo}', 'PhotoController@delete')->name('photo.delete');
    Route::get('/photos/{user}', 'PhotoController@show')->name('photos.show');


    /* -------MEMBERSHIP------- */


    Route::get('/members-dashboard/{cohort}/show', 'CohortController@membersDashboard')->name('member-dashboard.show');

    Route::get('/active-members/{cohort}/show', 'CohortController@activeMembers')->name('active-members.show');

    Route::get('/requests/{cohort}/show', 'CohortController@requests')->name('requests.show');

    Route::get('/alumni/{cohort}/show', 'CohortController@alumni')->name('alumni.show');

    Route::get('/home', 'HomeController@index')->name('home');

});




// Route::get('/admin/{category}/{id}/profile', function ($category, $id){
//     return view('admin.group-profile');
// })->name('group-profile.edit');

// //user

// Route::get('/user-dashboard', function(){
//  return view('admin.userDashboard');
// })->name('user-dashboard.show');


// Route::get('/user/profile', function (){
//     return view('admin.user-profile');
// })->name('user-profile.show');
