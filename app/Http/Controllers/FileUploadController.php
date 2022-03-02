<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function fileUpload()
	{
		return view('fileUpload');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function fileUploadPost(Request $request)
	{
		$request->validate([
				'file' => 'required|mimes:jpg,jpeg,png', 
				'file' => 'file|max:5000',
		]);

		// Get plant id
		$plantId = $request->plant_id;

		// Create a filename
		$fileName = time().'.'.$request->file->extension();  
		//$fileName = $request->file->getClientOriginalName();

		// Store filename locally
		$listing = new File;
		$listing->filename = $fileName;
		$listing->plant_id = $plantId;
		$listing->save();

		// Store on DO spaces
		Storage::disk('do_spaces')->putFileAs('uploads', request()->file, $fileName,'public');

		return back()
			->with('success','You have successfully uploaded file:')
			->with('file',$fileName);

	}
}
