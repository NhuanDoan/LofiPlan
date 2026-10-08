<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;
use getID3;

class SongController extends Controller
{
    public function index()
    {
        $songs = Song::latest()->get();
        return view('songs.index', compact('songs'));
    }

    public function create()
    {
        return view('songs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|string|max:255',
            'artist' => 'nullable|string|max:255',
            'audio'  => 'required|file|mimes:mp3,wav,ogg,mpeg|max:20480',
            'cover'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $audioPath = null;
        $coverPath = null;

        try {
            $audioPath = $request->file('audio')->store('songs', 'public');
            $coverPath = $request->file('cover')?->store('covers', 'public');
            $fileInfo = (new getID3)->analyze(Storage::disk('public')->path($audioPath));

            Song::create([
                'title' => $request->string('title')->toString(),
                'artist' => $request->input('artist'),
                'file_path' => $audioPath,
                'cover_path' => $coverPath,
                'duration' => isset($fileInfo['playtime_seconds']) ? round($fileInfo['playtime_seconds']) : null,
                'user_id' => $request->user()->id,
            ]);
        } catch (Throwable $exception) {
            foreach ([$audioPath, $coverPath] as $path) {
                if ($path) Storage::disk('public')->delete($path);
            }

            throw $exception;
        }

        return redirect()->route('songs.index')->with('success', '🎶 Bài hát đã được tải lên thành công!');
    }

    public function edit(Song $song)
    {
        $this->authorize('update', $song);

        return view('songs.edit', compact('song'));
    }

    public function update(Request $request, Song $song)
    {
        $this->authorize('update', $song);

        $request->validate([
            'title'  => 'required|string|max:255',
            'artist' => 'nullable|string|max:255',
            'audio'  => 'nullable|file|mimes:mp3,wav,ogg,mpeg|max:20480',
            'cover'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $oldAudioPath = $song->file_path;
        $oldCoverPath = $song->cover_path;
        $newAudioPath = null;
        $newCoverPath = null;

        try {
            if ($request->hasFile('audio')) {
                $newAudioPath = $request->file('audio')->store('songs', 'public');
                $fileInfo = (new getID3)->analyze(Storage::disk('public')->path($newAudioPath));
                $song->file_path = $newAudioPath;
                $song->duration = isset($fileInfo['playtime_seconds'])
                    ? round($fileInfo['playtime_seconds'])
                    : $song->duration;
            }

            if ($request->hasFile('cover')) {
                $newCoverPath = $request->file('cover')->store('covers', 'public');
                $song->cover_path = $newCoverPath;
            }

            $song->title = $request->string('title')->toString();
            $song->artist = $request->input('artist');
            $song->save();
        } catch (Throwable $exception) {
            foreach ([$newAudioPath, $newCoverPath] as $path) {
                if ($path) Storage::disk('public')->delete($path);
            }

            throw $exception;
        }

        foreach ([[$oldAudioPath, $newAudioPath], [$oldCoverPath, $newCoverPath]] as [$oldPath, $newPath]) {
            if ($newPath && $oldPath) Storage::disk('public')->delete($oldPath);
        }

        return redirect()->route('songs.index')->with('success', '✅ Cập nhật bài hát thành công!');
    }

    public function destroy(Song $song)
    {
        $this->authorize('delete', $song);

        $paths = [$song->file_path, $song->cover_path];
        $song->delete();

        foreach ($paths as $path) {
            if ($path) Storage::disk('public')->delete($path);
        }

        return redirect()->route('songs.index')->with('success', '🗑️ Đã xóa bài hát!');
    }
}
