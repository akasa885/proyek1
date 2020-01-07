<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class fileUploadController extends Controller
{
  public function fileUpload()
    {
        return view('admin/coba_upload');
    }

  public function fileUploadPost(Request $request)
  {
      $request->validate([
          'file' => 'required|mimes:png,jpg,jpeg,gif|max:2048',
      ]);

      $fileName = time().'.'.$request->file->extension();

      $request->file->move(public_path('uploads'), $fileName);

      return back()
          ->with('success','You have successfully upload file.')
          ->with('file',$fileName);

  }

}
