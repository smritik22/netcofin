<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Frontend\AreaController;
use App\Http\Controllers\Frontend\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Frontend\DashboardController as FrontDashboardController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\PropertyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Frontend\MessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BusinessOwner\Dashboard\CategoryController;
use App\Http\Controllers\BusinessOwner\Dashboard\SubCategoryController;
use App\Http\Controllers\BusinessOwner\Dashboard\MenuController;
use App\Http\Controllers\BusinessOwner\LoginBusinessOwnerController;
use App\Http\Controllers\BusinessOwner\Dashboard\CustomerController;
use App\Http\Controllers\BusinessOwner\Dashboard\SubscriptionPlanController;
use App\Http\Controllers\BusinessOwner\Dashboard\AboutUsController;
use App\Http\Controllers\BusinessOwner\Dashboard\ContactController;
use App\Http\Controllers\BusinessOwner\Dashboard\FaqController;
use App\Http\Controllers\BusinessOwner\Dashboard\PrivacyPolicyController;
use App\Http\Controllers\BusinessOwner\Dashboard\TermsConditionsController;
use App\Http\Controllers\BusinessOwner\Dashboard\StoreProfileController;
use App\Http\Controllers\BusinessOwner\Dashboard\ContactInquiryController;
use App\Http\Controllers\BusinessOwner\Dashboard\OrderReviewController;
use App\Http\Controllers\BusinessOwner\Dashboard\LocationsController;
use App\Http\Controllers\BusinessOwner\Dashboard\SettingsController;
use App\Http\Controllers\BusinessOwner\Dashboard\PaymentHistoryController;
use App\Http\Controllers\BusinessOwner\Dashboard\PaymentConfigurationController;
use App\Http\Controllers\BusinessOwner\Dashboard\PaymentTransactionController;
use App\Http\Controllers\BusinessOwner\Dashboard\TaxController;
use App\Http\Controllers\BusinessOwner\Dashboard\OrderReportsController;
use App\Http\Controllers\BusinessOwner\DashboardController as BusinessOwnerController;
use App\Http\Controllers\BusinessOwner\HomeController as BusinessHomeController;

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

// No Permission
Route::get('/403', function () {
    exit;
    return view('errors.403');
})->name('frontend.NoPermission');

Route::get('/phpinfo', function () {
    phpinfo();
    exit;
});

// Not Found
Route::get('404', function () {
    exit;
    return view('frontEnd.404');
})->name('NotFound');

Route::get('404-not-found', function () {
    exit;
    return view('frontEnd.404');
})->name('frontend.not_found');


Route::get('admin/app-version', function(){
    exit;
    echo 'The current Laravel version is '. app()->version();
});

//Menu management
Route::get('/menu', [MenuController::class,'index'])->name('menu');
Route::get('/menu/create', [MenuController::class,'create'])->name('menu.create');
Route::post('/menu/store', [MenuController::class,'store'])->name('menu.store');
Route::get('/menu/show/{id}', [MenuController::class,'show'])->name('menu.show');
Route::get('/menu/edit/{id}', [MenuController::class,'edit'])->name('menu.edit');
Route::post('/menu/update/{id}', [MenuController::class,'update'])->name('menu.update');
Route::get('/menu/delete/{id}', [MenuController::class,'destroy'])->name('menu.delete');
Route::post('/menu/updateAll', [MenuController::class, 'updateAll'])->name('menu.updateAll');
Route::post('/menu/anyData', [MenuController::class,'anyData'])->name('menu.anyData');
Route::post('/menu/subcategories', [MenuController::class,'subcategories'])->name('menu.subcategories');

//Sub category 
Route::get('/admin/categories', [CategoryController::class,'index'])->name('admin.categories');
Route::get('/category/create', [CategoryController::class,'create'])->name('category.create');
Route::post('/category/store', [CategoryController::class,'store'])->name('category.store');
Route::get('/category/show/{id}', [CategoryController::class,'show'])->name('category.show');
Route::get('/category/edit/{id}', [CategoryController::class,'edit'])->name('category.edit');
Route::get('/category/delete/{id}', [CategoryController::class,'destroy'])->name('category.delete');
Route::post('/category/update/{id}', [CategoryController::class,'update'])->name('category.update');
Route::post('/category/updateAll', [CategoryController::class, 'updateAll'])->name('category.updateAll');
Route::post('/category/anyData', [CategoryController::class,'anyData'])->name('category.anyData');
Route::post('/category/statusUpdate', [CategoryController::class, 'statusUpdate'])->name('category.statusUpdate');

Route::get('/admin/sub-categories', [SubCategoryController::class,'index'])->name('admin.sub-categories');
Route::get('/sub-category/create', [SubCategoryController::class,'create'])->name('sub-category.create');
Route::post('/sub-category/store', [SubCategoryController::class,'store'])->name('sub-category.store');
Route::get('/sub-category/edit/{id}', [SubCategoryController::class,'edit'])->name('sub-category.edit');
Route::post('/sub-category/update/{id}', [SubCategoryController::class,'update'])->name('sub-category.update');
Route::get('/sub-category/delete/{id}', [SubCategoryController::class,'destroy'])->name('sub-category.delete');
Route::post('/sub-category/updateAll', [SubCategoryController::class, 'updateAll'])->name('sub-category.updateAll');
Route::post('/sub-category/statusUpdate', [SubCategoryController::class, 'statusUpdate'])->name('sub-category.statusUpdate');

