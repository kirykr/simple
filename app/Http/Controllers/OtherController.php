<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Other;
use App\Brand;
use Image;
use App\Photo;
use App\Type;

use Illuminate\Http\Request;

class OtherController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$others = Other::orderBy('updated_at', 'desc')->paginate(10);

		return view('admin.others.index', compact('others'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$brands = Brand::lists('name','id')->all();
		$types = Type::lists('name','id')->all();

		return view('admin.others.create', compact('brands','types'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			        'name' => 'required|max:30',
			        'sellprice' => 'required|numeric|min:1',
			        'ppprice' => 'required|numeric|min:1',
			        'provprice' => 'required|numeric|min:1',
			        'brand_id' => 'required',
			        'type_id' => 'required'
			    ]);
		$input = $request->all();
		
		// dd($input);
		switch ($request->input("type_id")) {
			case '3':
				$input['id'] = uniqid('a', false);
				break;
			case '4':
				$input['id'] = uniqid('s', false);
				break;
			case '5':
				$input['id'] = uniqid('p', false);
				break;
		}
		$other = Other::create($input);
		// dd($request->all());
		 if($files = $request->file('photo_id'))
        {
          foreach($files as $file) {
            $photo = new Photo;
            $extension = $file->getClientOriginalExtension();
             //Creating sha1 version of the filename in case of conflicts
            $sha1 = sha1($file->getClientOriginalName());
            $filename = date('Y-m-d-h-i-s').".".$sha1.".".$extension;
            $path = public_path('images/computers/' . $filename);
            // Using Intervention/image package here to resize the photos
            $img = Image::make($file->getRealPath())->resize(600, 319, 
            		function ($c) {
					    $c->aspectRatio();
					    $c->upsize();
					}
            	)->resizeCanvas(600, 319, 'center', false, array(255, 255, 255, 0))->save($path);
            $img->destroy();	

            $photo->path = $filename;
            $photo->save();
            $other->photos()->attach($photo->id);
            }
        }

		return redirect()->route('admin.others.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$other = Other::findOrFail($id);

		return view('admin.others.show', compact('other'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$other = Other::findOrFail($id);
		$types = Type::lists('name','id')->all();
		$brands = Brand::lists('name','id')->all();

		return view('admin.others.edit', compact('other', 'types','brands'));
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
		$other = Other::findOrFail($id);

		$input = $request->except(['photo_id']);
				// dd($input);
		        // $other->photo_id = $request->input("photo_id");
		        // if($file = $request->file('photo_id')){
		        //     $name = time() . $file->getClientOriginalName();
		        //     $file->move('images',$name);
		        //     $photo = Photo::create(['path'=>$name]);
		        //     $input['photo_id'] = $photo->id;
		        // }
		        
		$other->update($input);

		return redirect()->route('admin.others.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$other = Other::findOrFail($id);
		$other->delete();

		return redirect()->route('admin.others.index')->with('message', 'Item deleted successfully.');
	}

}
