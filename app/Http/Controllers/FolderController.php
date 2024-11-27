<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{

    public function index(Folder $folder, Request $request)
    {

        $sortBy = $request->sort_by ?? 'created_at';
        $medias = $folder->medias()
            ->when(isset($request->search), function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('type', 'LIKE', $request->search . '%');
            })
            ->orderBy($sortBy, 'desc')
            ->with('folder')
            ->paginate(5);

        // preserved the current filters
        $medias->appends(request()->query())->links();

        $folders = Folder::where('user_id', auth()->user()->id)->get();

        return view(
            'media.all',
            [
                'medias' => $medias,
                'title' => ucfirst($folder->name),
                'ownerRecord' => $folder,
                'folders' => $folders,
            ]
        );
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|max:255|unique:folders',
        ]);

        Folder::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id
        ]);

        return back();
    }

    public function update(Folder $folder, Request $request)
    {
        request()->validate([
            'name' => 'required|max:255|unique:folders,name,' . $folder->id,
        ]);

        $folder->update(['name' => $request->name]);

        return back();
    }

    public function destroy(Folder $folder)
    {
        $folder->delete();
        return response('success', 200);
    }
}