//customer
Route::get('/customer', [CustomerController::class,'index'])->name('customer');

//SubscriptionPlan
Route::get('/subscription-plan', [SubscriptionPlanController::class,'index'])->name('subscription-plan');

//Home
Route::get('/home', [BusinessHomeController::class,'home'])->name('home');
Route::get('/aboutUs', [BusinessHomeController::class,'aboutUs'])->name('aboutUs');
Route::get('/contact', [BusinessHomeController::class,'contact'])->name('contact');
Route::get('/order', [BusinessHomeController::class,'order'])->name('order');
Route::get('/book', [BusinessHomeController::class,'book'])->name('book');
// Route::get('/home', [HomeController::class,'home'])->name('home');
// Route::get('/home', [HomeController::class,'home'])->name('home');
//About Us
// Route::get('/aboutUs', [AboutUsController::class,'index'])->name('aboutUs');

// //Contact
// Route::get('/contact', [ContactController::class,'index'])->name('contact');

// //Faq
// Route::get('/faq', [FaqController::class,'index'])->name('faq');

// //Privacy Policy
// Route::get('/privacyPolicy', [PrivacyPolicyController::class,'index'])->name('privacyPolicy');

// //Terms and Conditions
// Route::get('/termsConditions', [TermsConditionsController::class,'index'])->name('termsConditions');

// //Store Profile
// Route::get('/storeProfile', [StoreProfileController::class,'index'])->name('storeProfile');

// //Contact Inquiry
// Route::get('/contactInquiry', [ContactInquiryController::class,'index'])->name('contactInquiry');

// //Order Review
// Route::get('/orderReview', [OrderReviewController::class,'index'])->name('orderReview');

// //Locations
// Route::get('/locations', [LocationsController::class,'index'])->name('locations');

// //Settings
// Route::get('/settings', [SettingsController::class,'index'])->name('settings');

// //Payment History
// Route::get('/paymentHistory', [PaymentHistoryController::class,'index'])->name('paymentHistory');

// //Payment Configuration
// Route::get('/paymentConfiguration', [PaymentConfigurationController::class,'index'])->name('paymentConfiguration');

// //Payment Transaction
// Route::get('/paymentTransaction', [PaymentTransactionController::class,'index'])->name('paymentTransaction');

// //Tax
// Route::get('/tax', [TaxController::class,'index'])->name('tax');

// //Order Reports
// Route::get('/orderReports', [OrderReportsController::class,'index'])->name('orderReports');




Route::post('/businessOwnerLogin', [LoginBusinessOwnerController::class,'login'])->name('businessOwnerLogin');


Route::post('formlogin', [LoginBusinessOwnerController::class, 'login'])->name('formlogin');

Route::post('/subCategory/anyData', [SubCategoryController::class,'anyData'])->name('subCategory.anyData');

