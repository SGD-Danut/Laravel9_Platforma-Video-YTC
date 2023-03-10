<div>
    <!--        video comment            -->
    <div class="comment">
        <div class="comment-heading flex">
          <h4>{{ $comments->count() }} Comments</h4>
          <h4> <i class="fa fa-list-ul"></i> <label>SORT BY</label> </h4>
        </div>
      </div>

      <!--        video comment  by self           -->
      <div class="details comment_self flex">
        <div class="img">
            @if (auth()->check())
              @if (auth()->user()->channel_id != null)
                  <img src="\images\avatars\{{ auth()->user()->channel->avatar }}" alt="" class="avatar-image">
              @endif
            @else
                <img src="\images\avatars\default-avatar.png" alt="" class="avatar-image">
            @endif
        </div>
        <div class="heading">
            @if (auth()->check())
            <form id="addCommentForm" wire:submit.prevent="addComment">
                <input type="text" wire:model="comment_content" placeholder="Add a comment....">
                @error('comment_content') <span style="color: red">{{ $message }}</span> @enderror
                @if (session()->has('addCommentSuccessMessage'))
                    <h5 style="color: red">{{ session('addCommentSuccessMessage') }}</h5>
                @endif
                @if (session()->has('addCommentErrorMessage'))
                    <h5 style="color: red">{{ session('addCommentErrorMessage') }}</h5>
                @endif
            </form>
            @else
                <h6 style="font-size: 14px;font-family: inherit;"><a href="{{ route('login') }}" style="color: royalblue">Autentifică-te</a> pentru a putea să postezi un comentariu.</h6>
            @endif
            
        </div>
      </div>
      <!--        video comment  by other           -->
      @foreach ($comments as $comment)
      <div class="details_Comment">
        <div class="details flex">
          <div class="img">
            <img src="\images\avatars\{{ $comment->channel->avatar }}" class="avatar-image" />
          </div>
          <div class="heading">
            <h4>{{ $comment->channel->title }} <span>{{ $comment->created_at->diffForHumans() }}</span> </h4>
            <p> {{ $comment->comment_content }}</p>
            <div class="comment-like flex">
              <div class="icon">
                <a wire:click.prevent="replyToSpecificComment({{ $comment->id }})">
                    <label>REPLY</label>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
        @if ($clickedCommentId == $comment->id)
            <!--        video comment  by other           -->
            <div class="replay" id="reply-section">
                <div class="details comment_self flex">
                    <div class="img">
                        @if (auth()->check())
                            <img src="\images\avatars\{{ auth()->user()->channel->avatar }}" alt="" class="avatar-image">
                        @else
                            <img src="\images\avatars\default-avatar.png" alt="" class="avatar-image">
                        @endif
                    </div>
                    <div class="heading">
                        @if (auth()->check())
                        <form id="addReplyToCommentForm" wire:submit.prevent="addReplyToComment">
                            <input type="text" wire:model="reply_content" placeholder="Add a reply....">
                            @error('reply_content') <span style="color: red">{{ $message }}</span> @enderror
                            @if (session()->has('addReplyToCommentSuccessMessage'))
                                <h5 style="color: red">{{ session('addReplyToCommentSuccessMessage') }}</h5>
                            @endif
                            @if (session()->has('addReplyToCommentErrorMessage'))
                                <h5 style="color: red">{{ session('addReplyToCommentErrorMessage') }}</h5>
                            @endif
                        </form>
                        @else
                            <h6 style="font-size: 12px;font-family: inherit;"><a href="{{ route('login') }}" style="color: royalblue">Autentifică-te</a> pentru a putea să postezi un răspuns.</h6>
                        @endif
                    </div>
                  </div>
            </div>
        @endif
        @foreach ($comment->replies as $reply)
        <div class="replay">   
            <div class="details_Comment">
                <div class="details flex">
                <div class="img">
                    <img src="\images\avatars\{{ $reply->channel->avatar }}" class="avatar-image" />
                </div>
                <div class="heading">
                    <h4>{{ $reply->channel->title }} <span>{{ $reply->created_at->diffForHumans() }}</span> </h4>
                    <p> {{ $reply->reply_content }}</p>
                    <div class="comment-like flex">
                    </div>
                </div>
                </div>
            </div>
        </div>
        @endforeach

      @endforeach
      @if ($comments->count() < $allCommetsOfCurrentVideo->count())
          <button class="loadMoreCommentsButton" wire:click.prevent="loadMoreComments">Load more</button>
      @endif
</div>