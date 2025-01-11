<?php

use Illuminate\Support\Facades\Route;
use Nozom\LandingPagePackage\Controllers\LandingSettingController;
use Nozom\LandingPagePackage\Controllers\LandingPageController;
$middleware = config('landing_page.use_project_middleware', true) 
    ? ["web" ,"auth", "XSS", "super_admin"] 
    : [];
Route::middleware($middleware)->group(function () {
    Route::get('/landing-settings', [LandingSettingController::class, 'index'])->name('landing-settings.index');
    Route::get('/landing-settings/create', [LandingSettingController::class, 'create'])->name('landing-settings.create');
    Route::get('/landing-settings/sections/{id}/show', [LandingSettingController::class, 'showSection'])->name('landing-settings.section.show');
    Route::post('/landing-settings/store', [LandingSettingController::class, 'store'])->name('landing-settings.store');
    Route::post('/landing-settings/update-publish-status', [LandingSettingController::class, 'updatePublishStatus'])->name('landing-settings.update-publish-status');
    Route::post('landing-settings/update-order', [LandingSettingController::class, 'updateOrder'])->name('landing-settings.update-order');
    Route::post('/landing-settings/update-name', [LandingSettingController::class, 'updateName'])->name('landing-settings.update-name');
    Route::post('/landing-sections/update-ar-name', [LandingSettingController::class, 'updateArName'])->name('landing-settings.update-ar-name');
    
    
    Route::get('/landing-settings/sections/{id}/create-element', [LandingSettingController::class, 'createSectionElement'])->name('landing-settings.section.create-element');
    Route::post('/landing-settings/sections/{id}/store-element', [LandingSettingController::class, 'storeSectionElement'])->name('landing-settings.section.post-element');
    Route::get('/landing-settings/sections/{sectionID}/element/{elementID}/edit', [LandingSettingController::class, 'editSectionElement'])->name('landing-settings.section.edit-element');
    Route::post('/landing-settings/sections/{sectionID}/element/{elementID}/update', [LandingSettingController::class, 'updateSectionElement'])->name('landing-settings.section.update-element');
    
    Route::get('/landing-settings/create-element', [LandingSettingController::class, 'createElement'])->name('landing-settings.create-element');
    Route::post('/landing-settings/store-element', [LandingSettingController::class, 'storeElement'])->name('landing-settings.post-element');
    Route::get('/landing-settings/edit-element/{id}', [LandingSettingController::class, 'editElement'])->name('landing-settings.edit-element');
    Route::post('/landing-settings/update-name-element/{id}', [LandingSettingController::class, 'updateElement'])->name('landing-settings.update-name-element');
    Route::post('/landing-settings/store/dropzone-file', [LandingSettingController::class, 'storeFileLandingElement'])->name(name: 'landing-settings.store-dropzone-file');
    
});
Route::get("/landing-page",[LandingPageController::class,"index"])->name("landing");
Route::post("/landing-page", [LandingPageController::class, "store"])->name("landing.store");
