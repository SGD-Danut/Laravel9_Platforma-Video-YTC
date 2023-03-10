<div style="display: flex;">
  <div class="icon">
    <button type="button" wire:click="likeVideo()" class="fa fa-thumbs-up" style="color: white; cursor:pointer; font-size:16px;"></button>
    <label>{{ $currentVideo->likes->count() }}</label>
  </div>
  <div class="icon">
    <button type="button" wire:click="dislikeVideo()" class="fa fa-thumbs-down" style="color: white; cursor:pointer; font-size:16px;"></button>
    <label>DISLIKE {{ $currentVideo->dislikes->count() }}</label>
  </div>
  <div class="icon">
    <!-- Trigger/Open The Modal -->
    <button type="button" id="shareModalBtn" class="fa fa-share" style="color: white; cursor:pointer; font-size:16px;"></button>
    <label>SHARE</label>
  </div>
</div>
