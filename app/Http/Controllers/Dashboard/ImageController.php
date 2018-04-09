<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\File;

class ImageController extends Controller
{
    /**
     * Send Image File as response
     *
     * @param  string $name
     * @return \Illuminate\Http\Response
     */
    public function getImage($name)
    {
        $path = storage_path('app/images/' . $name);
        $handler = new File($path);
        return response()->make(file_get_contents($path), 200, [
            'Content-Type' => $handler->getMimeType(),
            'Content-Disposition' => 'inline; filename="' . $name . '"'
        ]);
    }

    /**
     * Save uploaded images to storage
     *
     * @param  \Illuminate\Http\Request $request
     * @return string $path
     */
    public function saveImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);
        $extension = $request->image->clientExtension();
        $path = $request->image->store('images');
        return "/dashboard/{$path}";
    }

}
