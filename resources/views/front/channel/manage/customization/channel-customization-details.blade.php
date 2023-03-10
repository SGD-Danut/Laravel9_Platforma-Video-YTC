@extends('front.channel.manage.customization.channel-customization')

@section('details')
<form action=" {{ route('update-channel-details') }}" method="POST" class="mx-auto row g-3" enctype="multipart/form-data"> 
  @csrf
  @method('put')
    <div class="mb-3">
      <h5>Nume</h5>
      <label for="InputTitle" class="form-label">Alege un nume de canal care te reprezintă pe tine și conținutul tău. Modificările aduse numelui și fotografiei sunt vizibile numai pe YouTube, nu și în alte servicii Google.</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" id="InputTitle" aria-describedby="titleHelp" name="title" value="{{ old('title') ? old('title') : $channel->title }}">
      @error('title')
          <div id="titleHelp" class="form-text text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <h5>Descriere</h5>
      <label for="InputPresentation" class="form-label">Prezintă-le spectatorilor canalul tău. Descrierea va apărea în secțiunea Despre a canalului și în rezultatele căutării, printre altele.</label>
      <textarea type="text" class="form-control descriptionTextArea @error('description') is-invalid @enderror" id="InputDescription" aria-describedby="descriptionHelp" name="description">{{ old('description') ? old('description') : $channel->description }}</textarea>
      @error('description')
          <div id="descriptionHelp" class="form-text text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <h5>Adresa URL a canalului</h5>
      <label for="InputTitle" class="form-label">Este adresa web standard a canalului. Include ID-ul unic al canalului, care este alcătuit din cifrele și literele de la sfârșitul adresei URL.</label>
      <input class="form-control" type="text" value="{{ $channelURL }}" aria-label="readonly input example" readonly>
    </div>
    <div class="mb-3">
      <h5>Informații de contact</h5>
      <label for="InputTitle" class="form-label">Transmite-le persoanelor interesate cum pot să te contacteze cu solicitări de colaborare. Adresa de e-mail pe care o introduci poate să apară în secțiunea Despre a canalului și să fie vizibilă pentru spectatori.</label>
      <input type="email" class="form-control @error('contact') is-invalid @enderror" id="InputContact" aria-describedby="contactHelp" name="contact" value="{{ $channel->contact }}">
      @error('contact')
      <div id="contactHelp" class="form-text text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3 mx-auto col-lg-3">
      <button type="submit" class="btn btn-primary">Publică modificările</button>
    </div>
</form>
@endsection

@section('image-preview-script')
  @include('front.scripts.image-preview-script')
@endsection