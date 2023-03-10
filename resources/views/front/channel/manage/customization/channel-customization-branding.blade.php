@extends('front.channel.manage.customization.channel-customization')

@section('branding')
<form action=" {{ route('update-channel-branding') }}" method="POST" class="mx-auto row g-3" enctype="multipart/form-data"> 
  @csrf
  @method('put')
    <h5>Fotografie </h5>
    <p>Fotografia de profil va fi afișată unde este prezentat canalul tău pe YouTube, cum ar fi în dreptul videoclipurilor și comentariilor tale</p>
    <div class="mb-3">
      <div class="card mb-3" style="max-width: 600px;">
        <div class="row g-0">
          <div class="col-md-4" id="image-preview">
            <img src="\images\avatars\{{ auth()->user()->channel->avatar != 'default-avatar.png' ? auth()->user()->channel->avatar : 'default-avatar.png' }}" class="img-fluid rounded-start" alt="Imagine avatar">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <p class="card-text">Este recomandat să folosești o imagine de cel puțin 98 x 98 pixeli și cel mult 4 MB. Folosește un fișier PNG sau GIF (fără animație). Asigură-te că fotografia respectă Regulile comunității YouTube.</p>
              <input class="form-control" type="file" accept="image/*" id="photo-file" name="avatar">
              @error('avatar')
                  <div id="photoHelp" class="form-text text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
      </div>
    </div>
    <h5>Imaginea bannerului </h5>
    <p>Această imagine va fi afișată în partea de sus a canalului</p>
    <div class="mb-3">
      <div class="card mb-3" style="max-width: 950px;">
        <div class="row g-0">
          <div class="col-md-4" id="image-preview">
            <img src="\images\youtube-banner.png" class="img-fluid rounded-start" alt="Imagine banner">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <p class="card-text">Pentru rezultate optime pe toate dispozitivele, folosește o imagine de cel puțin 2048 x 1152 pixeli și cel mult 6 MB.</p>
              <input class="form-control" type="file" accept="image/*" id="photo-file" name="banner">
              @error('avatar')
                  <div id="photoHelp" class="form-text text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mb-3 mx-auto col-lg-3">
      <button type="submit" class="btn btn-primary">Publică modificările</button>
    </div>
</form>
@endsection

@section('image-preview-script')
  @include('front.scripts.image-preview-script')
@endsection