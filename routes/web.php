<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\StoryController as AdminStoryController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\DashboardController;


Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::get('/story', function () {
    return view('story');
})->name('story');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

Route::get('/order', function () {
    return view('order');
})->name('order');

Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [AdminAuthController::class, 'login']);

Route::get('/visitus', [AboutController::class, 'index'])->name('visitus');
Route::get('/story', [StoryController::class, 'show'])->name('story');


Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/menu', [AdminMenuController::class, 'index'])->name('admin.menu.index');
    Route::view('/story', 'admin.story.index')->name('admin.story.index');

    // Gallery Routes
    Route::get('/gallery', [AdminGalleryController::class, 'index'])->name('admin.gallery.index');
    Route::post('/gallery', [AdminGalleryController::class, 'store'])->name('admin.gallery.store');
    Route::get('/gallery/{gallery}/edit', [AdminGalleryController::class, 'edit'])->name('admin.gallery.edit');
    Route::put('/gallery/{gallery}', [AdminGalleryController::class, 'update'])->name('admin.gallery.update');
    Route::delete('/gallery/{gallery}', [AdminGalleryController::class, 'destroy'])->name('admin.gallery.destroy');
    Route::post('/gallery/order', [AdminGalleryController::class, 'updateOrder'])->name('admin.gallery.updateOrder');
    Route::put('/gallery/settings', [AdminGalleryController::class, 'updateSettings'])->name('admin.gallery.settings.update');

    Route::view('/about', 'admin.about.index')->name('admin.about.index');
    Route::post('/menu/categories', [AdminMenuController::class, 'storeCategory'])->name('admin.menu.categories.store');
    Route::put('/menu/categories/{category}', [AdminMenuController::class, 'updateCategory'])->name('admin.menu.categories.update');
    Route::delete('/menu/categories/{category}', [AdminMenuController::class, 'destroyCategory'])->name('admin.menu.categories.destroy');
    Route::post('/menu/items', [AdminMenuController::class, 'storeItem'])->name('admin.menu.items.store');
    Route::put('/menu/items/{item}', [AdminMenuController::class, 'updateItem'])->name('admin.menu.items.update');
    Route::delete('/menu/items/{item}', [AdminMenuController::class, 'destroyItem'])->name('admin.menu.items.destroy');
    Route::post('/menu/title', [AdminMenuController::class, 'updateMenuTitle'])->name('admin.menu.title.update');
    Route::post('/admin/menu/cta', [AdminMenuController::class, 'updateCta'])->name('admin.menu.cta.update');
    Route::post('/admin/menu/hero', [AdminMenuController::class, 'updateHero'])->name('admin.menu.hero.update');
    Route::get('/admin/about', [AdminAboutController::class, 'index'])->name('admin.about.index');
    Route::post('/admin/about', [AdminAboutController::class, 'store'])->name('admin.about.store');

    Route::post('/admin/about/hero', [AdminAboutController::class, 'updateHero'])->name('admin.visitus.hero.update');

    Route::post('/admin/about/section', [AdminAboutController::class, 'updateAbout'])->name('admin.visitus.about.update');

    Route::post('/admin/about/visit', [AdminAboutController::class, 'updateVisit'])->name('admin.visitus.visit.update');
     Route::get('/story', [AdminStoryController::class, 'index'])->name('admin.story.index');
    Route::get('/story/edit', [AdminStoryController::class, 'edit'])->name('admin.story.edit');
    Route::post('/story/update', [AdminStoryController::class, 'update'])->name('admin.story.update');
    Route::post('/story/hero/update', [AdminStoryController::class, 'updateHero'])->name('admin.story.hero.update');
    Route::post('/story/journey/update', [App\Http\Controllers\Admin\StoryController::class, 'updateJourney'])->name('admin.story.journey.update');
    Route::post('/story/timeline/store', [App\Http\Controllers\Admin\StoryController::class, 'storeTimeline'])->name('admin.story.timeline.store');
    Route::delete('/story/timeline/{timeline}', [App\Http\Controllers\Admin\StoryController::class, 'destroyTimeline'])->name('admin.story.timeline.destroy');
    Route::put('/story/timeline/{timeline}', [App\Http\Controllers\Admin\StoryController::class, 'updateTimeline'])->name('admin.story.timeline.update');
    Route::post('/admin/story/mission/update', [\App\Http\Controllers\Admin\StoryController::class, 'updateMission'])->name('admin.story.mission.update');
    Route::post('/story/values/title/update', [\App\Http\Controllers\Admin\StoryController::class, 'updateValuesTitle'])->name('admin.story.values.title.update');
    Route::post('/story/values/store', [\App\Http\Controllers\Admin\StoryController::class, 'storeValue'])->name('admin.story.values.store');
    Route::delete('/story/values/{value}', [\App\Http\Controllers\Admin\StoryController::class, 'destroyValue'])->name('admin.story.values.destroy');
    Route::put('/story/values/{value}', [\App\Http\Controllers\Admin\StoryController::class, 'updateValue'])->name('admin.story.values.update');
    Route::post('/admin/story/team/title/update', [\App\Http\Controllers\Admin\StoryController::class, 'updateTeamTitle'])->name('admin.story.team.title.update');
    Route::post('/story/team/store', [\App\Http\Controllers\Admin\StoryController::class, 'storeTeam'])->name('admin.story.team.store');
    Route::post('/admin/story/cta/update', [\App\Http\Controllers\Admin\StoryController::class, 'updateCta'])->name('admin.story.cta.update');
    Route::post('/story/team/store', [\App\Http\Controllers\Admin\StoryController::class, 'storeTeam'])->name('admin.story.team.store');
    Route::put('/story/team/{teamMember}', [\App\Http\Controllers\Admin\StoryController::class, 'updateTeam'])->name('admin.story.team.update');
Route::delete('/story/team/{teamMember}', [\App\Http\Controllers\Admin\StoryController::class, 'destroyTeam'])->name('admin.story.team.destroy');
Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard.index');

Route::post('/hero/update', [\App\Http\Controllers\Admin\DashboardController::class, 'updateHero'])->name('admin.hero.update');
Route::post('/admin/why-us/update', [\App\Http\Controllers\Admin\DashboardController::class, 'updateWhyUs'])->name('admin.whyus.update');
    Route::post('/testimonials/update', [\App\Http\Controllers\Admin\DashboardController::class, 'updateTestimonials'])->name('admin.testimonials.update');

Route::post('/special-offer/update', [\App\Http\Controllers\Admin\DashboardController::class, 'updateSpecialOffer'])->name('admin.special-offer.update');

Route::post('/tea/update', [\App\Http\Controllers\Admin\DashboardController::class, 'updateTea'])->name('admin.tea.update');
Route::post('/additional-sections/update', [\App\Http\Controllers\Admin\DashboardController::class, 'updateAdditionalSections'])->name('admin.additional-sections.update');

});
