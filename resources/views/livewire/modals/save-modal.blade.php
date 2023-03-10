<!-- Save Modal start: -->
<div wire:ignore.self id="saveModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <span class="close closeSaveModal" style="color: white; float: right; font-size: 28px; font-weight: bold; --darkreader-inline-color:#e8e6e3;">&times;</span>
        @if (auth()->check())
          <h2>Salvează videoclipul tău favorit într-o listă creată de tine: 🙂</h2>
        @else
          <h2>Vrei să vizionezi din nou videoclipul mai târziu? 🤔</h2>
        @endif
        
      </div>
      <div class="modal-body">
        @if (auth()->check())
          <h2>Adaugă videoclipul unei liste de redare! 🙂</h2>
          <form>
              @foreach ($playlists as $playlist)
              <div class="mb-3">
                  <input class="form-check-input" type="checkbox" value="{{ $playlist->id }}" id="check-{{ $playlist->id }}" wire:model="selectedPlaylists" wire:click="setPlaylists">
                  <label class="form-check-label" for="check-{{ $playlist->id }}">
                      {{ $playlist->title }}
                  </label>
              </div>    
              @endforeach
          </form>
          @if (session()->has('setPlaylistsSuccessMessage'))
              <h5 class="alert alert-success">{{ session('setPlaylistsSuccessMessage') }}</h5>
          @endif
          @if (session()->has('setPlaylistsErrorMessage'))
              <h5 class="alert alert-danger">{{ session('setPlaylistsErrorMessage') }}</h5>
          @endif
                  
          <h2>Adaugă un playlist! 🙂</h2>
          @if (session()->has('addPlaylistSuccessMessage'))
              <h5 class="alert alert-success">{{ session('addPlaylistSuccessMessage') }}</h5>
          @endif
          @if (session()->has('addPlaylistErrorMessage'))
              <h5 class="alert alert-danger">{{ session('addPlaylistErrorMessage') }}</h5>
          @endif
          <form wire:submit.prevent='addPlaylist'>
              <label for="InputPlaylistTitle" class="form-label">Titlu</label>
              <input type="text" wire:model='title' class="inputPlaylistTitle" id="InputPlaylistTitle" aria-describedby="titleHelp">
              @error('title') <span class="text-danger">{{ $message }}</span> @enderror
              <button type="submit" class="addPlaylistButton">Adaugă</button>
          </form>
        @else
            <h2>Conectează-te pentru a adăuga acest videoclip într-un playlist.</h2>
            <a href="{{ route('login') }}">Conectează-te</a>
        @endif
        
      </div>
      <div class="modal-footer">
        <h3> </h3>
      </div>
    </div>
  </div>
  <!-- Save Modal end. -->