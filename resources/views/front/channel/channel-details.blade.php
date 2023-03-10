@extends('front.channel.master.channel')

@section('details')
<div class="col-lg-11 mx-auto">
    <br>
    <dl class="row">
        @if ($channel->description != null)
            <dt class="col-sm-3">Descriere</dt>
            <dd class="col-sm-9">{{ $channel->description }}</dd>
        @endif
        @if ($channel->contact != null)
        <dt class="col-sm-3">Contact</dt>
        <dd class="col-sm-9">
        <p>{{ $channel->contact }}</p>
        </dd>
        @endif
        @if ($channel->created_at != null)
        <dt class="col-sm-3">Canal creat la</dt>
        <dd class="col-sm-9">{{ $channel->created_at->format('d.m.Y') }}</dd>
        @endif
    </dl>
</div>
@endsection