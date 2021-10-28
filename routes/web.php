<?php



use Illuminate\Support\Facades\Route;



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









Route::get('/', 'AuthController@login')->name('login');





/* Admin Route Start */

Route::get('login', 'AuthController@login')->name('login');

Route::post('login', 'AuthController@loginPost')->name('login.post');

Route::post('forgot', 'AuthController@forgotPost')->name('forgot.post');

Route::get('forgot-password/{id}', 'AuthController@forgotPassword')->name('forgot-password');

Route::post('forgot-password/{token}', 'AuthController@forgotPostPassword')->name('forgot-password.post');

//Route::prefix('admin')->middleware('auth','isAdmin')->name('admin.')->group(function() {



    Route::get('dashboard/', 'DashboardController@index')->name('dashboard')->middleware('auth');

    Route::get('/logout', 'AuthController@logout')->name('logout')->middleware('auth');

    Route::get('script-emailbounce/', 'Script\ScriptController@emailbounce')->name('emailbounce');

    Route::prefix('users')->middleware('auth')->name('users.')->group(static function() {

        Route::get('/', 'AdminManagementController@index')->name('index');

        Route::get('/edit/{id}', 'AdminManagementController@getEdit')->name('edit');

        Route::post('/edit/{id}', 'AdminManagementController@postEdit')->name('edit.post');

        Route::get('/change-password/{id}', 'AdminManagementController@changePassword')->name('change-password');

        Route::post('/change-password/{id}', 'AdminManagementController@changePasswordUpdate')->name('change-password.post');

		Route::get('/profile-change/{id}', 'AdminManagementController@changeProfile')->name('profile-change');

		 Route::post('/profile-change/{id}', 'AdminManagementController@changeProfileUpdate')->name('profile-change.post');

         Route::get('/reset-password/{id}', 'AdminManagementController@resetPassword')->name('reset-password');

         Route::post('/reset-password/{id}', 'AdminManagementController@resetPasswordUpdate')->name('reset-password.post');

         Route::get('/configure/{id}', 'AdminManagementController@configureUser')->name('configure');

         Route::post('/configure/{id}', 'AdminManagementController@configureUserUpdate')->name('configure.post');

		



        Route::get('/remove/{id}', 'AdminManagementController@remove')->name('remove');

        Route::get('/add', 'AdminManagementController@add')->name('add');

        Route::post('/add', 'AdminManagementController@addPost')->name('add.post');

        

    });

	Route::prefix('/campaigns')->middleware('auth')->name('campaigns.')->group(static function() {

        Route::get('/', 'Admin\CampaignController@index')->name('index');

		Route::post('/sync-with-lemlist', 'Admin\CampaignController@sync_with_lemlist')->name('sync-with-lemlist');

        Route::get('/get-campaigns', 'Admin\CampaignController@get_campaigns')->name('get-campaigns');

        Route::post('/delete-campaigns', 'Admin\CampaignController@delete_campaigns')->name('delete-campaigns');

    });

	Route::prefix('/leads')->middleware('auth')->name('leads.')->group(static function() {

        Route::get('/upload-leads', 'Admin\LeadController@index')->name('upload-leads');

        Route::post('/upload-csv-file','Admin\LeadController@upload_csv_file')->name('upload-csv-file');

        Route::post('/upload-leads-data','Admin\LeadController@upload_leads')->name('upload-leads-data');

        Route::get('/uploaded-leads', 'Admin\LeadController@uploadedLeads')->name('uploaded-leads');

        Route::get('/get-sheets', 'Admin\LeadController@getSheets')->name('get-sheets');

        Route::get('/list/{id}', 'Admin\LeadController@getLeads')->name('list');

        Route::get('/get-leads/{id}', 'Admin\LeadController@getLeadList')->name('get-leads');

        Route::get('/view/{id}', 'Admin\LeadController@getLeadView')->name('view');

        Route::get('/combined-search', 'Admin\LeadController@CombinedSearch')->name('combined-search');


     });
     Route::prefix('/combined')->middleware('auth')->name('combined.')->group(static function() {

        Route::get('/search', 'Admin\SearchController@index')->name('search');
        Route::get('/search-sheet', 'Admin\SearchController@searchSheet')->name('search-sheet');
        Route::get('/get-lead', 'Admin\SearchController@getLeadList')->name('get-lead');
        Route::get('/download-sheet', 'Admin\SearchController@getDownloadLeadList')->name('download-sheet');
        Route::get('/view/{id}', 'Admin\SearchController@getCombinedLeadView')->name('view');
    });
