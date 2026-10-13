<?php


// Login and Logout

use Illuminate\Support\Facades\Route;
use Bitfumes\Multiauth\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Bitfumes\Multiauth\Http\Controllers\AdminController;
use Bitfumes\Multiauth\Http\Controllers\RegisterController;
use Bitfumes\Multiauth\Http\Controllers\AdminRoleController;
use App\Http\Controllers\Admin\PermissionController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Password Resets
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
Route::post('/password/reset', [ResetPasswordController::class, 'reset']);
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');

// Register Admins
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/{admin}/edit', [RegisterController::class, 'edit'])->name('admin.edit');
Route::delete('/{admin}', [RegisterController::class, 'destroy'])->name('admin.delete');
Route::patch('/{admin}', [RegisterController::class, 'update'])->name('admin.update');

// Admin Lists
Route::get('/show', [AdminController::class, 'show'])->name('admin.show');




// Admin Roles
Route::post('/{admin}/role/{role}', [AdminRoleController::class, 'attach'])->name('admin.attach.roles');
Route::delete('/{admin}/role/{role}', [AdminRoleController::class, 'detach']);



// active status
// Route::post('activation/{admin}', 'ActivationController@activate')->name('admin.activation');
// Route::delete('activation/{admin}', 'ActivationController@deactivate');
Route::resource('permission', PermissionController::class)->only(['index', 'store', 'destroy']);

Route::fallback(function () {
    return abort(404);
});


