<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
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

        // Lưu file nhạc và ảnh
        $audioPath = $request->file('audio')->store('songs', 'public');
        $coverPath = $request->hasFile('cover')
            ? $request->file('cover')->store('covers', 'public')
            : null;

        // Lấy độ dài bài hát bằng getID3
        $realPath = Storage::disk('public')->path($audioPath);
        $getID3 = new getID3;
        $fileInfo = $getID3->analyze($realPath);
        $duration = $fileInfo['playtime_seconds'] ?? null;

        Song::create([
            'title'      => $request->title,
            'artist'     => $request->artist,
            'file_path'  => $audioPath,
            'cover_path' => $coverPath,
            'duration'   => $duration ? round($duration) : null,
            'user_id'    => Auth::id() ?? 1,
        ]);

        return redirect()->route('songs.index')->with('success', '🎶 Bài hát đã được tải lên thành công!');
    }

    public function edit(Song $song)
    {
        return view('songs.edit', compact('song'));
    }

    public function update(Request $request, Song $song)
    {
        $request->validate([
            'title'  => 'required|string|max:255',
            'artist' => 'nullable|string|max:255',
            'audio'  => 'nullable|file|mimes:mp3,wav,ogg,mpeg|max:20480',
            'cover'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('audio')) {
            if ($song->file_path && Storage::disk('public')->exists($song->file_path)) {
                Storage::disk('public')->delete($song->file_path);
            }
            $audioPath = $request->file('audio')->store('songs', 'public');

            // Phân tích lại thời lượng
            $realPath = Storage::disk('public')->path($audioPath);
            $getID3 = new getID3;
            $fileInfo = $getID3->analyze($realPath);
            $song->duration = $fileInfo['playtime_seconds'] ?? $song->duration;

            $song->file_path = $audioPath;
        }

        if ($request->hasFile('cover')) {
            if ($song->cover_path && Storage::disk('public')->exists($song->cover_path)) {
                Storage::disk('public')->delete($song->cover_path);
            }
            $song->cover_path = $request->file('cover')->store('covers', 'public');
        }

        $song->title = $request->title;
        $song->artist = $request->artist;
        $song->save();

        return redirect()->route('songs.index')->with('success', '✅ Cập nhật bài hát thành công!');
    }

    public function destroy(Song $song)
    {
        if ($song->file_path && Storage::disk('public')->exists($song->file_path)) {
            Storage::disk('public')->delete($song->file_path);
        }
        if ($song->cover_path && Storage::disk('public')->exists($song->cover_path)) {
            Storage::disk('public')->delete($song->cover_path);
        }

        $song->delete();
        return redirect()->route('songs.index')->with('success', '🗑️ Đã xóa bài hát!');
    }
}
