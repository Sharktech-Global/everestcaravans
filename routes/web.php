<?php

use Illuminate\Support\Facades\Route;




  //dd($users);

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

Route::get('/', 'HomeController@index')->name('home');
Route::post('/vehicles', 'HomeController@vehicle_search')->name('vehicle_search');
Route::get('/vehicles/{type?}', 'HomeController@vehicle_type')->name('vehicle_type');
Route::get('/get-vehicle-application/{type}', 'VehicleController@getapplication')->name('get-vehicle-application');
Route::get('createslugfromvalue', 'HomeController@createslugfromvalue')->name('createslugfromvalue');
Route::get('/careers', 'CareerController@show')->name('career');
// Route::post('/careers', 'CareerController@store');

Route::get('/careers', 'CareersController@show')->name('career');
Route::post('/careers', 'CareersController@store')->name('careers.store');
// Route::get('/careers/change', 'CareerController@change');

// // Route::get('/vehicles', 'HomeController@index')->name('home');
 Route::get('/vehicle/{slug}', 'VehicleController@show')->name('vehicles.show');
 Route::post('/vehicle/{slug}', 'VehicleController@booking')->name('vehicles.booking');
 Route::get('/booking/{slug}/checkout', 'CheckoutController@show')->name('checkout');
 Route::post('/booking/{slug}/checkout-data', 'CheckoutController@store')->name('checkout.store');
 Route::get('/booking/transaction/cod', 'CodController@payment')->name('cod.payment');
 Route::get('/booking/{slug}/success', ['middleware' => 'success', 'as' => 'checkout.success', 'uses' => 'CheckoutController@success']);

 Route::get('/booking/{slug}/failure', 'CheckoutController@failure')->name('checkout.failure');
// // nexa
// Route::get('/vehicles/nexa/{slug}', 'VehicleController@nexa_show')->name('vehicles.nexa.show');

// // vehicle types
// Route::get('/vehicle-types/{slug}', 'VehicleTypeController@show')->name('vehicle-types.show');


Route::get('/about-us', 'AboutController@show')->name('about');
Route::get('/our-range', 'OurRangeController@show')->name('our-range');
Route::get('/finance-partner', 'FinancePartnerController@show')->name('finance-partner');
Route::get('/videos', 'VideosController@show')->name('videos');
Route::get('/book-test-drive', 'BookingTestController@index')->name('book_test_drive.index');
Route::post('/book-test-drive/store', 'BookingTestController@store')->name('book_test_drive.store');

// // talk to ceo
// Route::get('/talk-to-ceo', 'TalkToCEOController@show')->name('talk-to-ceo');
// Route::post('/talk-to-ceo-send', 'TalkToCEOController@store')->name('talk-to-ceo-send');

// Route::get('/booking', 'BookingController@index')->name('booking.index');
// Route::get('/booking/{slug}', 'BookingController@show')->name('booking.show');
// Route::post('/booking/{slug}', 'BookingController@store');

// // send enquiry
// Route::get('/send-enquiry/{id}', 'BookingController@send_enquiry')->name('booking.send-enquiry');

// Route::get('/booking/{slug}/checkout', 'CheckoutController@show')->name('checkout');
// Route::post('/booking/{slug}/checkout', 'CheckoutController@store');
// Route::get('/booking/{slug}/success', ['middleware' => 'success', 'as' => 'checkout.success', 'uses' => 'CheckoutController@success']);

// Route::get('/booking/transaction/federal', 'FederalPaymentController@payment')->name('federal.payment');
// Route::post('/booking/federal/status', 'FederalPaymentController@status')->name('federal.status');

// Route::get('/booking/transaction/cod', 'CodController@payment')->name('cod.payment');

Route::get('/contact', 'ContactController@show')->name('contact');
Route::post('/contact', 'ContactController@store')->name('contact.store');
// Route::get('/contact-us/network/{type}', 'ContactController@network')->name('contact.network');

