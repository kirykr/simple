<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Computer;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
	$computers = Computer::orderBy('id', 'desc')->paginate(10);
		// return $computers->all();
	return view('welcome', compact('computers'));
    // return view('welcome');
});
// Route::get('/product/{id}', function ($id) {
// 	$computer = Computer::findOrFail($id);
// 		// return $computer->all();
// 	return view('product', compact('computer'));
//     // return view('welcome');
// });


Route::auth();

/*Route::get('/admin', function(){

	if(!Entrust::hasRole(['admin','owner','HR'])){
		return redirect('/');
	}

	return view('admin.index');
});*/

		Route::get('/admin', function(){
			if (Auth::check()){
				if(Auth::user()->is_active ==1){
					foreach(Auth::user()->roles as $rname){
						//if($rname->name){
						if(Entrust::hasRole([$rname->name])){
							$array = [];
							$arr = [];
							 foreach(Auth::user()->roles as $rname ){
									 foreach($rname->modules as $mo){
										 $test= $mo->nav;
										 $array[]=array_add(['name' => 'ko'], 'module',$test);
									 }
							 }
							 //$result = array_unique($array);
							 //echo $rol;

							 $collection = collect($array);
							 $collection1 = $collection->unique('module');
							 foreach ($collection1 as $item) {
									 //echo $item['module'];
								}
							return view('admin.index', compact('collection1'));

						}
					}

				}
			}
			return redirect('/');
		});

// Route::get('/admin', 'AdminPageController@index');
// created Admin middleware and put all admin work inside
//Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {
Route::group(['middleware'=>'admin'], function(){
	//Route::resource('/admin/users', 'AdminUserController');

	//Route::get('/admin', 'AdminPageController@index');


	Route::get('image/{filename}','UserController@getImagePro')->name('admin.users.image');
	Route::get('imagedef','UserController@getImageDef')->name('admin.users.imagedef');

	Route::resource('/admin/users', 'UserController');
	Route::resource('/admin/posts','PostController');
	Route::resource('/admin/categories', 'CategoryController');
	Route::resource('/admin/computers','ComputerController');
	Route::resource('/admin/others','OtherController');
	Route::resource('/admin/specs','SpecController');
	Route::resource('/admin/types','TypeController');
	Route::resource('/admin/brands','BrandController');
	Route::resource('/admin/modells','ModellController');
	Route::resource('/admin/permissions','PermissionController');

	Route::resource('/admin/rol','ModulesController');
	Route::resource('/admin/modules','ModulesRoleController');

	Route::resource("/admin/suppliers","SupplierController");
	Route::resource('/admin/roles','RoleController');
	Route::resource("/admin/cimports","CimportController");
	Route::resource("/admin/colors","ColorController");
	Route::resource("/admin/oimports","OimportController");
	Route::resource("/admin/tempcomputersotck","TempcomputersotckController", ['only' => ['edit','store','update','destroy']]);
	Route::resource("/admin/tempother","TempotherController", ['only' => ['edit','store','update','destroy']]);

	Route::group(array('prefix' => 'admin'), function(){
		Route::group(array('prefix' => 'api'), function(){
			Route::group(array('prefix' => 'v1'), function(){

				Route::resource('brands.types', 'api\v1\TypesController', ['only' => ['index']]);

				Route::resource('types.categories', 'api\v1\CategoriesController', ['only' => ['index']]);

				Route::resource('categories.modells', 'api\v1\ModellsController', ['only' => ['index']]);

				Route::resource('computers', 'api\v1\ComputerController',['only' => ['show', 'update']]);
				Route::resource('others', 'api\v1\OtherController',['only' => ['show', 'update']]);
				});
		});
	});
});

Route::resource('products', 'ProductsController');
Route::resource('/home', 'HomeController@index');
Route::resource('/carts', 'CartController');
