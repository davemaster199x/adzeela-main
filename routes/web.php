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

if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
}

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();

Route::get('/logout', 'HomeController@logout');
Route::middleware(['auth.check'])->group(function () {
    /* Ajax */
    Route::get('/getStates', 'WorkfileController@getstates');
    Route::get('getCompanyList', 'CompanyController@getCompanyList');

    /* 2FA */
    Route::get('/2fa/{guid}', 'NormalController@factauth');
    Route::post('checkotp', 'NormalController@checkotp');
    Route::post('checkusername', 'UserController@checkusername');
    Route::post('checkemail', 'UserController@checkemail');

    /* Dashboard */
    Route::get('/dashboard', 'NormalController@dashboard');

    /* Freelancers */
    Route::get('/freelancers', 'FreelancerController@freelancers')->name('freelance.users');
    Route::post('/freelance/store', 'FreelancerController@freelance_store')->name('freelance.store');
    Route::get('/freelance/edit/{guid}', 'FreelancerController@freelance_edit')->name('freelancer.edit');
    Route::post('/freelance/update/{guid}', 'FreelancerController@freelance_update')->name('freelancer.update');
    Route::delete('freelance/delete/{id}', 'FreelancerController@freelance_delete');

    /* Workfiles */
    Route::get('/workfiles', 'WorkfileController@workfiles')->name('workfiles.list');
    Route::get('workfile/create', 'WorkfileController@workfile_create')->name('workfile.create');
    Route::post('workfile/store', 'WorkfileController@workfile_store')->name('workfile.store');
    Route::get('workfile/view/{id}', 'WorkfileController@view')->name('workfile.view');
    Route::get('workfile/viewinfo/{id}', 'WorkfileController@viewinfo')->name('workfile.viewinfo');
    Route::get('/export-workfiles/{id}', 'WorkfileController@export')->name('workfile.export');


    /* Companies */
    Route::get('/companies', 'CompanyController@index')->name('companies.list');
    Route::post('/company/store', 'CompanyController@store')->name('company.store');
    Route::get('/company/edit/{guid}', 'CompanyController@edit')->name('company.edit');
    Route::post('company/update/{guid}', 'CompanyController@update')->name('company.update');
    Route::delete('company/delete/{id}', 'CompanyController@delete');

    /* Callers */
    Route::get('callers', 'CallerController@index')->name('callers');
    Route::post('/caller/store', 'CallerController@store')->name('caller.store');
    Route::get('/caller/edit/{guid}', 'CallerController@edit')->name('caller.edit');
    Route::post('/caller/update/{guid}', 'CallerController@update')->name('caller.update');
    Route::delete('caller/delete/{id}', 'CallerController@delete');

    /* Leads */
    Route::get('leads', 'LeadTableController@index')->name('leads');
    Route::get('lead/add', 'LeadTableController@add')->name('lead.add');
    Route::post('lead/store', 'LeadTableController@store')->name('lead.store');
    Route::get('lead/view/{guid}', 'LeadTableController@view')->name('lead.view');
    Route::post('/lead/update/{guid}', 'LeadTableController@update')->name('lead.update');
    Route::delete('leadposition/delete/{id}', 'LeadTableController@leadposition_delete');
    Route::post('updateposition', 'LeadTableController@updateposition');
    Route::delete('lead/delete/{id}', 'LeadTableController@delete');

    /* Manage Caller */
    Route::get('manage-caller', 'ManageCallerController@index')->name('managecallers');
    Route::post('assign-caller', 'ManageCallerController@assign')->name('manage.assign.caller');
    Route::get('manage-caller/view/{guid}', 'ManageCallerController@view')->name('manage.view.info');
    Route::post('manage-caller/update/{guid}', 'ManageCallerController@update')->name('manage.update.caller');
    Route::post('updateschedule', 'ManageCallerController@update_schedule');
    Route::post('addschedule', 'ManageCallerController@addschedule');

    /* TV SCREEN */
    Route::get('/tvscreen', 'TvScreenController@all')->name('tvscreen.all');
    Route::post('/addTvscreen', 'TvScreenController@addTvscreen')->name('tvscreen.addTvscreen');
    Route::get('GetSubPlaylist/{id}', 'TvScreenController@GetSubPlaylist')->name('tvscreen.GetSubPlaylist');
    Route::get('GetTvScreenID/{id}', 'TvScreenController@GetTvScreenID')->name('tvscreen.GetTvScreenID');
    Route::get('GetVideoList/{id}', 'TvScreenController@GetVideoList')->name('tvscreen.GetVideoList');
    Route::get('/play/{id}', 'TvScreenController@play')->name('tvscreen.play');
    
    /* MEDIA */
    Route::get('/media', 'MediaController@all')->name('media.all');
    Route::get('/media/images', 'MediaController@images')->name('media.images');
    Route::get('/media/videos', 'MediaController@videos')->name('media.videos');
    Route::post('/media/upload', 'MediaController@upload')->name('media.upload');
    Route::post('/media/{media}', 'MediaController@update')->name('media.update');
    Route::delete('/media/{media}', 'MediaController@destroy')->name('media.destroy');

    Route::get('/media/folder/{folder}', 'FolderController@index')->name('folder.index');
    Route::get('/media/folder', 'FolderController@store')->name('folder.store');
    Route::post('/media/folder/{folder}', 'FolderController@update')->name('folder.update');
    Route::delete('/media/folder/{folder}', 'FolderController@destroy')->name('folder.destroy');


    /* Admin */
    Route::group(['middleware' => '\App\Http\Middleware\AdminMiddleware', 'prefix' => 'admin'], function () {
        /* Dashboard */
        Route::get('/dashboard', 'HomeController@admin_dashboard');

        /* Users */
        Route::get('/users', 'UserController@users')->name('admin.users');
        Route::post('/user/store', 'UserController@user_store')->name('admin.user.store');
        Route::get('/user/edit/{guid}', 'UserController@user_edit')->name('admin.user.edit');
        Route::post('/user/update/{guid}', 'UserController@user_update')->name('admin.user.update');
        Route::delete('user/delete/{guid}', 'UserController@user_delete');

        /* Roles */
        Route::get('/roles', 'RoleController@index')->name('admin.roles');
        Route::get('/role/add', 'RoleController@add')->name('admin.role.add');
        Route::post('/role/store', 'RoleController@store')->name('admin.role.store');
        Route::get('/role/edit/{id}', 'RoleController@edit')->name('admin.role.edit');
        Route::post('/role/update/{id}', 'RoleController@update')->name('admin.role.update');
        Route::delete('role/delete/{id}', 'RoleController@role_delete');

        /* Validators */
        Route::get('/validators/titles', 'ValidatorController@titles')->name('admin.validators.titles');
        Route::post('/validator/title/store', 'ValidatorController@title_store')->name('admin.validator.title.store');
        Route::post('/validator/title/update/{id}', 'ValidatorController@title_update')->name('admin.validator.title.update');
        Route::delete('validator/title/delete/{id}', 'ValidatorController@title_delete');

        Route::get('/validators/industries', 'ValidatorController@industries')->name('admin.validators.industries');
        Route::post('/validator/industry/store', 'ValidatorController@industry_store')->name('admin.validator.industry.store');
        Route::post('/validator/industry/update/{id}', 'ValidatorController@industry_update')->name('admin.validator.industry.update');
        Route::delete('validator/industry/delete/{id}', 'ValidatorController@industry_delete');

        Route::get('/validators/countries-states', 'ValidatorController@countries_states')->name('admin.validators.countries_states');
        Route::post('/validator/country/store', 'ValidatorController@country_store')->name('admin.validator.country.store');
        Route::post('/validator/country/update/{id}', 'ValidatorController@country_update')->name('admin.validator.country.update');
        Route::get('/validator/country/view/{id}', 'ValidatorController@country_view')->name('admin.validator.country.view');
        Route::post('/validator/state/store', 'ValidatorController@state_store')->name('admin.validator.state.store');
        Route::post('/validator/state/update/{id}', 'ValidatorController@state_update')->name('admin.validator.state.update');
        Route::delete('validator/state/delete/{id}', 'ValidatorController@state_delete');
        Route::delete('validator/country/delete/{id}', 'ValidatorController@country_delete');

        Route::get('/validators/categories', 'ValidatorController@categories')->name('admin.validators.categories');
        Route::post('/validator/category/store', 'ValidatorController@category_store')->name('admin.validator.category.store');
        Route::post('/validator/category/update/{id}', 'ValidatorController@category_update')->name('admin.validator.category.update');
        Route::delete('validator/category/delete/{id}', 'ValidatorController@category_delete');

        Route::get('/validators/tags', 'ValidatorController@tags')->name('admin.validators.tags');
        Route::post('/validator/tag/store', 'ValidatorController@tag_store')->name('admin.validator.tag.store');
        Route::post('/validator/tag/update/{id}', 'ValidatorController@tag_update')->name('admin.validator.tag.update');
        Route::delete('validator/tag/delete/{id}', 'ValidatorController@tag_delete');
    });
});
