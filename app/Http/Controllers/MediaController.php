<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all(Request $request)
    {

        $sortBy = $request->sort_by ?? 'created_at';

        $userId = auth()->user()->id;
        $medias = Media::where('user_id', $userId)
            ->when(isset($request->search), function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('type', 'LIKE', $request->search . '%');
            })
            ->when(!isset($request->search), function ($query) use ($request) {
                $query->where('folder_id', null);
            })
            ->orderBy($sortBy, 'desc')
            ->paginate(2);

        // preserved the current filters
        $medias->appends(request()->query())->links();

        $folders = Folder::where('user_id', $userId)
            ->when(isset($request->search) && isset($request->filter_by), function ($query) use ($request) {
                if ($request->filter_by != 'type') {
                    $query->where($request->filter_by, 'LIKE', '%' . $request->search . '%');
                }
            })
            ->get();

        return view('media.all', ['medias' => $medias, 'folders' => $folders]);
    }

    public function images(Request $request)
    {

        $sortBy = $request->sort_by ?? 'created_at';

        $medias = Media::where('type', 'image')
            ->when(isset($request->search), function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('type', 'LIKE', $request->search . '%');
            })
            ->orderBy($sortBy, 'desc')
            ->with('folder')
            ->paginate(1);

        // preserved the current filters
        $medias->appends(request()->query())->links();

        return view('media.all', ['medias' => $medias, 'title' => 'Images']);
    }

    public function videos(Request $request)
    {
        $sortBy = $request->sort_by ?? 'created_at';

        $medias = Media::where('type', 'video')
            ->when(isset($request->search), function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('type', 'LIKE', $request->search . '%');
            })
            ->orderBy($sortBy, 'desc')
            ->with('folder')
            ->paginate();

        // preserved the current filters
        $medias->appends(request()->query())->links();

        return view('media.all', ['medias' => $medias, 'title' => 'Videos']);
    }

    public function upload(Request $request)
    {
        // validate folder
        if (isset($request->folder_id)) {
            $isExist = Folder::find($request->folder_id);

            if (!$isExist) {
                return response('Folder not found', 201);
            }
        }
        $file = $request->file('file');

        // file type validation
        if (!in_array(strtolower($file->getClientOriginalExtension()), ['jpg', 'jpeg', 'png', 'mp4'])) {
            return response('Invalid file type', 201);
        }

        // size validation
        if ($file->getSize() > 50000000) {
            return response('File too large', 201);
        }

        $fileName = date('Y-m-d-H-i-s') . '.' . $file->getClientOriginalExtension();
        //$path =  Storage::disk('local')->putFileAs("public/uploads", $file, $fileName);

        $destinationPath = public_path('storage/');

        $profileName = $request->file->getClientOriginalName();
        $filename = pathinfo($profileName, PATHINFO_FILENAME);
        $extension = pathinfo($profileName, PATHINFO_EXTENSION);

        $size = $request->file->getClientSize();
        $file->move($destinationPath, $profileName);
        $input['file'] = "$profileName";
        $type = $this->getType($request->file->getClientOriginalExtension());

        Media::create([
            'name' => $filename,
            'mediaType' => strtoupper($type),
            'type' => $type,
            'size' => $size,
            'location' => $input['file'],
            'user_id' => auth()->user()->id,
            'folder_id' => $request->folder_id ?? null,
        ]);

        return back()->with('success', 'File uploaded successfully');
    }

    public function update(Media $media, Request $request)
    {
        request()->validate([
            'name' => 'required|max:255|unique:folders,name,' . $media->id,
            'folder_id' => 'nullable|exists:folders,id',
        ]);

        $media->update([
            'name' => $request->name,
            'folder_id' => $request->folder_id,
        ]);

        return back()->with('success', 'Media updated successfully');
    }

    public function destroy(Media $media)
    {

        $isExist =  Storage::disk('local')->exists($media->location);

        if ($isExist) {
            Storage::disk('local')->delete($media->location);
        }

        $media->delete();
        return 'success';
    }

    public function getType($extension)
    {

        $extension = strtolower($extension);
        $types = [
            'images' => ['jpg', 'jpeg', 'png'],
            'videos' => ['mp4'],
        ];

        if (in_array($extension, $types['images'])) {
            return 'image';
        }

        if (in_array($extension, $types['videos'])) {
            return 'video';
        }

        return 'none';
    }
}