Route::group(['middleware' => 'auth:admin', 'namespace' => '\App\Http\Controllers'], function () {
    Route::GET('/home', 'Admin\HomeController@index')->name('admin.home');
    //Profile
    Route::get('/profile', 'Admin\ProfileController@show')->name('admin.profile');
    Route::post('/profile', 'Admin\ProfileController@store')->name('admin.profile.store');

    // Roles
    Route::get('/roles', 'Admin\RoleController@index')->name('admin.roles.index');
    Route::get('/role/create', 'Admin\RoleController@create')->name('admin.roles.create');
    Route::post('/role/store', 'Admin\RoleController@store')->name('admin.roles.store');
    Route::delete('/role/{role}', 'Admin\RoleController@destroy')->name('admin.roles.destroy');
    Route::get('/role/{role}/edit', 'Admin\RoleController@edit')->name('admin.roles.edit');
    Route::post('/role/update{role}', 'Admin\RoleController@update')->name('admin.roles.update');
    //Permissions
    Route::get('permissions', 'Admin\PermissionController@index')->name('admin.permissions.index');
    Route::post('permissions/store', 'Admin\PermissionController@store')->name('admin.permissions.store');
    Route::delete('permissions/destroy/{id}', 'Admin\PermissionController@destroy')->name('admin.permissions.destroy');

    //Settings
    Route::get('/settings', 'Admin\SettingsController@index')->name('admin.settings.index');
    Route::post('/settings', 'Admin\SettingsController@store')->name('admin.settings.store');

    // General Settings
    Route::get('/general-settings', 'Admin\SettingsController@general')->name('admin.settings.general');
    Route::post('/general-settings', 'Admin\SettingsController@store_general')->name('admin.settings.general_store');

    // Homepage Settings
    Route::get('/home-settings', 'Admin\SettingsController@home')->name('admin.settings.home');
    Route::post('/home-settings', 'Admin\SettingsController@store_home')->name('admin.settings.home_store');

    //Address settings
    Route::get('/address-settings', 'Admin\AddressController@index')->name('admin.address.index');
    Route::post('/address-settings', 'Admin\AddressController@store')->name('admin.address.store');
    Route::delete('/address/{id}', 'Admin\AddressController@destroy')->name('admin.address.destroy');
    Route::get('/address/{id}/edit', 'Admin\AddressController@edit')->name('admin.address.edit');
    Route::post('/address/{id}/update', 'Admin\AddressController@update')->name('admin.address.update');

    //contact settings
    Route::get('/contact-settings', 'Admin\ContactController@index')->name('admin.contact.index');
    Route::post('/contact-settings', 'Admin\ContactController@store')->name('admin.contact.store');
    Route::delete('/contact/{id}', 'Admin\ContactController@destroy')->name('admin.contact.destroy');
    Route::get('/contact/{id}/edit', 'Admin\ContactController@edit')->name('admin.contact.edit');
    Route::post('/contact/{id}/update', 'Admin\ContactController@update')->name('admin.contact.update');

    //Home Section
    Route::resource('sections', 'Admin\SectionController', ['as' => 'admin'])->except(['show']);

    //Features
    Route::resource('features', 'Admin\FeatureController', ['as' => 'admin'])->except([
        'create'
    ]);
    //Specifications
    Route::resource('specifications', 'Admin\SpecificationController', ['as' => 'admin'])->except([
        'create'
    ]);
    //Fuels
    Route::resource('fuels', 'Admin\FuelController', ['as' => 'admin'])->except([
        'create'
    ]);



    //Emissions
    Route::resource('emissions', 'Admin\EmissionController', ['as' => 'admin'])->except([
        'create'
    ]);
    //Conditions
    Route::resource('conditions', 'Admin\ConditionController', ['as' => 'admin'])->except([
        'create'
    ]);
    //Transmissions
    Route::resource('transmissions', 'Admin\TransmissionController', ['as' => 'admin'])->except([
        'create'
    ]);
    //Announcements
    Route::resource('announcements', 'Admin\AnnouncementController', ['as' => 'admin'])->except([
        'create'
    ]);
    //Location Types
    Route::resource('location_types', 'Admin\LocationTypeController', ['as' => 'admin'])->except([
        'create'
    ]);

    //Location Content
    Route::resource('location_content', 'Admin\LocationContentController', ['as' => 'admin'])->only(['index', 'store']);

    //Location Content
    Route::resource('marketing', 'Admin\MarketingController', ['as' => 'admin'])->except(['show']);

    //Brochure
    Route::resource('brochures', 'Admin\BrochureController', ['as' => 'admin'])->only(['index', 'store']);

    //Offers
    Route::resource('offers', 'Admin\OfferController', ['as' => 'admin'])->only(['index', 'store']);

    //Offer details
    Route::resource('offer_details', 'Admin\OfferDetailsController', ['as' => 'admin']);

    //Service Product Content
    Route::resource('service_product_content', 'Admin\ServiceProductContentController', ['as' => 'admin'])->only(['index', 'store']);



    //Additional page
    // Route::resource('add_page', 'Admin\AddPageController', ['as' => 'admin']);

    // Services
    Route::resource('services', 'Admin\ServiceController', ['as' => 'admin']);

    //service content
    // Route::resource('service_content', 'Admin\ServiceContentController', ['as' => 'admin']);



    //Book Service Online page
    Route::resource('book-a-service', 'Admin\BookServiceOnlineController', ['as' => 'admin'])->only(['index', 'store']);

    //Location Types
    Route::resource('service_types', 'Admin\ServiceTypeController', ['as' => 'admin'])->except([
        'create'
    ]);
    //Service Products
    Route::resource('service_products', 'Admin\ServiceProductController', ['as' => 'admin'])->except([
        'create'
    ]);
    //vehicles
    Route::resource('vehicles', 'Admin\VehicleController', ['as' => 'admin']);
    Route::get('vehicles/{vehicle}/colors', 'Admin\VehicleColorController@index')->name('admin.vehicles.colors.index');
    Route::post('vehicles/{vehicle}/colors', 'Admin\VehicleColorController@store')->name('admin.vehicles.colors.store');
    Route::get('vehicles/{vehicle}/colors/{vehicleColor}', 'Admin\VehicleColorController@edit')->name('admin.vehicles.colors.edit');
    Route::put('vehicles/{vehicle}/colors/{vehicleColor}', 'Admin\VehicleColorController@update')->name('admin.vehicles.colors.update');
    Route::delete('vehicles/{vehicle}/colors/{vehicleColor}', 'Admin\VehicleColorController@destroy')->name('admin.vehicles.colors.destroy');

    // fetch vehicles
    Route::post('vehicles/fetch_vehicle', 'Admin\VehicleController@fetch_vehicle')->name('admin.vehicles.fetchvehicle');

    // Vehicle Gallery
    Route::get('vehicles/{vehicle}/gallery', 'Admin\VehicleGalleryController@index')->name('admin.vehicles.gallery.index');
    Route::post('vehicles/{vehicle}/gallery', 'Admin\VehicleGalleryController@store')->name('admin.vehicles.gallery.store');
    Route::post('vehicles/{vehicle}/gallery/image', 'Admin\VehicleGalleryController@image_name')->name('admin.vehicles.gallery.imagename');
    Route::delete('vehicles/{vehicle}/gallery/{image}', 'Admin\VehicleGalleryController@destroy')->name('admin.vehicles.gallery.destroy');


    Route::get('vehicles/{vehicle}/varients', 'Admin\VehicleVarientController@index')->name('admin.vehicles.varients.index');
    Route::post('vehicles/{vehicle}/varients', 'Admin\VehicleVarientController@store')->name('admin.vehicles.varients.store');
    Route::get('vehicles/{vehicle}/varients/{vehicleVarient}', 'Admin\VehicleVarientController@edit')->name('admin.vehicles.varients.edit');
    Route::put('vehicles/{vehicle}/varients/{vehicleVarient}', 'Admin\VehicleVarientController@update')->name('admin.vehicles.varients.update');
    Route::delete('vehicles/{vehicle}/varients/{vehicleVarient}', 'Admin\VehicleVarientController@destroy')->name('admin.vehicles.varients.destroy');

    Route::get('vehicles/{vehicle}/sections', 'Admin\VehicleSectionController@index')->name('admin.vehicles.sections.index');
    Route::get('vehicles/{vehicle}/sections/create', 'Admin\VehicleSectionController@create')->name('admin.vehicles.sections.create');
    Route::post('vehicles/{vehicle}/sections/create', 'Admin\VehicleSectionController@store')->name('admin.vehicles.sections.store');
    Route::get('/vehicles/{vehicle}/sections/{vehicleSection}/edit', 'Admin\VehicleSectionController@edit')->name('admin.vehicles.sections.edit');
    Route::put('/vehicles/{vehicle}/sections/{vehicleSection}', 'Admin\VehicleSectionController@update')->name('admin.vehicles.sections.update');
    Route::delete('/vehicles/{vehicle}/sections/{vehicleSection}', 'Admin\VehicleSectionController@destroy')->name('admin.vehicles.sections.destroy');

    Route::get('vehicles/{vehicle}/sections/{vehicleSection}', 'Admin\VehicleSectionImageController@index')->name('admin.vehicles.sections.images.index');
    Route::post('vehicles/{vehicle}/sections/{vehicleSection}', 'Admin\VehicleSectionImageController@store')->name('admin.vehicles.sections.images.store');
    Route::get('vehicles/{vehicle}/sections/{vehicleSection}/image/{vehicleSectionImage}/edit', 'Admin\VehicleSectionImageController@edit')->name('admin.vehicles.sections.images.edit');
    Route::put('vehicles/{vehicle}/sections/{vehicleSection}/image/{vehicleSectionImage}', 'Admin\VehicleSectionImageController@update')->name('admin.vehicles.sections.images.update');
    Route::delete('vehicles/{vehicle}/sections/{vehicleSection}/image/{vehicleSectionImage}', 'Admin\VehicleSectionImageController@destroy')->name('admin.vehicles.sections.images.destroy');

    // vehicle features
    Route::get('vehicles/{vehicle}/features', 'Admin\VehicleFeatureController@index')->name('admin.vehicles.features.index');
    Route::post('vehicles/{vehicle}/features', 'Admin\VehicleFeatureController@store')->name('admin.vehicles.features.store');
    Route::get('vehicles/{vehicle}/features/{id}/edit', 'Admin\VehicleFeatureController@edit')->name('admin.vehicles.features.edit');
    Route::delete('vehicles/{vehicle}/features/{id}/destroy', 'Admin\VehicleFeatureController@destroy')->name('admin.vehicles.features.destroy');
    Route::get('vehicles/features_image/{id}/destroy_image', 'Admin\VehicleFeatureController@destroy_image')->name('admin.vehicles.features_image.destroy');
    Route::post('vehicles/{vehicle}/features{id}/update', 'Admin\VehicleFeatureController@update')->name('admin.vehicles.features.update');

    // Blogs
    Route::get('blogs/index', 'Admin\BlogController@index')->name('admin.blogs.index');
    Route::post('blogs/store', 'Admin\BlogController@store')->name('admin.blogs.store');
    Route::get('blogs/{id}/edit', 'Admin\BlogController@edit')->name('admin.blogs.edit');
    Route::delete('blogs/{id}/destroy', 'Admin\BlogController@destroy')->name('admin.blogs.destroy');
    Route::post('blogs/update/{id}', 'Admin\BlogController@update')->name('admin.blogs.update');


    // Blogs
    Route::get('faq/index', 'Admin\FaqController@index')->name('admin.faq.index');
    Route::post('faq/store', 'Admin\FaqController@store')->name('admin.faq.store');
    Route::get('faq/{id}/edit', 'Admin\FaqController@edit')->name('admin.faq.edit');
    Route::delete('faq/{id}/destroy', 'Admin\FaqController@destroy')->name('admin.faq.destroy');
    Route::post('faq/update/{id}', 'Admin\FaqController@update')->name('admin.faq.update');



    // Gallery
    Route::get('gallery/create',  'Admin\GalleryController@create')->name('admin.gallery.create');
    Route::post('gallery/store',  'Admin\GalleryController@store')->name('admin.gallery.store');
    Route::get('gallery/image-delete',  'Admin\GalleryController@image_delete')->name('admin.gallery.image_delete');




    Route::get('vehicles/{vehicle}/specifications', 'Admin\VehicleSpecificationController@index')->name('admin.vehicles.specifications.index');
    Route::post('vehicles/{vehicle}/specifications', 'Admin\VehicleSpecificationController@store')->name('admin.vehicles.specifications.store');

    Route::get('vehicles/{vehicle}/seo', 'Admin\VehicleSeoController@index')->name('admin.vehicles.seo.index');
    Route::post('vehicles/{vehicle}/seo', 'Admin\VehicleSeoController@store')->name('admin.vehicles.seo.store');

    // Details for comparison
    Route::get('vehicles/{vehicle}/details', 'Admin\VehicleDetailsController@index')->name('admin.vehicles.details.index');
    Route::post('vehicles/{vehicle}/details', 'Admin\VehicleDetailsController@store')->name('admin.vehicles.details.store');

    // Content for SEO - 11/07/2022
    Route::get('vehicles/{vehicle}/content', 'Admin\VehicleContentController@index')->name('admin.vehicles.content.index');
    Route::get('vehicles/{vehicle}/content/create', 'Admin\VehicleContentController@create')->name('admin.vehicles.content.create');
    Route::post('vehicles/{vehicle}/content/create', 'Admin\VehicleContentController@store')->name('admin.vehicles.content.store');
    Route::get('/vehicles/{vehicle}/content/{vehicleContent}/edit', 'Admin\VehicleContentController@edit')->name('admin.vehicles.content.edit');
    Route::put('/vehicles/{vehicle}/content/{vehicleContent}', 'Admin\VehicleContentController@update')->name('admin.vehicles.content.update');
    Route::delete('/vehicles/{vehicle}/content/{vehicleContent}', 'Admin\VehicleContentController@destroy')->name('admin.vehicles.content.destroy');

    Route::get('vehicles/{vehicle}/faq', 'Admin\VehicleFaqController@index')->name('admin.vehicles.faq.index');
    Route::get('vehicles/{vehicle}/faq/create', 'Admin\VehicleFaqController@create')->name('admin.vehicles.faq.create');
    Route::post('vehicles/{vehicle}/faq/create', 'Admin\VehicleFaqController@store')->name('admin.vehicles.faq.store');
    Route::get('/vehicles/{vehicle}/faq/{vehiclefaq}/edit', 'Admin\VehicleFaqController@edit')->name('admin.vehicles.faq.edit');
    Route::put('/vehicles/{vehicle}/faq/{vehiclefaq}', 'Admin\VehicleFaqController@update')->name('admin.vehicles.faq.update');
    Route::delete('/vehicles/{vehicle}/faq/{vehiclefaq}', 'Admin\VehicleFaqController@destroy')->name('admin.vehicles.faq.destroy');


    // editions
    Route::get('vehicles/{vehicle}/editions', 'Admin\VehicleEditionController@index')->name('admin.vehicles.editions.index');
    Route::get('vehicles/{vehicle}/editions/create', 'Admin\VehicleEditionController@create')->name('admin.vehicles.editions.create');
    Route::post('vehicles/{vehicle}/editions/store', 'Admin\VehicleEditionController@store')->name('admin.vehicles.editions.store');
    Route::get('/vehicles/{vehicle}/editions/{vehicle_editions}/edit', 'Admin\VehicleEditionController@edit')->name('admin.vehicles.editions.edit');
    Route::put('/vehicles/{vehicle}/editions/{vehicle_editions}', 'Admin\VehicleEditionController@update')->name('admin.vehicles.editions.update');
    Route::delete('/vehicles/{vehicle}/editions/{vehicle_editions}', 'Admin\VehicleEditionController@destroy')->name('admin.vehicles.editions.destroy');

    // edition section
    Route::get('vehicles/{vehicle}/editions/{editon_id}/section', 'Admin\VehicleEditionSectionController@index')->name('admin.vehicles.editions.sections.index');
    Route::get('vehicles/{edition}/editions/section/create', 'Admin\VehicleEditionSectionController@create')->name('admin.vehicles.editions.sections.create');
    Route::post('vehicles/{edition}/editions/section/store', 'Admin\VehicleEditionSectionController@store')->name('admin.vehicles.editions.sections.store');
    Route::get('/vehicles/{edition}/editions/{vehicle_section}/section/edit', 'Admin\VehicleEditionSectionController@edit')->name('admin.vehicles.editions.sections.edit');
    Route::put('/vehicles/{edition}/editions/section/{vehicle_section}', 'Admin\VehicleEditionSectionController@update')->name('admin.vehicles.editions.sections.update');
    Route::delete('/vehicles/{edition}/editions/section/{vehicle_section}', 'Admin\VehicleEditionSectionController@destroy')->name('admin.vehicles.editions.sections.destroy');

    // edition section images
    Route::get('vehicles/{edition_id}/editions/{section_id}/images', 'Admin\EditionSectionImagesController@index')->name('admin.vehicles.editions.sections.images.index');
    Route::post('vehicles/{section_id}/editions/images/store', 'Admin\EditionSectionImagesController@store')->name('admin.vehicles.editions.sections.images.store');
    Route::get('/vehicles/{section_id}/editions/{vehicle_images}/images/edit', 'Admin\EditionSectionImagesController@edit')->name('admin.vehicles.editions.sections.images.edit');
    Route::put('/vehicles/{section_id}/editions/images/{vehicle_images}', 'Admin\EditionSectionImagesController@update')->name('admin.vehicles.editions.sections.images.update');
    Route::delete('/vehicles/{section_id}/editions/images/{vehicle_images}', 'Admin\EditionSectionImagesController@destroy')->name('admin.vehicles.editions.sections.images.destroy');


    //Locations
    Route::resource('locations', 'Admin\LocationController', ['as' => 'admin']);
    //Careers
    Route::resource('careers', 'Admin\CareerController', ['as' => 'admin']);
    //Contact Page
    Route::get('contact-page', 'Admin\ContactPageController@index')->name('admin.contact-page.index');
    Route::post('contact-page', 'Admin\ContactPageController@store')->name('admin.contact-page.store');

    //About Page
    Route::get('about-page', 'Admin\AboutPageController@index')->name('admin.about-page.index');
    Route::post('about-page', 'Admin\AboutPageController@store')->name('admin.about-page.store');
    Route::get('about-page/edit/{id}', 'Admin\AboutPageController@edit')->name('admin.about-page.edit');
    Route::post('about-page/update/{id}', 'Admin\AboutPageController@update')->name('admin.about-page.update');
    Route::delete('about-page/{id}/destroy', 'Admin\AboutPageController@destroy')->name('admin.about-page.destroy');

    //About Page
    Route::get('about-location', 'Admin\AboutLocationController@index')->name('admin.about-location.index');
    Route::post('about-location', 'Admin\AboutLocationController@store')->name('admin.about-location.store');
    Route::get('about-location/edit/{id}', 'Admin\AboutLocationController@edit')->name('admin.about-location.edit');
    Route::post('about-location/update/{id}', 'Admin\AboutLocationController@update')->name('admin.about-location.update');
    Route::delete('about-location/{id}/destroy', 'Admin\AboutLocationController@destroy')->name('admin.about-location.destroy');

    //About Group Page
    Route::get('about-group', 'Admin\AboutGroupController@index')->name('admin.about-group.index');
    Route::post('about-group', 'Admin\AboutGroupController@store')->name('admin.about-group.store');

    //About Group Page
    Route::get('about-motors', 'Admin\AboutMotorsController@index')->name('admin.about-motors.index');
    Route::post('about-motors', 'Admin\AboutMotorsController@store')->name('admin.about-motors.store');

    // Leadership
    Route::get('about-group-leaders/index', 'Admin\AboutLeaderController@index')->name('admin.about-group-leaders.index');
    Route::post('about-group-leaders/store', 'Admin\AboutLeaderController@store')->name('admin.about-group-leaders.store');
    Route::get('about-group-leaders/{id}/edit', 'Admin\AboutLeaderController@edit')->name('admin.about-group-leaders.edit');
    Route::delete('about-group-leaders/{id}/destroy', 'Admin\AboutLeaderController@destroy')->name('admin.about-group-leaders.destroy');
    Route::post('about-group-leaders/update/{id}', 'Admin\AboutLeaderController@update')->name('admin.about-group-leaders.update');

    //Counter Settings
    Route::get('counter-settings', 'Admin\CounterController@index')->name('admin.counter-settings.index');
    Route::post('counter-settings', 'Admin\CounterController@store')->name('admin.counter-settings.store');


    // Counter Settings List
    Route::get('counter-settings-list/index', 'Admin\CounterListController@index')->name('admin.counter-settings-list.index');
    Route::post('counter-settings-list/store', 'Admin\CounterListController@store')->name('admin.counter-settings-list.store');
    Route::get('counter-settings-list/{id}/edit', 'Admin\CounterListController@edit')->name('admin.counter-settings-list.edit');
    Route::delete('counter-settings-list/{id}/destroy', 'Admin\CounterListController@destroy')->name('admin.counter-settings-list.destroy');
    Route::post('counter-settings-list/update/{id}', 'Admin\CounterListController@update')->name('admin.counter-settings-list.update');

    //Book Online Page
    Route::get('book-online', 'Admin\BookOnlineController@index')->name('admin.book-online.index');
    Route::post('book-online', 'Admin\BookOnlineController@store')->name('admin.book-online.store');

    //Test Drive Page
    Route::get('test-drive', 'Admin\TestDrivePageController@index')->name('admin.test-drive.index');
    Route::post('test-drive', 'Admin\TestDrivePageController@store')->name('admin.test-drive.store');

    //Board Committee Page
    Route::get('board-committees', 'Admin\BoardCommitteePageController@index')->name('admin.board-committees.index');
    Route::post('board-committees', 'Admin\BoardCommitteePageController@store')->name('admin.board-committees.store');

    //Vigil Mechanism Page
    Route::get('vigil-mechanism', 'Admin\VigilMechanismPageController@index')->name('admin.vigil-mechanism.index');
    Route::post('vigil-mechanism', 'Admin\VigilMechanismPageController@store')->name('admin.vigil-mechanism.store');

    //General Meeting Notice Page
    Route::get('general-meeting-notice', 'Admin\GeneralMeetingNoticePageController@index')->name('admin.general-meeting-notice.index');
    Route::post('general-meeting-notice', 'Admin\GeneralMeetingNoticePageController@store')->name('admin.general-meeting-notice.store');

    //Testimonial Page
    Route::get('testimonial-page', 'Admin\TestimonialPageController@index')->name('admin.testimonial-page.index');
    Route::post('testimonial-page', 'Admin\TestimonialPageController@store')->name('admin.testimonial-page.store');

    //Network Page
    Route::get('network', 'Admin\NetworkPageController@index')->name('admin.network.index');
    Route::post('network', 'Admin\NetworkPageController@store')->name('admin.network.store');

    // Main Network
    Route::get('network-main', 'Admin\NetworkAdminController@index')->name('admin.network_main.index');
    Route::post('network-main-store', 'Admin\NetworkAdminController@store')->name('admin.network_main.store');
    Route::get('network-main-edit/{id}', 'Admin\NetworkAdminController@edit')->name('admin.network_main.edit');
    Route::post('network-main-update/{id}', 'Admin\NetworkAdminController@update')->name('admin.network_main.update');
    Route::delete('network-main-delete/{id}/', 'Admin\NetworkAdminController@destroy')->name('admin.network_main.destroy');

    // Sub Network
    Route::get('network-sub', 'Admin\SubNetworkAdminController@index')->name('admin.network_sub.index');
    Route::post('network-sub-store', 'Admin\SubNetworkAdminController@store')->name('admin.network_sub.store');
    Route::get('network-sub-edit/{id}', 'Admin\SubNetworkAdminController@edit')->name('admin.network_sub.edit');
    Route::post('network-sub-update/{id}', 'Admin\SubNetworkAdminController@update')->name('admin.network_sub.update');
    Route::delete('network-sub-delete/{id}/', 'Admin\SubNetworkAdminController@destroy')->name('admin.network_sub.destroy');

    // Network Branches
    Route::get('network-branch', 'Admin\NetworkBranchesController@index')->name('admin.network_branch.index');
    Route::post('network-branch-store', 'Admin\NetworkBranchesController@store')->name('admin.network_branch.store');
    Route::get('network-branch-edit/{id}', 'Admin\NetworkBranchesController@edit')->name('admin.network_branch.edit');
    Route::post('network-branch-update/{id}', 'Admin\NetworkBranchesController@update')->name('admin.network_branch.update');
    Route::delete('network-branch-delete/{id}/', 'Admin\NetworkBranchesController@destroy')->name('admin.network_branch.destroy');
    Route::get('network-change', 'Admin\NetworkBranchesController@change')->name('admin.network_change');

    // Brands
    Route::get('brands', 'Admin\NetworkBranchesController@brands')->name('admin.brands.index');
    Route::post('brands', 'Admin\NetworkBranchesController@brands_store')->name('admin.brands.store');
    Route::delete('brand-delete/{id}/', 'Admin\NetworkBranchesController@brand_destroy')->name('admin.brand.destroy');



    // form export
    Route::get('form-export', 'Admin\FormExportController@index')->name('admin.form_export.index');
    Route::post('form-export-search', 'Admin\FormExportController@export_search')->name('admin.form_export_search');
    Route::post('form-export-data', 'Admin\FormExportController@export')->name('admin.form_export_data');

    //shareholder-grievance-redressal Page
    Route::get('shareholder-grievance-redressal', 'Admin\ShareholderPageController@index')->name('admin.shareholder-grievance-redressal.index');
    Route::post('shareholder-grievance-redressal', 'Admin\ShareholderPageController@store')->name('admin.shareholder-grievance-redressal.store');
    //Dealership Page
    Route::get('dealership-page', 'Admin\DealershipPageController@index')->name('admin.dealership-page.index');
    Route::post('dealership-page', 'Admin\DealershipPageController@store')->name('admin.dealership-page.store');
    //Refund Policy Page
    Route::get('refund-policy-page', 'Admin\RefundPolicyPageController@index')->name('admin.refund-policy-page.index');
    Route::post('refund-policy-page', 'Admin\RefundPolicyPageController@store')->name('admin.refund-policy-page.store');
    //Dealership
    Route::resource('area', 'Admin\DealershipController', ['as' => 'admin']);
    Route::get('dealership/{dealership}/e-outlets', 'Admin\EOutletController@index')->name('admin.dealership.e_outlet.index');
    Route::post('dealership/{dealership}/e-outlets', 'Admin\EOutletController@store')->name('admin.dealership.e_outlet.store');
    Route::get('dealership/{dealership}/e-outlets/{outletid}', 'Admin\EOutletController@edit')->name('admin.dealership.e_outlet.edit');
    Route::put('dealership/{dealership}/e-outlets/{outletid}', 'Admin\EOutletController@update')->name('admin.dealership.e_outlet.update');
    Route::delete('dealership/{dealership}/e-outlets/{outletid}', 'Admin\EOutletController@destroy')->name('admin.dealership.e_outlet.destroy');
    //terms Page
    Route::get('terms', 'Admin\TermsController@index')->name('admin.terms.index');
    Route::post('terms', 'Admin\TermsController@store')->name('admin.terms.store');
    //terms Page
    Route::get('privacy', 'Admin\PrivacyController@index')->name('admin.privacy.index');
    Route::post('privacy', 'Admin\PrivacyController@store')->name('admin.privacy.store');

    //Cookie Page
    Route::get('cookie', 'Admin\CookiePageController@index')->name('admin.cookies.index');
    Route::post('cookie', 'Admin\CookiePageController@store')->name('admin.cookies.store');

    //Home Slider
    Route::resource('home-slider', 'Admin\HomeSliderController', ['as' => 'admin']);
    //Home Vehicle Slider
    Route::resource('vehicle-slider', 'Admin\VehicleSliderController', ['as' => 'admin']);
    //Home Enquiries
    Route::get('home-enquiries', 'Admin\HomeEnquiryController@index')->name('admin.home-enquiries.index');
    Route::get('all-enquiries', 'Admin\HomeEnquiryController@all')->name('admin.home-enquiries.all');
    Route::get('contact-enquiries', 'Admin\HomeEnquiryController@contact')->name('admin.home-enquiries.contact');
    // Factory Visit Enquiries
    Route::get('factory-visit-enquiries', 'Admin\HomeEnquiryController@factoryVisits')
    ->middleware('auth:admin')
    ->name('admin.factory-visits.index');

    //Career Enquiries
    Route::get('career-enquiries', 'Admin\CareerEnquiryController@index')->name('admin.career-enquiries.index');
    Route::get('career-enquiries/{id}','Admin\CareerEnquiryController@show')->name('admin.career-enquiries.show');
    
    //Offer Enquiries
    Route::get('offer-enquiries', 'Admin\OfferEnquiryController@index')->name('admin.offer-enquiries.index');
    //Quick Enquiries
    Route::get('quick-enquiries', 'Admin\QuickEnquiryController@index')->name('admin.quick-enquiries.index');
    //Service Enquiries
    Route::get('service-enquiries', 'Admin\ServiceEnquiryController@index')->name('admin.service-enquiries.index');
    //Payment Enquiry
    Route::get('payment-enquiries', 'Admin\PaymentEnquiryController@index')->name('admin.payment-enquiries.index');

    //Test Drive Enquiries
    Route::get('test-drive-enquiries', 'Admin\TestDriveEnquiryController@index')->name('admin.test-drive-enquiries.index');
    Route::get('test-drive-enquiries/{id}','Admin\TestDriveEnquiryController@show')->name('admin.test-drive-enquiries.show');
    //Vehicle Enquiries
    Route::get('vehicle-enquiries', 'Admin\VehicleEnquiryController@index')->name('admin.vehicle-enquiries.index');
    //subscription Enquiries
    Route::get('subscription-enquiries', 'Admin\SubscriptionEnquiryController@index')->name('admin.subscription-enquiries.index');
    //Insurance Enquiries
    Route::get('insurance-enquiries', 'Admin\InsuranceEnquiryController@index')->name('admin.insurance-enquiries.index');
    //Exchange Enquiries
    Route::get('exchange-enquiries', 'Admin\ExchangeEnquiryController@index')->name('admin.exchange-enquiries.index');
    //Exchange Enquiries
    Route::get('usedcar-enquiries', 'Admin\UsedCarEnquiryController@index')->name('admin.usedcar-enquiries.index');
    //Locate Us Enquiries
    Route::get('locate-us-enquiries', 'Admin\LocateUsEnquiryController@index')->name('admin.locate-us-enquiries.index');
    //TALKTO CEO
    Route::get('talk-to-ceo', 'Admin\TalkToCEOAdminController@index')->name('admin.talk-to-ceo');

    //Bookings
    Route::get('bookings', 'Admin\BookingController@index')->name('admin.bookings.index');
    Route::get('bookings/{id}', 'Admin\BookingController@show')->name('admin.bookings.show');
    //Exchanges
    Route::get('exchanges', 'Admin\ExchangeController@index')->name('admin.exchanges.index');
    Route::get('exchanges/{id}', 'Admin\ExchangeController@show')->name('admin.exchanges.show');

    //Testimonial
    Route::resource('testimonials', 'Admin\TestimonialController', ['as' => 'admin'])->except([
        'create'
    ]);

    //Service Products Enquiries
    Route::get('service-product-enquiries', 'Admin\ServiceProductEnquiryController@index')->name('admin.service-product-enquiries.index');
    //Service Products Enquiries
    Route::get('exit-popup-enquiries', 'Admin\ExitPopupEnquiryController@index')->name('admin.exit-popup-enquiries.index');

    // for comparison
    // category-type
    Route::get('category-types', 'Admin\CategoryController@index')->name('admin.category_type.index');
    Route::post('category-types', 'Admin\CategoryController@store')->name('admin.category_type.store');
    Route::get('category-types/{id}/edit', 'Admin\CategoryController@edit')->name('admin.category_type.edit');
    Route::post('category-types/{id}/edit', 'Admin\CategoryController@update')->name('admin.category_type.update');
    Route::delete('category-types/{id}/delete', 'Admin\CategoryController@destroy')->name('admin.category_type.destroy');
    //  category - {id} is category type id , {catid} is category id.
    Route::get('category-types/{id}/categories', 'Admin\CategoryController@category_index')->name('admin.category.index');
    Route::post('category-types/{id}/categories', 'Admin\CategoryController@category_store')->name('admin.category.store');
    Route::get('category-types/{id}/categories/{catid}/edit', 'Admin\CategoryController@category_edit')->name('admin.category.edit');
    Route::post('category-types/{id}/categories/{catid}/edit', 'Admin\CategoryController@category_update')->name('admin.category.update');
    Route::delete('category-types/{id}/categories/{catid}/delete', 'Admin\CategoryController@category_destroy')->name('admin.category.destroy');
    // sub category - {id} is category type id , {catid} is category id {subid} is sub category id.
    Route::get('category-types/{id}/categories/{catid}/sub-categories', 'Admin\CategoryController@subcategory_index')->name('admin.subcategory.index');
    Route::post('category-types/{id}/categories/{catid}/sub-categories', 'Admin\CategoryController@subcategory_store')->name('admin.subcategory.store');
    Route::get('category-types/{id}/categories/{catid}/sub-categories/{subid}/edit', 'Admin\CategoryController@subcategory_edit')->name('admin.subcategory.edit');
    Route::post('category-types/{id}/categories/{catid}/sub-categories/{subid}/edit', 'Admin\CategoryController@subcategory_update')->name('admin.subcategory.update');
    Route::delete('category-types/{id}/categories/{catid}/sub-categories/{subid}/delete', 'Admin\CategoryController@subcategory_destroy')->name('admin.subcategory.destroy');

    //Vehicle Type
    Route::resource('vehicle-types', 'Admin\VehicleTypeController', ['as' => 'admin'])->except([
        'create'
    ]);

    //Application
    Route::resource('vehicle-application', 'Admin\VehicleApplicationController', ['as' => 'admin'])->except([
        'create', 'show'
    ]);
    //Document upload
    Route::resource('documents', 'Admin\DocumentController', ['as' => 'admin'])->only(['index', 'store', 'destroy']);

    //Buy New Car
    Route::get('buy-new-car', 'Admin\BuyNewCarController@index')->name('admin.buy-new-car.index');
    Route::post('buy-new-car', 'Admin\BuyNewCarController@store')->name('admin.buy-new-car.store');

    //Career Page
    Route::get('career-page', 'Admin\CareerPageController@index')->name('admin.career-page.index');
    Route::post('career-page', 'Admin\CareerPageController@store')->name('admin.career-page.store');

    //Career Page
    Route::get('cng-model-page', 'Admin\CngModelPageController@index')->name('admin.cng-model-page.index');
    Route::post('cng-model-page', 'Admin\CngModelPageController@store')->name('admin.cng-model-page.store');

    //Enquiry Page
    Route::get('enquiry-page', 'Admin\EnquiryPageController@index')->name('admin.enquiry-page.index');
    Route::post('enquiry-page', 'Admin\EnquiryPageController@store')->name('admin.enquiry-page.store');

    //Exchange Page
    Route::get('exchange-page', 'Admin\ExchangePageController@index')->name('admin.exchange-page.index');
    Route::post('exchange-page', 'Admin\ExchangePageController@store')->name('admin.exchange-page.store');

    //Insure My Car Page
    Route::get('insure-my-car-page', 'Admin\InsureMyCarPageController@index')->name('admin.insure-my-car-page.index');
    Route::post('insure-my-car-page', 'Admin\InsureMyCarPageController@store')->name('admin.insure-my-car-page.store');

    //Buy Used Car Page
    Route::get('buy-used-car-page', 'Admin\BuyUsedCarPageController@index')->name('admin.buy-used-car-page.index');
    Route::post('buy-used-car-page', 'Admin\BuyUsedCarPageController@store')->name('admin.buy-used-car-page.store');

    //Location Map Page
    Route::get('location-map-page', 'Admin\LocationMapPageController@index')->name('admin.location-map-page.index');
    Route::post('location-map-page', 'Admin\LocationMapPageController@store')->name('admin.location-map-page.store');

    //Our Services Page
    Route::get('services-page', 'Admin\ServicesPageController@index')->name('admin.services-page.index');
    Route::post('services-page', 'Admin\ServicesPageController@store')->name('admin.services-page.store');

    //Subscribe Page
    Route::get('subscribe-page', 'Admin\SubscribePageController@index')->name('admin.subscribe-page.index');
    Route::post('subscribe-page', 'Admin\SubscribePageController@store')->name('admin.subscribe-page.store');

    //Insurance Page
    Route::get('insurance-page/{slug}', 'Admin\InsurancePageController@show')->name('admin.insurance-page.index');
    Route::post('insurance-page/{slug}', 'Admin\InsurancePageController@store')->name('admin.insurance-page.store');

    //News $ Events
    Route::get('news-events', 'Admin\NewsAndEventsController@index')->name('admin.news-events.index');
    Route::post('news-events', 'Admin\NewsAndEventsController@store')->name('admin.news-events.store');

    // N&E List
    Route::get('news-events-list/index', 'Admin\NewsAndEventsListController@index')->name('admin.news-events-list.index');
    Route::post('news-events-list/store', 'Admin\NewsAndEventsListController@store')->name('admin.news-events-list.store');
    Route::get('news-events-list/{id}/edit', 'Admin\NewsAndEventsListController@edit')->name('admin.news-events-list.edit');
    Route::delete('news-events-list/{id}/destroy', 'Admin\NewsAndEventsListController@destroy')->name('admin.news-events-list.destroy');
    Route::post('news-events-list/update/{id}', 'Admin\NewsAndEventsListController@update')->name('admin.news-events-list.update');

    //section content
    Route::get('sections/{id}/content',  'Admin\SectionContentController@index')->name('admin.sections.content.index');
    Route::get('sections/{id}/content/create',  'Admin\SectionContentController@create')->name('admin.sections.content.create');
    Route::post('sections/{id}/content/store',  'Admin\SectionContentController@store')->name('admin.sections.content.store');
    Route::get('sections/{id}/content/{uuid}/edit',  'Admin\SectionContentController@edit')->name('admin.sections.content.edit');
    Route::post('sections/{id}/content/{uuid}/update',  'Admin\SectionContentController@update')->name('admin.sections.content.update');
    Route::post('sections/{id}/content/{uuid}/destroy',  'Admin\SectionContentController@destroy')->name('admin.sections.content.destroy');



    // Seo
    Route::get('seo', 'Admin\SEOController@index')->name('seo.index');
    Route::post('seo/create', 'Admin\SEOController@store')->name('seo.store');
    Route::get('seo/{id}/update', 'Admin\SEOController@update')->name('seo.update');
    Route::get('seo/gtm', 'Admin\SEOController@gtm')->name('seo.gtm');
    Route::post('seo/destroy/{id}', 'Admin\SEOController@destroy')->name('seo.destroy');


    // service_content
    Route::get('service_content',  'Admin\ServiceContentController@index')->name('service_content.index');
    Route::get('service_content/create',  'Admin\ServiceContentController@create')->name('service_content.create');
    Route::post('service_content/store',  'Admin\ServiceContentController@store')->name('service_content.store');
    Route::get('service_content/edit/{id}',  'Admin\ServiceContentController@edit')->name('service_content.edit');
    Route::post('service_content/update/{id}',  'Admin\ServiceContentController@update')->name('service_content.update');
    Route::delete('service_content/destroy/{id}',  'Admin\ServiceContentController@destroy')->name('service_content.destroy');

    //image category
    // Route::get('service_content',  'Admin\ServiceContentController@index')->name('service_content.index');
    Route::get('image_category/index',  'Admin\ImageCategoryController@index')->name('image_category.index');
    Route::post('image_category/store',  'Admin\ImageCategoryController@store')->name('image_category.store');
    Route::get('image_category/edit/{id}',  'Admin\ImageCategoryController@edit')->name('image_category.edit');
    Route::post('image_category/update/{id}',  'Admin\ImageCategoryController@update')->name('image_category.update');
    Route::delete('image_category/destroy/{id}',  'Admin\ImageCategoryController@destroy')->name('image_category.destroy');

    
    // Finance
    Route::get('finance',  'Admin\FinanceController@index')->name('finance.index');
    Route::get('finance/create',  'Admin\FinanceController@create')->name('finance.create');
    Route::post('finance/store',  'Admin\FinanceController@store')->name('finance.store');
    Route::get('finance/edit/{id}',  'Admin\FinanceController@edit')->name('finance.edit');
    Route::post('finance/update/{id}',  'Admin\FinanceController@update')->name('finance.update');
    Route::delete('finance/destroy/{id}',  'Admin\FinanceController@destroy')->name('finance.destroy');

    //Vehicle Categories
    Route::get('vehicleCategories', 'Admin\VehicleCategorieController@index')->name('admin.vehicleCategories.index');
    Route::delete('vehicleCategories/{id}/destroy','Admin\VehicleCategorieController@destroy')->name('admin.vehicleCategories.destroy');
Route::get(
    'booking-enquiries',
    'Admin\HomeEnquiryController@bookingEnquiries'
)
->middleware('auth:admin')
->name('admin.booking-enquiries.index');

});
