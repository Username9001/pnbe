<?php

namespace App\GraphQL\Mutations;

class Upload
{
    /**
     * Upload a file, store it on the server and return the path.
     *
     * @param  mixed  $root
     * @param  array<string, mixed>  $args
     * @return string|null
     */
    public function __invoke($root, array $args): ?string
    {
        /** @var \Illuminate\Http\UploadedFile $file */
        //$file = $args['file'];
				//$name = 'bla'.uniqid().'.jpg';
				//$name = $file->getClientOriginalName();
				// store locally
        //$file->storePubliclyAs('public', $name);0
			$file = $args['file'];
			$extension = $file->extension();
			$mimeType = $file->getMimeType();
			$filename = $file->getClientOriginalName();
			// $plant = 2;
			$path = Storage::disk('do_spaces')->putFileAs('uploads', $file, time().'.'.$extension);

			return back();
    }
}