Route::get('/enquiry/{slug}', 'EnquiryController@show')->name('enquiry.index');
Route::post('/enquiry/store', 'EnquiryController@store')->name('enquiry.store');;



// Route::get('/book-a-service', 'ServiceController@show')->name('services.show');
// Route::post('/book-a-service', 'ServiceController@store')->name('services.store');

// Route::get('/buy-a-new-car', 'BuyNewCarController@show')->name('buy-new-car.show');
// Route::post('/buy-a-new-car', 'BuyNewCarController@store')->name('buy-new-car.store');

// Route::get('/insure-my-car', 'InsuranceController@show')->name('insure-my-car.show');
// Route::post('/insure-my-car', 'InsuranceController@store')->name('insure-my-car.store');

Route::get('/exchange', 'ExchangeController@show')->name('exchange.show');
Route::get('/financial-services', 'HomeController@finance')->name('finance.show');

// Route::get('/brochures', 'BrochureController@show')->name('brochures.show');
Route::get('/privacy-policy', 'PrivacyController@show')->name('privacy.show');
Route::get('/refund-policy', 'RefundPolicyController@show')->name('refund-policy.show');
// Route::get('/cookie-policy', 'CookieController@show')->name('cookie.show');

// Route::get('/board-committees', 'BoardCommitteeController@show')->name('board-committees.show');
// Route::get('/vigil-mechanism', 'VigilMechanismController@show')->name('vigil-mechanism.show');

// Route::get('/insurance-features', 'InsuranceController@features')->name('insurance-features.show');
// Route::get('/our-services', 'OurServicesController@show')->name('our-services.show');
// Route::get('/subscribe', 'SubscribeController@show')->name('subscribe.show');

// Route::get('/coming-soon', 'ComingSoonController@show')->name('coming-soon.show');
// Route::get('/network', 'NetworkController@show')->name('network.show');
// Route::get('/cng-models', 'CngModelsController@show')->name('cng-models.show');
// Route::get('/testimonials', 'TestimonialsController@show')->name('testimonials.show');

Route::get('/terms-of-use', 'TermsController@show')->name('terms.show');

// Route::get('/nexa-cars', 'NexaPageController@show')->name('nexa.cars.show');
// Route::get('/nexa-cars/view/{slug}', 'NexaPageController@nexa_show')->name('nexa.cars.view');

// Route::get('/service-products-enquiry', 'ServiceProductEnquiryController@show')->name('service-products-enquiry.show');
// Route::post('/service-products-enquiry', 'ServiceProductEnquiryController@store')->name('service-products-enquiry.store');

// Route::post('/exit-popup', 'ExitPopupController@store')->name('exit-popup');

// Route::get('location_list', 'HomeController@location_list')->name('location_list');
// Route::get('/location_content/{page}', 'HomeController@location_content')->name('location_content');
// Route::get('/marketing', 'HomeController@listing')->name('listing');
// Route::get('/marketing/{page}', 'HomeController@marketing')->name('marketing');
// Route::get('/marketing/{page}/{value}', 'HomeController@marketing_page')->name('marketing.show');
// Route::get('/add-page', 'HomeController@addPage')->name('addPage');
// Route::get('/our-services/{slug}', 'HomeController@PageView')->name('addPage.view');

// // emi calc
// Route::get('/emi-calculator', 'HomeController@emi')->name('emi');
// thankyou
Route::get('/thank-you', 'HomeController@thankyou')->name('thank-you');
// // comparison
// Route::get('/comparison', 'ComparisonController@index')->name('comparison.index');
// Route::get('/comparison/{vehicle1}/{variant1}/{vehicle2}/{variant2}/compare', 'ComparisonController@compare')->name('comparison.compare');
// Route::post('/comparison/action', 'ComparisonController@store')->name('comparison.store');
// Route::post('/comparison/forget', 'ComparisonController@foreget')->name('comparison.foreget');

