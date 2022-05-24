<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class AdminController extends Controller
{
    public function home()
    {
        // return view('admin.home');
        return redirect()->route('admin.course_student.list');
    }

    public function upload(Request $request)
    {
        try {
            if (!$request->hasFile('file')) {
                return response()->json([
                    'status' => false,
                    'message' => __('custom.message.upload_file_fail'),
                    'error' => 'File upload is required.'
                ]);
            }

            $path = $request->get('path') ?? 'default';
            $path = $request->file('file')->store($path);

            return response()->json([
                'status' => true,
                'message' => __('custom.message.upload_file_success'),
                'data' => [
                    'path' => $path,
                    'url' => Storage::url($path)
                ]
            ]);
        } catch (Throwable $exception) {
            return response()->json([
                'status' => false,
                'message' => __('custom.message.upload_file_fail'),
                'error' => $exception->getMessage()
            ]);
        }
    }
}
