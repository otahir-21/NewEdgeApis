<?php
namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // Store multiple files (image, PDF, and video)
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'alt_tag' => 'required|string',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048', // Validate image
            'pdf' => 'nullable|file|mimes:pdf|max:2048', // Validate PDF
            'video' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:10240', // Validate video (max size: 10MB)
        ]);

        // Create a new gallery instance
        $gallery = new Gallery();
        $gallery->alt_tag = $request->input('alt_tag');

        // Initialize paths for response
        $imagePath = null;
        $pdfPath = null;
        $videoPath = null;

        // Handle image upload
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time() . '_img.' . $file->getClientOriginalExtension(); // Create a unique filename
            $file->move(public_path('images/galleries'), $filename); // Move to desired directory
            $gallery->img = $filename; // Store the filename
            $imagePath = '/images/galleries/' . $filename; // Save image path for response
        }

        // Handle PDF upload
        if ($request->hasFile('pdf')) {
            $pdfFile = $request->file('pdf');
            $pdfFilename = time() . '_pdf.' . $pdfFile->getClientOriginalExtension(); // Create a unique filename
            $pdfFile->move(public_path('pdfs/galleries'), $pdfFilename); // Move to desired directory
            $gallery->pdf = $pdfFilename; // Store the PDF filename
            $pdfPath = '/pdfs/galleries/' . $pdfFilename; // Save PDF path for response
        }

        // Handle video upload
        if ($request->hasFile('video')) {
            $videoFile = $request->file('video');
            $videoFilename = time() . '_video.' . $videoFile->getClientOriginalExtension(); // Create a unique filename
            $videoFile->move(public_path('videos/galleries'), $videoFilename); // Move to desired directory
            $gallery->video = $videoFilename; // Store the video filename
            $videoPath = '/videos/galleries/' . $videoFilename; // Save video path for response
        }

        // Save to database
        $gallery->save();

        return response()->json([
            'message' => 'Files uploaded successfully',
            'image_path' => $imagePath,
            'pdf_path' => $pdfPath,
            'video_path' => $videoPath,
        ], 201);
    }

    // List all gallery items
    public function index()
    {
        $galleries = Gallery::orderBy('created_at', 'desc')->get()->map(function ($gallery) {
            return [
                'id' => $gallery->id,
                'alt_tag' => $gallery->alt_tag,
                'img' => isset($gallery->img) ? '/images/galleries/' . $gallery->img : null,
                'pdf' => isset($gallery->pdf) ? '/pdfs/galleries/' . $gallery->pdf : null,
                'video' => isset($gallery->video) ? '/videos/galleries/' . $gallery->video : null,
            ];
        });

        return response()->json($galleries);
    }

    // Get a single gallery item by ID
    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);

        return response()->json([
            'id' => $gallery->id,
            'alt_tag' => $gallery->alt_tag,
            'img' => isset($gallery->img) ? '/images/galleries/' . $gallery->img : null,
            'pdf' => isset($gallery->pdf) ? '/pdfs/galleries/' . $gallery->pdf : null,
            'video' => isset($gallery->video) ? '/videos/galleries/' . $gallery->video : null,
        ]);
    }

    // Update an existing gallery item
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'alt_tag' => 'nullable|string',
            'img' => 'nullable|image|max:2048', // Image validation
            'pdf' => 'nullable|file|mimes:pdf|max:2048', // PDF validation
            'video' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:10240', // Video validation
        ]);

        if ($request->hasFile('img')) {
            if ($gallery->img) {
                Storage::delete('public/images/galleries/' . $gallery->img);
            }
            $filename = time() . '_img.' . $request->file('img')->getClientOriginalExtension();
            $request->file('img')->move(public_path('images/galleries'), $filename);
            $gallery->img = $filename;
        }

        if ($request->hasFile('pdf')) {
            if ($gallery->pdf) {
                Storage::delete('public/pdfs/galleries/' . $gallery->pdf);
            }
            $pdfFilename = time() . '_pdf.' . $request->file('pdf')->getClientOriginalExtension();
            $request->file('pdf')->move(public_path('pdfs/galleries'), $pdfFilename);
            $gallery->pdf = $pdfFilename;
        }

        if ($request->hasFile('video')) {
            if ($gallery->video) {
                Storage::delete('public/videos/galleries/' . $gallery->video);
            }
            $videoFilename = time() . '_video.' . $request->file('video')->getClientOriginalExtension();
            $request->file('video')->move(public_path('videos/galleries'), $videoFilename);
            $gallery->video = $videoFilename;
        }

        $gallery->alt_tag = $request->input('alt_tag', $gallery->alt_tag);
        $gallery->save();

        return response()->json($gallery);
    }

    // Delete a gallery item
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        if ($gallery->img) {
            Storage::delete('public/images/galleries/' . $gallery->img);
        }
        if ($gallery->pdf) {
            Storage::delete('public/pdfs/galleries/' . $gallery->pdf);
        }
        if ($gallery->video) {
            Storage::delete('public/videos/galleries/' . $gallery->video);
        }

        $gallery->delete();

        return response()->json(['message' => 'Files deleted successfully']);
    }
}

