<?php

namespace App\Http\Livewire;

use App\Models\Playlist;
use Livewire\Component;
use Illuminate\Support\Str;

class SaveVideoToPlaylistComponent extends Component
{
    public $title, $slug, $description, $thumbnail, $published, $user_id;
    public $playlists;
    public $video;
    public $selectedPlaylists = [];

    public function mount()
    {
        $this->selectedPlaylists = $this->video->playlists->pluck('id')->toArray();
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|min:6',
            'slug' => 'required|max:255',
            'description' => 'max:255',
            'thumbnail' => 'max:1024',
            'published' => '',
            'user_id' => '',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function addPlaylist() {
        $this->slug = Str::slug($this->title) . '-' . Str::random(6) . time();
        $this->user_id = auth()->user()->id;
        $this->published = 0;

        $this->validate();

        $insertedData = Playlist::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'published' => $this->published,
            'user_id' => $this->user_id,
        ]);
        
        if ($insertedData) {
            session()->flash('addPlaylistSuccessMessage', "Playlist creat cu succes!");
            $this->resetInputs();
        } else {
            session()->flash('addPlaylistErrorMessage', "Ceva nu a mers bine!");
        }
    }

    public function resetInputs() {
        $this->title = '';
    }

    public function setPlaylists() {
        $playlistSet = $this->video->playlists()->sync($this->selectedPlaylists);
        if ($playlistSet) {
            session()->flash('setPlaylistsSuccessMessage', "Playlist-uri sincronizate cu succes");
            $this->resetInputs();
        } else {
            session()->flash('setPlaylistsErrorMessage', "Ceva nu a mers bine!");
        }
    }

    public function render()
    {
        if (auth()->check()) {
            $this->playlists = auth()->user()->playlists;
        }
        return view('livewire.save-video-to-playlist-component', [$this->playlists])->with('video', $this->video);
    }
}
