<?php 
namespace App\Http\Controllers\api\v1;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Brand;
use App\Type;
use Illuminate\Http\Request;
use App\Computer;
use App\Color;
class SerialnumbersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$computer = Computer::findOrFail($id);
		$colors = $computer->colors;
		return response()->json($colors);

		// return view('admin.categories.index', compact('categories'));
	}

}