// //dealership
// Route::get('/network-location', 'DealershipController@all_locations')->name('dealership.all_locations');
// Route::get('/network-location-view/{id}', 'DealershipController@show')->name('dealership.view');

// //locate us form
// Route::post('/locate-us', 'LocateUsEnquiryController@store')->name('locate-us.store');
// //location map
// Route::get('/location-map', 'LocationMapController@show')->name('location_map.show');

// //LEADERSHIP TEAM
// Route::get('/leadership-team', 'LeadershipController@show')->name('leadership-team.show');
// // ajax call
// Route::post('/getlocation', 'HomeController@getlocation')->name('getlocation');
// Route::post('/exchange-my-car', 'HomeController@sent_otp_test_drive')->name('sent_otp_test_drive');
// Route::post('/test-drive-test', 'HomeController@sent_otp_test_drive_test')->name('sent_otp_test_drive_test');

// Route::post('/exchange-my-car-enquiry', 'HomeController@sent_exchange_enquiry')->name('sent_exchange_enquiry');

// // Route::post('/contact-us', 'HomeController@contact_post')->name('contact-us');

// Route::post('/buy-a-new-car', 'HomeController@sent_otp_buy_new_car')->name('sent_otp_buy_new_car');
// Route::post('/insurance-my-car', 'HomeController@sent_otp_insurance')->name('sent_otp_insurance');
// Route::post('/service-booking', 'HomeController@sent_otp_service')->name('sent_otp_service');
// Route::post('/services-form', 'HomeController@sent_otp_services_form')->name('sent_otp_services_form');
// Route::post('/enquiry', 'HomeController@sent_otp_enquiry')->name('sent_otp_enquiry');
// Route::post('/offer', 'OfferController@sent_otp_offer')->name('sent_otp_offer');
// Route::post('/exchange', 'ExchangeController@sent_otp_exchange')->name('sent_otp_exchange');
// Route::post('/usedcar', 'UsedCarController@sent_otp_usedcar')->name('sent_otp_usedcar');
// Route::post('/vehicle/get_in_touch', 'VehicleController@sent_otp_get_in_touch')->name('sent_otp_get_in_touch');
// Route::post('/vehicle/getintouch_location', 'DealershipController@sent_otp_getintouch_location')->name('sent_otp_getintouch_location');
// Route::post('/vehicle/subscribe', 'SubscribeController@sent_otp_subscribe')->name('sent_otp_subscribe');
// Route::post('/verify-otp', 'HomeController@verify_otp')->name('verify_otp');


// // blog
Route::get('/blog', 'BlogController@show')->name('blog.show');
Route::get('/blog/{id}', 'BlogController@view')->name('blog.details');

//News
Route::get('/news-event', 'NewsController@index')->name('news.index');
Route::get('news-event/{slug}', 'NewsController@inner')->name('news.show');



// service
Route::get('/services', 'ServiceController@index')->name('services.index');
Route::get('/service/{slug}', 'ServiceController@show')->name('services.show');
Route::post('/services-form', 'ServiceController@store')->name('services.store');

// //Vehicle Landing Page
// Route::get('/landing/{slug}', 'VehicleLandingController@show')->middleware('landing.index');

// Route::get('/why-buy-maruti-insurance', 'InsuranceController@marutiInsurance')->name('why-buy-maruti-insurance.show');

// Route::get('/advantages-of-popular', 'InsuranceController@advantagepopular')->name('advantages-of-popular.show');

// Route::get('/add-ons', 'InsuranceController@addons')->name('add-ons.show');

// Route::get('/vas', 'InsuranceController@vas')->name('vas.show');

Route::get('/faqs', 'FaqController@show')->name('faqs.show');

