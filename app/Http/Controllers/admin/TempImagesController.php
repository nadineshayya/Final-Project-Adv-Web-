<?php

namespace App\Http\Controllers\admin;
use App\Models\TempImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

class TempImagesController extends Controller
{
  public function create(Request $request)
  {
      $image = $request->image;
  
      if (!empty($image)) {
          $ext = $image->getClientOriginalExtension();
          $newName = time() . '.' . $ext;
  
          $tempImage = new TempImage();
          $tempImage->name = $newName;
          $tempImage->save();
  
          $path = public_path() . '/temp/';
          $image->move($path, $newName);
  
          return response()->json([
              'status' => true,
              'image_id' => $tempImage->id,
             'ImagePath' => url('temp/' . $newName),
              'message' => 'Image uploaded successfully',
          ]);
      }
  
      return response()->json([
          'status' => false,
          'message' => 'No image provided',
      ]);
  }
  
}