Route::Group(['prefix' => env('BACKEND_PATH')], function () {
    Route::get('/forgot-password', [\App\Http\Controllers\Auth\LoginController::class, 'forgotpass']);
    Route::post('/forgot/user', [\App\Http\Controllers\Auth\LoginController::class, 'mainuserforgot']);

    Route::middleware(['preventBackHistory'])->group(function () {
        Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showMainuserLoginForm'])->name('admin.login');
      
        Route::post('/adminLogin', [\App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('adminLogin');
        Route::post('/main-user-logout', [\App\Http\Controllers\Auth\LoginController::class, 'logoutMainUser'])->name('main-user-logout');
    });
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::Group(['namespace' => 'Frontend', 'as' => 'frontend.','middleware'=>'userauth'], function () {
    
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('homePage');
    
    Route::get('/login', [DashboardController::class,'index'])->name('login');
    // echo $_SERVER['SERVER_NAME'];exit;
    Route::post('/login/submit', [UserController::class,'login'])->name('login.submit');
    // Route::get('/signup', [RegisterController::class,'showSignupForm'])->name('signup');
    // Route::post('/signup/submit', [UserController::class,'signup'])->name('signup.submit');
    
    Route::get('/register/{term?}', [RegisterController::class,'showSignupForm'])->name('register');
    Route::get('/register', [RegisterController::class,'showSignupForm'])->name('register');
    Route::post('/register/submit', [RegisterController::class,'register'])->name('register.submit');
    // Route::post('/register/submit', [UserController::class,'register'])->name('register.submit');

    Route::get('/forget-password', [UserController::class,'forget_password'])->name('forget_password');
    Route::post('/forget-password/submit', [UserController::class,'forgotPassword_submit'])->name('forgot_password.submit');
   
    Route::post('report-user', [PropertyController::class, 'report_user'])->name('report_user');
    Route::post('contact-user', [PropertyController::class, 'contact_user'])->name('contact_user');
    
    Route::get('thank-you', [HomeController::class,'thank_you'])->name('thankyou');
    
    Route::get('about-us', [HomeController::class, 'about_us'])->name('about_us');
    Route::get('terms-and-conditions', [HomeController::class, 'terms_and_conditions'])->name('terms_and_conditions');
    Route::get('privacy-policy', [HomeController::class, 'privacy_policy'])->name('privacy_policy');
    Route::get('faqs', [HomeController::class, 'faqs'])->name('faqs');
    Route::get('features', [HomeController::class, 'features'])->name('features');
    Route::get('contact-us', [HomeController::class, 'contact_us'])->name('contact_us');
    Route::post('contact-us/submit', [HomeController::class, 'submit_contactus'])->name('contactus.submit');
    

    Route::post('/city/getState', [HomeController::class, 'getState'])->name('getState');
    Route::post('/city/getCity', [HomeController::class, 'getCity'])->name('getCity');


    Route::get('varify-otp', [UserController::class,'otp_varify'])->name('varify_otp');
    Route::post('varify-otp/submit', [UserController::class,'varifyOTP'])->name('varify_otp.submit');
    Route::post('resend-otp', [UserController::class,'resend_otp'])->name('resend_otp');
    
    Route::get('reset-password', [UserController::class, 'reset_password'])->name('reset_password');
    Route::post('reset-password/submit', [UserController::class, 'submit_reset_password'])->name('reset_password.submit');
    
    Route::get('logout-user', [UserController::class, 'logoutUser'])->name('logout');
    Route::get('view-agent/{id}', [PropertyController::class, 'view_agent'])->name('agent.view');
    
    Route::get('view-similar-properties/{id}', [PropertyController::class, 'similar_properties'])->name('property.similiar_properties');
    Route::post('/view-similar-properties/get-data', [PropertyController::class, 'fetch_similar_properties'])->name('property.similiar_properties.fetch');
    
    Route::get('/subscription-plans', [FrontDashboardController::class, 'plan_list'])->name('planlist');

    Route::get('stripe', [PaymentController::class, 'stripe'])->name('stripe');
    Route::post('stripe', [PaymentController::class, 'stripePost'])->name('stripePost');

    // login required
    Route::Group(['middleware' => ['frontloginrequired', 'preventBackHistory']], function (){
        
        Route::get('/account', [UserController::class,'account'])->name('account');
        Route::post('/account/update', [UserController::class,'update_profile'])->name('account.update');
        Route::post('/account/remove-profile', [UserController::class, 'removeImage'])->name('user.removeimage');
        Route::post('/change-password/submit', [UserController::class,'change_password'])->name('change_password.submit');
        
        Route::post('/my-favourites', [UserController::class, 'getFavourites'])->name('user.favourites.list');
        Route::get('/my-subscriptions', [FrontDashboardController::class, 'subscription_list'])->name('subscriptionplans.list');
        Route::post('/my-subscriptions/cancel-plan', [FrontDashboardController::class, 'cancel_plan'])->name('usersubscription.cancelplan');
        
        Route::get('/my-ads', [PropertyController::class, 'my_ads'])->name('property.my_ads');
        Route::post('/my-ads/get-data', [PropertyController::class, 'fetch_my_ads'])->name('property.my_ads.fetch');
        
        Route::get('chat-list', [MessageController::class, 'index'])->name('chat.list');
        Route::post('chat-list/fetch', [MessageController::class, 'fetchChatList'])->name('chat.list.fetch');
        Route::get('conversation/{id}', [MessageController::class, 'conversation'])->name('conversation.list');
        Route::post('conversation/fetch', [MessageController::class, 'fetchConversationList'])->name('conversation.list.fetch');
        Route::post('send-message', [MessageController::class, 'sendMessage'])->name('conversation.message.submit');
    });
    
    Route::Group(['middleware' => 'auth:main_user'], function () {
        Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    });
    
    Route::post('payment',[PaymentController::class, 'payment'])->name('payment');
    Route::get('payment/success/{id?}',[PaymentController::class, 'payment_success'])->name('payment.success');
    Route::get('payment/error/{id?}',[PaymentController::class, 'payment_error'])->name('payment.error');
});


// // echo  "kanchi.".config( key: 'app.short_url'); exit;
// Route::middleware('web')->domain(env('SITE_URL'))->group(function(){
//     //  dd("business owner routes");
//     // Route::get('/','IndexController@index')->name('frontend.loginpage');
// });
// Route::domain('{subdomain}.'.'vrininternational.com.au')->group(function () {
//     // dd($subdomain);
//     Route::get('/', 'HomeController@index_new')->name('products.index');
//     // Route::resource('products', 'ProductsController')->only(['index', 'show']);
// });




// Clear Cache
Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return redirect()->back()->with('doneMessage', __('backend.cashClearDone'));
})->name('cacheClear');

Route::get('/route-clear', function () {
    // Artisan::call('route:cache');
    Artisan::call('route:clear');
    Artisan::call('route:list');
    return redirect()->back()->with('doneMessage', 'Routes cleared');
})->name('routeClear');