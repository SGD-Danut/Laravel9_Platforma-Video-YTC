<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Front\ChannelController;
use App\Http\Controllers\Front\HistoryController;
use App\Http\Controllers\Front\PlaylistController;
use App\Http\Controllers\Front\VideoController;
use App\Models\Playlist;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Rute pentru partea de Administrare:
Route::get('/admin', function () {
    return view('admin/admin');
})->middleware(['auth', 'verified'])->name('admin');
Route::get('/admin/new-category', [CategoryController::class, 'showNewCategoryForm'])->name('show-new-category-form');
Route::post('/admin/create-new-category', [CategoryController::class, 'createNewCategory'])->name('create-new-category');
Route::get('/admin/show-categories', [CategoryController::class, 'showCategories'])->name('show-categories');

//Rute pentru partea de Front-End:

//Rute pentru încărcare și afișare video:
Route::get('/new-video', [VideoController::class, 'showNewVideoForm'])->middleware('auth', 'verified')->name('show-new-video-form');
Route::post('/add-video', [VideoController::class, 'addNewVideo'])->middleware('auth', 'verified')->name('add-new-video');
Route::get('/', [VideoController::class, 'showVideosToHomePage'])->name('home');
Route::get('/current-video/{video:slug}', [VideoController::class, 'showCurrentVideo'])->name('show-current-video');

//Rute pentru canalul cu videoclipuri al utilizatorului:
Route::get('/new-channel', [ChannelController::class, 'showNewChannelForm'])->middleware('auth', 'verified')->name('show-new-channel-form');
Route::post('/create-channel', [ChannelController::class, 'createChannel'])->middleware('auth', 'verified')->name('create-new-channel');
Route::get('/current-channel/{channel:slug}', [ChannelController::class, 'showChannelPage'])->name('show-current-channel');
Route::get('/current-channel/{channel:slug}/home', [ChannelController::class, 'showChannelHome'])->name('show-channel-home');
Route::get('/current-channel/{channel:slug}/videos', [ChannelController::class, 'showChannelVideos'])->name('show-channel-videos');
Route::get('/current-channel/{channel:slug}/about', [ChannelController::class, 'showChannelDetails'])->name('show-channel-details');

//Rute pentru editarea detaliilor canalului cu videoclipuri al utilizatorului:
Route::get('/channel-customization', [ChannelController::class, 'showChannelCustomizationPage'])->middleware('auth', 'verified')->name('customize-channel');
Route::get('/channel-customization/branding', [ChannelController::class, 'showChannelCustomizationPageForBranding'])->middleware('auth', 'verified')->name('customize-channel-branding');
Route::put('/channel-customization/branding/update', [ChannelController::class, 'updateChannelBranding'])->middleware('auth', 'verified')->name('update-channel-branding');
Route::get('/channel-customization/details', [ChannelController::class, 'showChannelCustomizationPageForDetails'])->middleware('auth', 'verified')->name('customize-channel-details');
Route::put('/channel-customization/details/update', [ChannelController::class, 'updateChannelDetails'])->middleware('auth', 'verified')->name('update-channel-details');
Route::get('/channel-customization/layout', [ChannelController::class, 'showChannelCustomizationPageForLayout'])->middleware('auth', 'verified')->name('customize-channel-layout');
Route::put('/channel-customization/layout/update', [ChannelController::class, 'updateChannelLayout'])->middleware('auth', 'verified')->name('update-channel-layout');

//Rute pentru partea de gestionare a videoclipurilor de pe canal, de către utilizatorul curent:
Route::get('/channel-content', [ChannelController::class, 'showChannelContentPage'])->middleware('auth', 'verified')->name('channel-content');
Route::get('/channel-content/videos', [ChannelController::class, 'showChannelContentPageForVideos'])->middleware('auth', 'verified')->name('channel-content-videos');
Route::get('/channel-content/playlists', [ChannelController::class, 'showChannelContentPageForPlaylists'])->middleware('auth', 'verified')->name('channel-content-playlists');

//Rute pentru Playlist
Route::get('/current-playlist/{playlist:slug?}/{video:slug?}', [PlaylistController::class, 'showCurrentPlaylist'])->name('show-current-playlist');

//Rute pentru Istoricul videoclipurilor:
Route::get('/history', [HistoryController::class, 'showVideoHistory'])->middleware('auth', 'verified')->name('history');
Route::delete('/history-delete-video/{historyId}', [HistoryController::class, 'deleteVideoFromHistory'])->middleware('auth', 'verified')->name('delete-video-from-history');

require __DIR__.'/auth.php';
