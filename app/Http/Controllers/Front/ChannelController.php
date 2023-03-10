<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Playlist;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Routing\RouteUri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ChannelController extends Controller
{
    public function showChannelPage(Channel $channel) {
        return view('front.channel.master.channel')->with('channel', $channel)->with('home', 'home-channel');
    }

    public function showChannelHome(Channel $channel) {
        $specialVideo = Video::where('id', '=', $channel->special_video)->get();
        return view('front.channel.channel-home')->with('channel', $channel)->with('specialVideo', $specialVideo)->with('home', 'channel-home');
    }

    public function showChannelVideos(Channel $channel) {
        $paginatedVideos = $channel->videos->paginate(6);
        return view('front.channel.channel-videos')->with('channel', $channel)->with('videos', 'channel-videos')->with('paginatedVideos', $paginatedVideos);
    }

    public function showChannelDetails(Channel $channel) {
        return view('front.channel.channel-details')->with('channel', $channel)->with('about', 'channelDetails');
    }

    public function showNewChannelForm() {
        if (auth()->user()->channel_id == null) {
            return view('front.channel.new-channel-form');
        }
        return redirect(route('home'));
    }

    public function createChannel(Request $request) {
        $channel = new Channel();
        $channel->title = $request->title;
        $channel->slug = Str::slug($request->title) . '-' . Str::random(6) . time();
        $channel->description = $request->description;
        $channel->contact = $request->contact;
        if ($request->hasFile('avatar')) {
            $avatarExtension = $request->file('avatar')->getClientOriginalExtension();
            $avatarName = str_replace(' ', '_', $request->title) . '_' . time() . '.' . $avatarExtension;
            $request->file('avatar')->move('images/avatars', $avatarName);

            $channel->avatar = $avatarName;
        }
        $channel->user_id = auth()->user()->id;
        $channel->save();
        
        
        User::where('id', auth()->user()->id)->update(array('channel_id' => $channel->id));
        return redirect(route('show-channel-home', auth()->user()->channel->slug));
    }

    public function showChannelCustomizationPage() {
        return view('front.channel.manage.customization.channel-customization')->with('channelCustomizationPage', 'channelCustomizationPage');
    }

    public function showChannelCustomizationPageForBranding() {
        return view('front.channel.manage.customization.channel-customization-branding')->with('branding', 'branding');
    }

    public function updateChannelBranding(Request $request) {
        $theCurrentUserChannelId = auth()->user()->channel->id;
        $channel = Channel::findOrFail($theCurrentUserChannelId);
        if ($request->hasFile('avatar')) {
            if ($channel->avatar != 'default-avatar.png') {
                File::delete('images/avatars/' . $channel->avatar);
            }
            $avatarExtension = $request->file('avatar')->getClientOriginalExtension();
            $avatarName = str_replace(' ', '_', $channel->title) . '_' . time() . '.' . $avatarExtension;
            $request->file('avatar')->move('images/avatars', $avatarName);
            $channel->avatar = $avatarName;
        }
        if ($request->hasFile('banner')) {
            if ($channel->banner != 'default-banner.jpg') {
                File::delete('images/banners/' . $channel->banner);
            }
            $bannerExtension = $request->file('banner')->getClientOriginalExtension();
            $bannerName = str_replace(' ', '_', $channel->title) . '_' . time() . '.' . $bannerExtension;
            $request->file('banner')->move('images/banners', $bannerName);
            $channel->banner = $bannerName;
        }
        $channel->save();
        return redirect(route('show-channel-home', auth()->user()->channel->slug));
    }

    public function showChannelCustomizationPageForDetails() {
        $theCurrentUserChannelId = auth()->user()->channel->id;
        $channel = Channel::findOrFail($theCurrentUserChannelId);
        $channelURL = route('show-channel-home', auth()->user()->channel->slug);
        return view('front.channel.manage.customization.channel-customization-details')->with('channel', $channel)->with('channelURL', $channelURL)->with('details', 'details');
    }

    public function updateChannelDetails(Request $request) {
        $theCurrentUserChannelId = auth()->user()->channel->id;
        $channel = Channel::findOrFail($theCurrentUserChannelId);
        $channel->title = $request->title;
        $channel->description = $request->description;
        $channel->contact = $request->contact;
        $channel->save();
        return redirect(route('show-channel-details', auth()->user()->channel->slug));
    }

    public function showChannelCustomizationPageForLayout() {
        if (auth()->user()->channel_id != null) {
            $theCurrentUserChannelId = auth()->user()->channel->id;
            $videos = Video::where('channel_id', $theCurrentUserChannelId)->get();
            return view('front.channel.manage.customization.channel-customization-layout')->with('videos', $videos)->with('layout', 'layout');
        }
        return redirect(route('show-new-channel-form'));
    }

    public function updateChannelLayout(Request $request) {
        $theCurrentUserChannelId = auth()->user()->channel->id;
        $channel = Channel::findOrFail($theCurrentUserChannelId);
        $channel->special_video = $request->special_video;
        $channel->save();
        return redirect(route('show-channel-home', auth()->user()->channel->slug));
    }

    //Metode pentru gestionarea videoclipurilor de pe canalul utilizatorului:
    public function showChannelContentPage() {
        return view('front.channel.manage.content.channel-content')->with('channelContentPage', 'channelContentPage');
    }

    public function showChannelContentPageForVideos() {
        if (auth()->user()->channel_id != null) {
            $theCurrentUserChannelId = auth()->user()->channel->id;
            $videos = Video::where('channel_id', $theCurrentUserChannelId)->sortable(['created_at' => 'desc'])->paginate(4)->withQueryString();
            return view('front.channel.manage.content.channel-content-videos')->with('videos', $videos)->with('channelVideos', 'channelVideos');
        }
        return redirect(route('show-new-channel-form'));
    }

    public function showChannelContentPageForPlaylists() {
        if (auth()->user()->channel_id != null) {
            $theCurrentUserLoggedInId = auth()->user()->id;
            $playlists = Playlist::where('user_id', $theCurrentUserLoggedInId)->sortable(['created_at' => 'desc'])->paginate(4)->withQueryString();
            return view('front.channel.manage.content.channel-content-playlists')->with('playlists', $playlists)->with('channelPlaylists', 'channelPlaylists');
        }
    }  
}
