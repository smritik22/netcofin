<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\EmailTemplateController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\LabelController;
use App\Http\Controllers\Dashboard\BusinessOwnerController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\SubCategoryController;
use App\Http\Controllers\Dashboard\ModifiersController;
use App\Http\Controllers\Dashboard\ItemController;
use App\Http\Controllers\Dashboard\CmsController;
use App\Http\Controllers\Dashboard\CountryController;
use App\Http\Controllers\Dashboard\GovernorateController;
use App\Http\Controllers\Dashboard\GeneralUsersController;
use App\Http\Controllers\Dashboard\RevenueReportController;
use App\Http\Controllers\Dashboard\SubscriptionPlanController;
use App\Http\Controllers\Dashboard\SubscriptionReportController;
use App\Http\Controllers\Dashboard\TransactionController;
use App\Http\Controllers\Dashboard\WebmasterSettingsController;
use App\Http\Controllers\Dashboard\StateController;
use App\Http\Controllers\Dashboard\CityController;
use App\Models\BedroomTypes;
use App\Models\Property;
use App\Models\MainUsers;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::get('/403', function () {
    return view('errors.403');
})->name('NoPermission');

// Not Found
Route::get('/404', function () {
    exit;
    return view('errors.404');
})->name('NotFound');

// Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
Route::Group(['middleware' => 'LogoutUserStatus'], function () {
    // Admin Home
    Route::get('/', [DashboardController::class, 'index'])->name('adminHome');
    Route::post('/filter', [DashboardController::class, 'index'])->name('dashboardfilter');
    //Search
    Route::get('/search', [DashboardController::class, 'search'])->name('adminSearch');
    Route::post('/find', [DashboardController::class, 'find'])->name('adminFind');

    // users
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::get('/users/create/', [UsersController::class, 'create'])->name('usersCreate');
    Route::post('/users/store', [UsersController::class, 'store'])->name('usersStore');
    Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('usersEdit');
    Route::post('/users/{id}/update', [UsersController::class, 'update'])->name('usersUpdate');
    Route::get('/users/destroy/{id}', [UsersController::class, 'destroy'])->name('usersDestroy');
    Route::post('/users/updateAll', [UsersController::class, 'updateAll'])->name('usersUpdateAll');


    // Users & Permissions
    Route::get('/change-password', [UsersController::class, 'changePassword'])->name('admin-change-password');
    Route::post('/update-password', [UsersController::class, 'updatePassword'])->name('admin-update-password');

    // Labels Management
    Route::get('/label', [LabelController::class,'index'])->name('label');
    Route::get('/label/create', [LabelController::class,'create'])->name('label.create');
    Route::post('/label/store', [LabelController::class,'store'])->name('label.store');
    Route::get('/label/delete/{id}', [LabelController::class,'destroy'])->name('label.delete');
    Route::get('/label/show/{id}', [LabelController::class,'show'])->name('label.show');
    Route::get('/label/edit/{id}', [LabelController::class,'edit'])->name('label.edit');
    Route::post('/label/update/{id}', [LabelController::class,'update'])->name('label.update');
    Route::post('/label/anyData', [LabelController::class,'anyData'])->name('label.anyData');
    Route::get('/label/lang-edit/{parentId}/{langId}', [LabelController::class,'langedit'])->name('label.editlang');
    Route::post('/label/storeLang', [LabelController::class,'storeLang'])->name('label.storeLang');
    Route::post('/label/updateAll', [LabelController::class, 'updateAll'])->name('labelUpdateAll');



    // emailtemplate Management
    Route::get('/emailtemplate', [EmailTemplateController::class,'index'])->name('emailtemplate');
    Route::get('/emailtemplate/create', [EmailTemplateController::class,'create'])->name('emailtemplate.create');
    Route::post('/emailtemplate/store', [EmailTemplateController::class,'store'])->name('emailtemplate.store');
    Route::get('/emailtemplate/edit/{id}',[EmailTemplateController::class,'edit'])->name('emailtemplate.edit');
    Route::post('/emailtemplate/update/{id}',[EmailTemplateController::class,'update'])->name('emailtemplate.update');
    Route::get('/emailtemplate/show/{id}',[EmailTemplateController::class,'show'])->name('emailtemplate.show');
    Route::post('/emailtemplate/anyData',[EmailTemplateController::class,'anyData'])->name('emailtemplate.anyData');
    Route::get('/emailtemplate/{parentId}/addlang/{langId}', [EmailTemplateController::class,'multiLang'])->name('emailtemplate.multiLang');
    Route::post('emailtemplate/storeLang', [EmailTemplateController::class,'storeLang'])->name('emailtemplate.storeLang');
    Route::post('/emailtemplate/updateAll', [EmailTemplateController::class, 'updateAll'])->name('emailtemplate.updateAll');

    // CMS Management
    Route::get('/cms', [CmsController::class,'index'])->name('cms');
    Route::get('/cms/create', [CmsController::class,'create'])->name('cms.create');
    Route::post('/cms/store', [CmsController::class,'store'])->name('cms.store');
    Route::get('/cms/delete/{id}', [CmsController::class,'destroy'])->name('cms.delete');
    Route::get('/cms/show/{id}', [CmsController::class,'show'])->name('cms.show');
    Route::get('cms/edit/{id}', [CmsController::class,'edit'])->name('cms.edit');
    Route::post('cms/update/{id}', [CmsController::class,'update'])->name('cms.update');
    Route::post('cms/anyData', [CmsController::class,'anyData'])->name('cms.anyData');
    Route::get('cms/cms-edit/{parentId}/{langId}', [CmsController::class,'cmsedit'])->name('cms.editCms');
    Route::post('cms/storeLang', [CmsController::class,'storeLang'])->name('cms.storeLang');
    Route::post('cms/updateAll', [CmsController::class, 'updateAll'])->name('cms.updateAll');


    // Locations Management
    // Country Management
    Route::get('/country', [CountryController::class,'index'])->name('country');
    Route::get('/country/create', [CountryController::class,'create'])->name('country.create');
    Route::post('/country/store', [CountryController::class,'store'])->name('country.store');
    Route::get('/country/delete/{id}', [CountryController::class,'destroy'])->name('country.delete');
    Route::get('/country/show/{id}', [CountryController::class,'show'])->name('country.show');
    Route::get('/country/edit/{id}', [CountryController::class,'edit'])->name('country.edit');
    Route::post('/country/update/{id}', [CountryController::class,'update'])->name('country.update');
    Route::post('/country/updateAll', [CountryController::class, 'updateAll'])->name('country.updateAll');
    Route::post('/country/anyData', [CountryController::class,'anyData'])->name('country.anyData');
    Route::get('/country/{parentId}/addlang/{langId}', [CountryController::class,'multiLang'])->name('country.multiLang');
    Route::post('/country/addLanguage', [CountryController::class,'storeLang'])->name('country.storeLang');


    // State Management
    Route::get('/state', [StateController::class,'index'])->name('state');
    Route::get('/state/create', [StateController::class,'create'])->name('state.create');
    Route::post('/state/store', [StateController::class,'store'])->name('state.store');
    Route::get('/state/delete/{id}', [StateController::class,'destroy'])->name('state.delete');
    Route::get('/state/show/{id}', [StateController::class,'show'])->name('state.show');
    Route::get('/state/edit/{id}', [StateController::class,'edit'])->name('state.edit');
    Route::post('/state/update/{id}', [StateController::class,'update'])->name('state.update');
    Route::post('/state/updateAll', [StateController::class, 'updateAll'])->name('state.updateAll');
    Route::post('/state/anyData', [StateController::class,'anyData'])->name('state.anyData');
    Route::get('/state/{parentId}/addlang/{langId}', [StateController::class,'multiLang'])->name('state.multiLang');
    Route::post('/state/addLanguage', [StateController::class,'storeLang'])->name('state.storeLang');


    // City Management
    Route::get('/city', [CityController::class,'index'])->name('city');
    Route::get('/city/create', [CityController::class,'create'])->name('city.create');
    Route::post('/city/store', [CityController::class,'store'])->name('city.store');
    Route::get('/city/delete/{id}', [CityController::class,'destroy'])->name('city.delete');
    Route::get('/city/show/{id}', [CityController::class,'show'])->name('city.show');
    Route::get('/city/edit/{id}', [CityController::class,'edit'])->name('city.edit');
    Route::post('/city/update/{id}', [CityController::class,'update'])->name('city.update');
    Route::post('/city/updateAll', [CityController::class, 'updateAll'])->name('city.updateAll');
    Route::post('/city/getState', [CityController::class, 'getState'])->name('city.getState');
    Route::post('/city/getCity', [CityController::class, 'getCity'])->name('city.getCity');



    // General user management
    Route::get('/generalusers', [GeneralUsersController::class,'index'])->name('generalusers');
    Route::get('/generaluser/create', [GeneralUsersController::class,'create'])->name('generaluser.create');
    Route::post('/generaluser/store', [GeneralUsersController::class,'store'])->name('generaluser.store');
    Route::get('/generaluser/delete/{id}', [GeneralUsersController::class,'destroy'])->name('generaluser.delete');
    Route::get('/generaluser/show/{id}', [GeneralUsersController::class,'show'])->name('generaluser.show');
    Route::get('/generaluser/edit/{id}', [GeneralUsersController::class,'edit'])->name('generaluser.edit');
    Route::post('/generaluser/update/{id}', [GeneralUsersController::class,'update'])->name('generaluser.update');
    Route::post('/generaluser/updateAll', [GeneralUsersController::class, 'updateAll'])->name('generaluser.updateAll');
    Route::post('/generaluser/anyData', [GeneralUsersController::class,'anyData'])->name('generaluser.anyData');




    // BusinessOwners Management
    Route::get('/businessOwners/{businessOwner_type?}', [BusinessOwnerController::class,'index'])->name('businessOwners');
    Route::get('/businessOwner/create', [BusinessOwnerController::class,'create'])->name('businessOwner.create');
    Route::post('/businessOwner/store', [BusinessOwnerController::class,'store'])->name('businessOwner.store');
    Route::get('/businessOwner/delete/{id}', [BusinessOwnerController::class,'destroy'])->name('businessOwner.delete');
    Route::get('/businessOwner/show/{id}', [BusinessOwnerController::class,'show'])->name('businessOwner.show');
    Route::get('/businessOwner/edit/{id}', [BusinessOwnerController::class,'edit'])->name('businessOwner.edit');
    Route::post('/businessOwner/update/{id}', [BusinessOwnerController::class,'update'])->name('businessOwner.update');
    Route::post('/businessOwner/updateAll', [BusinessOwnerController::class, 'updateAll'])->name('businessOwner.updateAll');
    Route::post('/businessOwner/anyData', [BusinessOwnerController::class,'anyData'])->name('businessOwner.anyData');

    // categories Management
    Route::get('/categories', [CategoryController::class,'index'])->name('categories');
    Route::get('/category/create', [CategoryController::class,'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class,'store'])->name('category.store');
    Route::get('/category/show/{id}', [CategoryController::class,'show'])->name('category.show');
    Route::get('/category/edit/{id}', [CategoryController::class,'edit'])->name('category.edit');
    Route::get('/category/delete/{id}', [CategoryController::class,'destroy'])->name('category.delete');
    Route::post('/category/update/{id}', [CategoryController::class,'update'])->name('category.update');
    Route::post('/category/updateAll', [CategoryController::class, 'updateAll'])->name('category.updateAll');

    // sub-categories Management
    Route::get('/sub-categories', [SubCategoryController::class,'index'])->name('sub-categories');
    Route::get('/sub-category/create', [SubCategoryController::class,'create'])->name('sub-category.create');
    Route::post('/sub-category/store', [SubCategoryController::class,'store'])->name('sub-category.store');
    Route::get('/sub-category/show/{id}', [SubCategoryController::class,'show'])->name('sub-category.show');
    Route::get('/sub-category/edit/{id}', [SubCategoryController::class,'edit'])->name('sub-category.edit');
    Route::post('/sub-category/update/{id}', [SubCategoryController::class,'update'])->name('sub-category.update');
    Route::get('/sub-category/delete/{id}', [SubCategoryController::class,'destroy'])->name('sub-category.delete');
    Route::post('/sub-category/updateAll', [SubCategoryController::class, 'updateAll'])->name('sub-category.updateAll');

    // modifiers Management
    Route::get('/modifiers', [ModifiersController::class,'index'])->name('modifiers');
    Route::get('/modifier/create', [ModifiersController::class,'create'])->name('modifier.create');
    Route::post('/modifier/store', [ModifiersController::class,'store'])->name('modifier.store');
    Route::get('/modifier/show/{id}', [ModifiersController::class,'show'])->name('modifier.show');
    Route::get('/modifier/edit/{id}', [ModifiersController::class,'edit'])->name('modifier.edit');
    Route::post('/modifier/update/{id}', [ModifiersController::class,'update'])->name('modifier.update');
    Route::get('/modifier/delete/{id}', [ModifiersController::class,'destroy'])->name('modifier.delete');
    Route::post('/modifier/updateAll', [ModifiersController::class, 'updateAll'])->name('modifier.updateAll');

    // items Management
    Route::get('/items', [ItemController::class,'index'])->name('items');
    Route::get('/item/create', [ItemController::class,'create'])->name('item.create');
    Route::post('/item/store', [ItemController::class,'store'])->name('item.store');
    Route::get('/item/show/{id}', [ItemController::class,'show'])->name('item.show');
    Route::get('/item/edit/{id}', [ItemController::class,'edit'])->name('item.edit');
    Route::post('/item/update/{id}', [ItemController::class,'update'])->name('item.update');
    Route::get('/item/delete/{id}', [ItemController::class,'destroy'])->name('item.delete');
    Route::post('/item/updateAll', [ItemController::class, 'updateAll'])->name('item.updateAll');
    Route::post('/item/categories', [ItemController::class,'categories'])->name('item.categories');
    Route::post('/item/subcategories', [ItemController::class,'subcategories'])->name('item.subcategories');

    // Transactions
    Route::get('/transactions', [TransactionController::class,'index'])->name('transaction');
    Route::post('/transactions/transactions-list',[TransactionController::class,'anyData'])->name('transaction.anyData');
    Route::post('/transaction/export-report', [TransactionController::class,'export'])->name('transaction.export');


    // Subscription plans
    Route::get('/subscription-plans', [SubscriptionPlanController::class,'index'])->name('subscription_plans');
    Route::get('/subscription-plan/create', [SubscriptionPlanController::class,'create'])->name('subscription_plan.create');
    Route::post('/subscription-plan/store', [SubscriptionPlanController::class,'store'])->name('subscription_plan.store');
    Route::get('/subscription-plan/delete/{id}', [SubscriptionPlanController::class,'destroy'])->name('subscription_plan.delete');
    Route::get('/subscription-plan/show/{id}', [SubscriptionPlanController::class,'show'])->name('subscription_plan.show');
    Route::get('/subscription-plan/edit/{id}', [SubscriptionPlanController::class,'edit'])->name('subscription_plan.edit');
    Route::post('/subscription-plan/update/{id}', [SubscriptionPlanController::class,'update'])->name('subscription_plan.update');
    Route::post('/subscription-plan/anyData', [SubscriptionPlanController::class,'anyData'])->name('subscription_plan.anyData');
    Route::post('/subscription-plan/updateAll', [SubscriptionPlanController::class, 'updateAll'])->name('subscription_plan.updateAll');
    Route::get('/subscription-plan/lang-edit/{parentId}/{langId}', [SubscriptionPlanController::class,'langedit'])->name('subscription_plan.editlang');
    Route::post('/subscription-plan/storeLang', [SubscriptionPlanController::class,'storeLang'])->name('subscription_plan.storeLang');


    // subscription report
    Route::get('/subscription-report',[SubscriptionReportController::class,'index'])->name('subscription_report');
    Route::post('/subscription-report/get-subscription-report-list',[SubscriptionReportController::class,'anyData'])->name('report.subscription.anyData');
    Route::post('/subscription-report/export-subscription-report',[SubscriptionReportController::class,'export_property'])->name('report.subscription.export');

    // revenue report
    Route::get('/revenue-report',[RevenueReportController::class,'index'])->name('revenue_report');
    Route::post('/revenue-report/get-revenue-report-list',[RevenueReportController::class,'anyData'])->name('report.revenue.anyData');
    Route::post('/revenue-report/export-revenue-report',[RevenueReportController::class,'export'])->name('report.revenue.export');



    // Webmaster
    Route::get('/webmaster', [WebmasterSettingsController::class, 'edit'])->name('webmasterSettings');
    Route::post('/webmaster', [WebmasterSettingsController::class, 'update'])->name('webmasterSettingsUpdate');
    Route::post('/webmaster/languages/store', [WebmasterSettingsController::class, 'language_store'])->name('webmasterLanguageStore');
    Route::post('/webmaster/languages/store', [WebmasterSettingsController::class, 'language_store'])->name('webmasterLanguageStore');
    Route::post('/webmaster/languages/update', [WebmasterSettingsController::class, 'language_update'])->name('webmasterLanguageUpdate');
    Route::get('/webmaster/languages/destroy/{id}', [WebmasterSettingsController::class, 'language_destroy'])->name('webmasterLanguageDestroy');
    Route::get('/webmaster/seo/repair', [WebmasterSettingsController::class, 'seo_repair'])->name('webmasterSEORepair');

    Route::post('/webmaster/mail/smtp', [WebmasterSettingsController::class, 'mail_smtp_check'])->name('mailSMTPCheck');
    Route::post('/webmaster/mail/test', [WebmasterSettingsController::class, 'mail_test'])->name('mailTest');



    // featured addons
    Route::get('/featured-addons', [FeaturedAddonsController::class,'index'])->name('featured_addons');
    Route::get('/featured-addon/delete/{id}', [FeaturedAddonsController::class,'destroy'])->name('featured_addon.delete');
    Route::get('/featured-addon/show/{id}', [FeaturedAddonsController::class,'show'])->name('featured_addon.show');
    Route::get('/featured-addon/create', [FeaturedAddonsController::class,'create'])->name('featured_addon.create');
    Route::post('/featured-addon/store', [FeaturedAddonsController::class,'store'])->name('featured_addon.store');
    Route::get('/featured-addon/edit/{id}', [FeaturedAddonsController::class,'edit'])->name('featured_addon.edit');
    Route::post('/featured-addon/update/{id}', [FeaturedAddonsController::class,'update'])->name('featured_addon.update');
    Route::post('/featured-addon/updateAll', [FeaturedAddonsController::class, 'updateAll'])->name('featured_addon.updateAll');
    Route::post('/featured-addon/anyData', [FeaturedAddonsController::class,'anyData'])->name('featured_addon.anyData');
});