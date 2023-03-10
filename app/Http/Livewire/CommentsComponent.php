<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Reply;
use Livewire\Component;

class CommentsComponent extends Component
{
    public $video;
    public $video_id, $user_id, $channel_id, $comment_content;
    public $reply_content;
    public $comments;
    public $clickedCommentId;
    public $comment_id;

    public $numberOfShownComments = 4;
    public $totalNumberOfComments;
    public $allCommetsOfCurrentVideo;

    protected function rules()
    {
        if ($this->clickedCommentId != null) {
            return [
                'comment_id' => 'required',
                'user_id' => 'required',
                'channel_id' => 'required',
                'reply_content' => 'required|string|min:6'
            ];
        }
        return [
            'video_id' => 'required',
            'user_id' => 'required',
            'channel_id' => 'required',
            'comment_content' => 'required|string|min:6',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function addComment() {
        if (auth()->check()) {
            $this->video_id = $this->video->id;
            $this->user_id = auth()->user()->id;
            if (auth()->user()->channel_id !== null) {
                $this->channel_id = auth()->user()->channel->id;
            } else {
                return redirect(route('show-new-channel-form'));
            }

            $this->validate();

            $insertedData = Comment::create([
                'video_id' => $this->video_id,
                'user_id' => $this->user_id,
                'channel_id' => $this->channel_id,
                'comment_content' => $this->comment_content,
            ]);
            
            if ($insertedData) {
                session()->flash('addCommentSuccessMessage', "Comentariul a fost adăugat cu succes!");
                $this->resetInputs();
            } else {
                session()->flash('addCommentErrorMessage', "Ceva nu a mers bine!");
            }
        }
    }

    public function resetInputs() {
        $this->comment_content = '';
        $this->reply_content = '';
    }

    public function replyToSpecificComment($clickedCommentIdFromBlade)
    {
        $this->clickedCommentId = $clickedCommentIdFromBlade;
    }

    public function addReplyToComment() {
        if (auth()->check()) {
            $this->comment_id = $this->clickedCommentId;
            $this->user_id = auth()->user()->id;
            $this->channel_id = auth()->user()->channel->id;

            $this->validate();
            
            $insertedData = Reply::create([
                'comment_id' => $this->comment_id,
                'user_id' => $this->user_id,
                'channel_id' => $this->channel_id,
                'reply_content' => $this->reply_content,
            ]);
            
            if ($insertedData) {
                session()->flash('addReplyToCommentSuccessMessage', "Răspunsul a fost adăugat cu succes!");
                $this->resetInputs();
                $this->clickedCommentId = null;
            } else {
                session()->flash('addReplyToCommentErrorMessage', "Ceva nu a mers bine!");
            }
        }
    }

    public function loadMoreComments() {
        // Verificăm daca mai există comentarii de încărcat
        if ($this->numberOfShownComments < $this->totalNumberOfComments) {
            // Creștem numărul de comentarii afișate cu 4
            $this->numberOfShownComments += 4;
            // Actualizăm variabila $comments pentru a afișa comentariile noi
            $newComments = Comment::where('video_id', $this->video->id)->orderBy('created_at', 'desc')
                ->skip($this->numberOfShownComments)
                ->take(4)
                ->get();
            $this->comments = $this->comments->concat($newComments);
        }
    }

    public function render()
    {
        $this->allCommetsOfCurrentVideo = Comment::where('video_id', $this->video->id)->orderBy('created_at', 'desc')->get();
        // Afișăm numărul de comentarii specificat:
        $this->comments = Comment::where('video_id', $this->video->id)->orderBy('created_at', 'desc')
            ->take($this->numberOfShownComments)
            ->get();
        // Afișăm numărul total de comentarii:
        $this->totalNumberOfComments = Comment::count();
        return view('livewire.comments-component', [$this->comments, $this->clickedCommentId, $this->allCommetsOfCurrentVideo]);
    }
}