// Route::get('/transcript-of-the-01st-extra-ordinary-general-meeting-of-the-company-for-the-financial-year-2021-22', 'TranscriptController@show')->name('transcript.show');
// // Route::get('financial-statements/financial-statements-of-the-company', 'FinancialStatementsController@show')->name('financial-statements.show');
// Route::get('/financial-statements/financial-statements-of-the-company', function(){
//     return redirect('http://www.popularmaruti.com/investor-relations/financials/financial-reports-and-presentations/company/');
// })->name('financial-statements.show');

// // Route::get('financial-statements/material-subsidiary', 'FinancialStatementsController@materialSubsidiary')->name('financial-statements.materialSubsidiary');
// Route::get('/financial-statements/material-subsidiary', function(){
//     return redirect('http://www.popularmaruti.com/investor-relations/financials/financial-reports-and-presentations/material-subsidiary/');
// })->name('financial-statements.materialSubsidiary');



// // Route::get('/material-creditors', 'MaterialCreditorsController@show')->name('material-creditors.show');
// Route::get('/material-creditors', function(){
//     return redirect('http://www.popularmaruti.com/investor-relations/governance/material-creditors/');
// })->name('material-creditors.show');

// Route::get('/policies', 'PolicyController@show')->name('policies.show');

// // Route::get('/industry-report', 'IndustryReportController@show')->name('industry-report.show');
// Route::get('/industry-report', function(){
//     return redirect('http://www.popularmaruti.com/investor-relations/investor-update/reports/industry-report/');
// })->name('industry-report.show');


// // Route::get('/about-us/about-founder', 'AboutController@founder')->name('founder');

// // Life at popular
// // Route::get('/life-at-popular', 'AboutController@show_popular')->name('life-at-popular');
// Route::get('/request-a-test-drive', 'TestDriveController@show')->name('test-drive.show');
// Route::post('/request-a-test-drive', 'TestDriveController@store')->name('test-drive.store');
// // Route::get('/offers/{location}', 'OfferController@show')->name('offers.show');
// // Route::post('/offers', 'OfferController@store')->name('offers.store');
// // Route::get('/buy-used-car', 'UsedCarController@show')->name('usedcar.show');
// // Route::get('/request-virtual-reality-experience', 'VirtualRealityController@show')->name('virtual-reality.show');
// // Route::post('/request-virtual-reality-experience', 'VirtualRealityController@store')->name('virtual-reality.store');
// // Route::get('/general-meeting-notice', 'GeneralMeetingNoticeController@show')->name('general-meeting-notice.show');
// // Route::get('/shareholder-grievance-redressal', 'ShareholderGrievanceRedressalController@show')->name('shareholder-grievance-redressal.show');
// // Route::get('/find-us', 'NetworkController@show')->name('network.show');
// // Route::get('/dealership/{dealership}', 'DealershipController@show');
// // Route::get('/network/{tab}', 'NetworkController@show')->name('network.show');

// // test email template
// Route::get('/test-email', 'TestDriveController@test');

// // Route::get('razorpay-payment', 'RazorpayPaymentController@index')->name('razorpay.payment.index');
// // Route::post('razorpay-payment', 'RazorpayPaymentController@store')->name('razorpay.payment.store');
// // Route::get('/payment/success', 'RazorpayPaymentController@success')->name('razorpay.payment.success');



// Route::get('worldline-payment', 'WorldLineController@index')->name('worldline.payment.index');
// Route::post('worldline-payment/response/{id}', 'WorldLineController@response')->name('worldline.payment.response');
// Route::get('/payment/success', 'WorldLineController@success')->name('worldline.payment.success');

// gallery
Route::get('gallery', 'GalleryController@index')->name('gallery.index');

// ccavenue payment gateway
Route::get('ccavenue', 'CcavenueController@index')->name('ccavenue.payment.index');
Route::post('ccavenue-response', 'CcavenueController@response')->name('ccavenue.payment.response');

Route::get('/book-a-factory-visit', 'FactoryVisitController@show')
    ->name('factory-visit.show');
Route::post('/book-a-factory-visit', 'FactoryVisitController@store')
    ->name('factory-visit.store');