// namespace App\Http\Controllers;

// use App\Models\Gallery;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;

// class GalleryController extends Controller
// {
//     // Store multiple images and PDFs
//     public function store(Request $request)
// {
//     // Validate the request
//     $request->validate([
//         'alt_tag' => 'required|string',
//         'img' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048', // Validate image
//         'pdf' => 'nullable|file|mimes:pdf|max:2048', // Validate PDF
//     ]);

//     // Create a new gallery instance
//     $gallery = new Gallery();
//     $gallery->alt_tag = $request->input('alt_tag');

//     // Initialize paths for response
//     $imagePath = null;
//     $pdfPath = null;

//     // Handle image upload
//     if ($request->hasFile('img')) {
//         $file = $request->file('img');
//         $filename = time() . '.' . $file->getClientOriginalExtension(); // Create a unique filename
//         $file->move(public_path('images/galleries'), $filename); // Move to desired directory
//         $gallery->img = $filename; // Store the filename or full path as needed
//         $imagePath = '/images/galleries/' . $filename; // Save image path for response
//     }

//     // Handle PDF upload
//     if ($request->hasFile('pdf')) {
//         $pdfFile = $request->file('pdf');
//         $pdfFilename = time() . '.' . $pdfFile->getClientOriginalExtension(); // Create a unique filename
//         $pdfFile->move(public_path('pdfs/galleries'), $pdfFilename); // Move to desired directory
//         $gallery->pdf = $pdfFilename; // Store the PDF filename
//         $pdfPath = '/pdfs/galleries/' . $pdfFilename; // Save PDF path for response
//     }

//     // Save to database
//     $gallery->save();

//     return response()->json([
//         'message' => 'Files uploaded successfully',
//         'image_path' => $imagePath,
//         'pdf_path' => $pdfPath,
//     ], 201);
// }

// public function index()
// {
//     $galleries = Gallery::orderBy('created_at', 'desc')->get()->map(function ($gallery) {
//         return [
//             'id' => $gallery->id,
//             'alt_tag' => $gallery->alt_tag,
//             'img' => isset($gallery->img) ? '/images/galleries/' . $gallery->img : null,
//         ];
//     });

//     return response()->json($galleries);
// }


// // Get a single image by ID
// public function show($id)
// {
//     $gallery = Gallery::findOrFail($id);

//     return response()->json([
//         'id' => $gallery->id,
//         'alt_tag' => $gallery->alt_tag,
//         'img' => isset($gallery->img) ? '/images/galleries/' . $gallery->img : null,
//     ]);
// }

//     // Update an existing image or PDF
//     public function update(Request $request, $id)
//     {
//         $gallery = Gallery::findOrFail($id);

//         $request->validate([
//             'alt_tag' => 'nullable|string',
//             'img' => 'nullable|image|max:2048', // Image validation
//             'pdf' => 'nullable|file|mimes:pdf|max:2048', // PDF validation
//             'video' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:10240', // Validate video (max size: 10MB)
//         ]);

//         if ($request->hasFile('img')) {
//             // Delete old image
//             if ($gallery->img) {
//                 Storage::delete('public/images/galleries/' . $gallery->img);
//             }

//             // Store new image
//             $filename = time() . '.' . $request->file('img')->getClientOriginalExtension();
//             $request->file('img')->move(public_path('images/galleries'), $filename);
//             $gallery->img = $filename;
//         }

//         if ($request->hasFile('pdf')) {
//             // Delete old PDF
//             if ($gallery->pdf) {
//                 Storage::delete('public/pdfs/galleries/' . $gallery->pdf);
//             }

//             // Store new PDF
//             $pdfFilename = time() . '.' . $request->file('pdf')->getClientOriginalExtension();
//             $request->file('pdf')->move(public_path('pdfs/galleries'), $pdfFilename);
//             $gallery->pdf = $pdfFilename; // Update the PDF filename
//         }
//         // Handle video upload
//         if ($request->hasFile('video')) {
//             $videoFile = $request->file('video');
//             $videoFilename = time() . '_video.' . $videoFile->getClientOriginalExtension(); // Create a unique filename
//             $videoFile->move(public_path('videos/galleries'), $videoFilename); // Move to desired directory
//             $gallery->video = $videoFilename; // Store the video filename
//             $videoPath = '/videos/galleries/' . $videoFilename; // Save video path for response
//         }

//         $gallery->alt_tag = $request->input('alt_tag', $gallery->alt_tag);
//         $gallery->save();

//         return response()->json($gallery);
//     }

//     // Delete an image or PDF
//     public function destroy($id)
//     {
//         $gallery = Gallery::findOrFail($id);
//         // Delete image file
//         if ($gallery->img) {
//             Storage::delete('public/images/galleries/' . $gallery->img);
//         }
//         // Delete PDF file
//         if ($gallery->pdf) {
//             Storage::delete('public/pdfs/galleries/' . $gallery->pdf);
//         }

//         $gallery->delete(); // Delete the database entry

//         return response()->json(['message' => 'Files deleted successfully']);
//     }
// }