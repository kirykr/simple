<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ComputerRequest;
use App\Photo;
use App\Computer;
use App\Type;
use Illuminate\Http\Request;

class ComputerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$computers = Computer::orderBy('id', 'desc')->paginate(10);
		// return $computers->all();
		return view('admin.computers.index', compact('computers'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		$types = Type::lists('name','id')->all();

		return view('admin.computers.create', compact('types'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(ComputerRequest $request)
	{
		
		$input = $request->all();

		 if($file = $request->file('photo_id'))
        {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['path'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        Computer::create($input);

        
        // Session::flash('create_user','The user has been created!');
        flash()->overlay('User has been created successfully','CREATE USER');

        return redirect('/admin/computers');

		// return redirect()->route('computers.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$computer = Computer::findOrFail($id);

		return view('admin.computers.show', compact('computer'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$computer = Computer::findOrFail($id);
		$types = Type::lists('name','id')->all();

		return view('admin.computers.edit', compact('computer', 'types'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$computer = Computer::findOrFail($id);
		$input = $request->all();

        // $computer->photo_id = $request->input("photo_id");
        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['path'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        // $input['cat_id'] = $request->input(0);
        // $input['brand_id'] = $request->input(0);
        // $input['model_id'] = $request->input(0);

		$computer->update($input);

		return redirect()->route('admin.computers.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$computer = Computer::findOrFail($id);
		$computer->delete();

		return redirect()->route('computers.index')->with('message', 'Item deleted successfully.');
	}

	
}
