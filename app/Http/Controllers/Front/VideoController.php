<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\History;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function showNewVideoForm() {
        if (auth()->user()->channel_id != null) {
            $categories = Category::all();
            return view('front.new-video-form')->with('categories', $categories);
        }
        return redirect(route('show-new-channel-form'));
    }
    
    public function addNewVideo(Request $request) {
        $video = new Video();

        $ffmpegFullPath = "C:/xampp/htdocs/Laravel9_YouTube_Clone/public/ffmpeg/windows/ffmpeg";
        $videoFileFromRequest = $request->file('videoFile');
        //Obtinere durată video:
        $ffprobeFullPath = "C:/xampp/htdocs/Laravel9_YouTube_Clone/public/ffmpeg/windows/ffprobe";
        $unformattedDuration = shell_exec("$ffprobeFullPath -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 $videoFileFromRequest");

        $hours = floor($unformattedDuration / 3600);
        $mins = floor(($unformattedDuration - ($hours*3600)) / 60);
        $secs = floor($unformattedDuration % 60);

        $hours = ($hours < 1) ? "" : $hours . ":";
        $mins = ($mins < 10) ? "0" . $mins . ":" : $mins . ":";
        $secs = ($secs < 10) ? "0" . $secs : $secs;

        $formattedDuration = $hours . $mins . $secs;
        $video->duration = $formattedDuration;
        //Generare thumnail, dacă utilizatorul a bifat obțiunea:
        if ($request->generateThumbnail == 1) {
            $thumbnailName = str_replace(' ', '_', $request->title) . '_' . time() . '.jpg';
            $outputThumbnailPath = "images/thumbnails/";
            $fullOutputThumbnailPath = $outputThumbnailPath . $thumbnailName;
            $generateThumbnailCommand = "$ffmpegFullPath -i $videoFileFromRequest -ss 00:00:01.000 -vframes 1 $fullOutputThumbnailPath";
            system($generateThumbnailCommand);
            $video->thumbnail = $thumbnailName;
        }
        //Generare thumnail, în funcție de ce obțiune a bifat utilizatorul:
        if ($request->hasFile('videoFile')) {
            $videoFileExtention = $request->file('videoFile')->getClientOriginalExtension();
            $videoFileName = str_replace(' ', '_', $request->title) . '_' . time() . '.' . $videoFileExtention;
            if ($request->needsCompression == 'no') {
                $request->file('videoFile')->move('videos', $videoFileName);
            } else if ($request->needsCompression != 'no') {
                $outputVideoPath = "videos/";
                $fullOutputVideoPath = $outputVideoPath . $videoFileName;
                if ($request->needsCompression == 'yes-custom') {
                    $resolution = $request->resolution;
                    $compressVideoCommand = "$ffmpegFullPath -i $videoFileFromRequest -s $resolution $fullOutputVideoPath";
                } else if ($request->needsCompression == 'yes-auto') {
                    $compressVideoCommand = "$ffmpegFullPath -i $videoFileFromRequest $fullOutputVideoPath";
                }
                system($compressVideoCommand);
            }
            $video->file_path = $videoFileName;
        }

        $video->title = $request->title;
        $video->slug = Str::slug($request->title) . '-' . Str::random(6) . time();
        $video->description = $request->description;
        //Alegere thumnail personal, dacă obțiunea de generare automată este dezactivată:
        if ($request->hasFile('thumbnail') && $request->generateThumbnail != 1) {
            $thumbnailExtention = $request->file('thumbnail')->getClientOriginalExtension();
            $thumbnailName = str_replace(' ', '_', $request->title) . '_' . time() . '.' . $thumbnailExtention;
            $request->file('thumbnail')->move('images/thumbnails', $thumbnailName);

            $video->thumbnail = $thumbnailName;
        }
        
        if ($request->published == 1) {
            $video->published = 1;
        } else {
            $video->published = 0;
        }

        $video->category_id = $request->video_category;
        /*
        Dacă utilizatorul are rolul de user în coloana user_id din tabela videos 
        se va completa cu id-ul utilizatorului curent autentificat:
        */
        if (auth()->user()->role == 'user') {
            $video->user_id = auth()->id();
        }
        $video->channel_id = auth()->user()->channel->id;
        $video->save();

        return redirect(route('home'));
    }

    public function showVideosToHomePage() {
        $videos = Video::all();
        return view('front.home')->with('videos', $videos);
    }

    public function showCurrentVideo(Video $video) {
        $video->views++;
        $video->save();
        $videos = Video::where('slug', '!=', $video->slug)->where('published', 1)->inRandomOrder()->limit(5)->get();
        $videoURL = route('show-current-video', $video->slug);
        
        $history = new History();

        //Inserare unica pentru o combinație de valori:
        if (auth()->check()) {
            $history::firstOrCreate(['video_id' => $video->id, 'user_id' => auth()->user()->id]);
        }
        /*
        Această metodă firstOrCreat() va căuta în baza de date un înregistrare care să corespundă cu valorile din
         array-ul asociativ ['video_id' => $videoId, 'user_id' => $userId].
         Dacă găsește o înregistrare, va returna acea înregistrare, 
         altfel va crea o nouă înregistrare cu aceste valori și va salva în baza de date.
        Astfel, se va asigura că există o singură înregistrare pentru fiecare combinație unică de video_id și user_id.
        */
        return view('front.current-video')->with('video', $video)->with('videos', $videos)->with('videoURL', $videoURL);
    }
}
