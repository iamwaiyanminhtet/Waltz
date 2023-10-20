<?php

use App\Models\SubCategory;
use App\Models\OffersAndCupons;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HeroSectionController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\User\UserBlogController;
use App\Http\Controllers\User\UserCartController;
use App\Http\Controllers\User\UserCommentController;
use App\Http\Controllers\OffersAndCuponsController;
use App\Http\Controllers\ThirdPartyLoginServicesController;
use App\Http\Controllers\User\UserAccountController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\User\UserCategoryController;

// home page
Route::redirect('/', 'home');
Route::get('home',[AuthController::class,'home'])->name('user#home');

 // authentication *can't go back to login and register pages after logging in*
 Route::middleware(['loginCheckAuth'])->group(function() {
    // direct login page
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    // direct register page
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');

      // redirect google consent screen
      Route::get('auth/google',[ThirdPartyLoginServicesController::class,'redirect'])->name('auth#google#redirect');

      // redirect google call back
      Route::get('auth/google/call-back',[ThirdPartyLoginServicesController::class,'callBackGoogle'])->name('auth#google#call-back');

      // manually log in
      Route::post('/manualLogin',[AuthController::class,'manualLogin'])->name('auth#manualLogin');
      // otp code view
      Route::get('auth/emailOtpPage/{loginOtpId}',[AuthController::class,'emailOtpPage'])->name('auth#emailOtpPage');
      // otp code view
      Route::post('auth/emailOtp/{loginOtpId}',[AuthController::class,'emailOtp'])->name('auth#emailOtp');
});

// Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])
// ->group(function () {

// });

// after log in
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])
->group(function () {
    // direct to home page after authenticate (user or admin)
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('admin#dashboard');

    // direct set password page
    Route::get('setPasswordPage/{userId}',[AuthController::class,'setPasswordPage'])->name('auth#setPasswordPage');
    // set password for the user who use third party login
    Route::post('setPasswordPage',[AuthController::class,'setPassword'])->name('auth#setPassword');


    // admin
    Route::middleware(['admin_auth'])->group(function () {

         // home slider
         Route::prefix('admin/homeSliders')->group(function () {
            // create page
            Route::get('createPage',[HeroSectionController::class,'createPage'])->name('admin#homeSliders#createPage');
            // create
            Route::post('create',[HeroSectionController::class,'create'])->name('admin#homeSliders#create');
            // direct list page
            Route::get('list',[HeroSectionController::class,'list'])->name('admin#homeSliders#list');
            // update
            Route::get('update/{sliderId?}',[HeroSectionController::class,'update'])->name('admin#homeSliders#update');
            // delete
            Route::get('delete/{sliderId}',[HeroSectionController::class,'delete'])->name('admin#homeSliders#delete');
        });

        // admin account
        Route::prefix('admin/account')->group(function () {
            // profile
            Route::get('profile',[AdminController::class,'profile'])->name('admin#account#profile');
            // edit
            Route::get('edit',[AdminController::class,'edit'])->name('admin#account#edit');
            // update
            Route::post('update/{userId}',[AdminController::class,'update'])->name('admin#account#update');
            // delete
            Route::get('delete/{userId}',[AdminController::class,'delete'])->name('admin#account#delete');
            // change password page
            Route::get('change/password/page',[AdminController::class,'changePasswordPage'])->name('admin#account#changePasswordPage');
            // change password
            Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#account#changePassword');
            // user list
            Route::get('user/list',[AdminController::class,'userList'])->name('admin#account#userList');
            // list profile
            Route::get('profileViaList/{userId?}',[AdminController::class,'profileViaList'])->name('admin#account#profileViaList');
            // change role
            Route::get('change/role/{userId}',[AdminController::class,'changeRole'])->name('admin#account#changeRole');
        });

        // category & subcategory
        Route::prefix('admin/category')->group(function () {
            // direct create page
            Route::get('createPage',[CategoryController::class,'create'])->name('admin#category#createPage');
            // create category
            Route::post('create',[CategoryController::class,'createCategory'])->name('admin#category#createCategory');
            // direct list page
            Route::get('list',[CategoryController::class,'categoryList'])->name('admin#category#categoryList');
            // update
            Route::get('update/{categoryId?}',[CategoryController::class,'update'])->name('admin#category#update');
            // delete
            Route::get('delete/{categoryId}',[CategoryController::class,'delete'])->name('admin#category#delete');

             // create sub category
             Route::post('create/subcategory',[SubCategoryController::class,'createSubCategory'])->name('admin#category#createSubCategory');
             // direct list page
            Route::get('subCategory/list',[SubCategoryController::class,'subCategoryList'])->name('admin#category#subCategoryList');
            // direct sub category update page
            Route::get('subCategory/update/{id?}',[SubCategoryController::class,'update'])->name('admin#category#subCategoryUpdate');
            Route::get('subCategory/delete/{id}',[SubCategoryController::class,'delete'])->name('admin#category#subCategoryDelete');
        });

        // products
        Route::prefix('admin/product')->group(function () {
            // direct create page
            Route::get('createPage',[ProductController::class,'createPage'])->name('admin#product#createPage');
            // create product
            Route::post('create',[ProductController::class,'create'])->name('admin#product#create');
             // direct list page
             Route::get('list',[ProductController::class,'list'])->name('admin#product#list');
              // update
            Route::get('update/{productId?}',[ProductController::class,'update'])->name('admin#product#update');
            // delete
            Route::get('delete/{productId}',[ProductController::class,'delete'])->name('admin#product#delete');
            // featured
            Route::get('featured/{productId}',[ProductController::class,'featuredProduct'])->name('admin#product#featured');
        });

        // orders
        Route::prefix('admin/order')->group(function () {
            Route::controller(OrderController::class)->group(function () {
                 // order list page
                Route::get('orderList','orderList')->name('admin#order#orderList');

                // view particular page
                Route::get('{userId}/{orderCode}','particularOrder')->name('admin#order#particularOrder');

                // order status change
                Route::get('changeStatus/{orderId}/{state}','changeStatus')->name('admin#order#changeStatus');

                // view order as a web page to save as a pdf
                Route::get('webpage/view/{userId}/{orderCode}','viewOrder')->name('admin#order#viewOrder');

                // download order web page as a pdf
                Route::get('webpage/download/{userId}/{orderCode}','download')->name('admin#order#download');

                // send email to user
                Route::get('send/email/{userId}/{orderCode}','sendmail')->name('admin#order#sendmail');
            });
        });

        // offers & coupon
        Route::prefix('admin/offers')->group(function () {
            // create page
            Route::get('createPage',[OffersAndCuponsController::class,'createPage'])->name('admin#offers#createPage');
            // create
            Route::post('create',[OffersAndCuponsController::class,'create'])->name('admin#offers#create');
             // direct list page
             Route::get('list',[OffersAndCuponsController::class,'list'])->name('admin#offers#list');
             // update
            Route::get('update/{offersId?}',[OffersAndCuponsController::class,'update'])->name('admin#offers#update');
            // delete
            Route::get('delete/{offersId}',[OffersAndCuponsController::class,'delete'])->name('admin#offers#delete');
        });

        // blog
        Route::prefix('admin/blog')->group(function () {
            // crete page
            Route::get('createPage',[BlogController::class,'createPage'])->name('admin#blog#createPage');
            // create new blog
            Route::post('create',[BlogController::class,'create'])->name('admin#blog#create');
            // blog list
            Route::get('list',[BlogController::class,'list'])->name('admin#blog#list');
            // updatePage blog
            Route::get('updatePage/{blogId?}',[BlogController::class,'updatePage'])->name('admin#blog#updatePage');
            // delete blog
            Route::get('delete/{blogId?}',[BlogController::class,'delete'])->name('admin#blog#delete');
        });
    });

});


Route::prefix('customer')->group(function () {
    // categories
    Route::prefix('categories')->group(function() {
        // navbar data (to master page via ajax)
        Route::get('retrieveCategory/ajax',[UserCategoryController::class,'retrieveCategoryToNavbar'])->name('customer#category#retrieveCategory');
    });

    // subcategories
    Route::prefix('subcategories')->group(function () {
        // subcategories
        Route::get('{categoryId}',[UserCategoryController::class,'subcategories'])->name('customer#subcategories');

        // subcategory sorting ajax
        Route::get('sorting/ajax',[UserCategoryController::class,'subcategorySortingAjax'])->name('customer#subcategorySortingAjax');

        // products by sub categories
        Route::get('products/{id}',[UserCategoryController::class,'productBySubcategory'])->name('customer#productBySubcategory');

        // products beneath each subcategories sorting ajax
        Route::get('products/sorting/ajax',[UserCategoryController::class,'subcategoryProductsSortingAjax'])->name('customer#subcategoryProductsSortingAjax');

    });

    // products
    Route::prefix('products')->group(function () {
         // single product view page
        Route::get('{productId}',[UserProductController::class,'displayProduct'])->name('customer#product');

        // all product view page
        Route::get('all/products',[UserProductController::class,'allProducts'])->name('customer#allProducts');
    });

    // cart
    Route::prefix('cart')->group(function () {
        // lead cart list page
        Route::get('cartList',[UserCartController::class,'cartList'])->name('customer#cart#cartList');

        // add to cart from single product page via ajax
        Route::get('addToCart/ajax',[UserCartController::class,'addToCart'])->name('customer#cart#addToCartAjax');

        // update cart items
        Route::get('updateCartItem/ajax',[UserCartController::class,'updateCartItem'])->name('customer#cart#updateCartItemAjax');

        // delete cart items
        Route::get('deleteCartItem/ajax',[UserCartController::class,'deleteCartItem'])->name('customer#cart#deleteCartItemAjax');

        // retrieve cart data to navbar
        Route::get('retrieveCartData/ajax',[UserCartController::class,'retrieveCartData'])->name('customer#cart#retrieveCartDataAjax');

        // order items, when clicks
        Route::get('orderItems/ajax',[UserCartController::class,'orderItems'])->name('customer#cart#orderItemsAjax');
    });

    //blog
    Route::prefix('blog')->group(function () {
        // all blogs
        Route::get('list',[UserBlogController::class,'list'])->name('customer#blog#list');
        // sort by categories via ajax
        Route::get('sortByCategory/ajax',[UserBlogController::class,'sortByCategory'])->name('customer#blog#sortByCategory');
        // sorted blog comments
        Route::get('sortedBlogComments/ajax',[UserBlogController::class,'sortedBlogComments'])->name('customer#blog#sortedBlogComments');
        // single blog
        Route::get('{blogId}',[UserBlogController::class,'singleBlog'])->name('customer#blog#single');
    });

    // comment
    Route::prefix('comment')->group(function () {
        // create new comment
        Route::get('create/ajax',[UserCommentController::class,'create'])->name('customer#comment#create');
    });

    // account
    Route::prefix('account')->group(function () {
        // account page
        Route::get('/profile',[UserAccountController::class,'profile'])->name('customer#account#profile')->middleware('account_auth');
        // update user details
        Route::post('/update',[UserAccountController::class,'update'])->name('customer#account#update');
        // changePassword
        Route::post('changePassword',[UserAccountController::class,'changePassword'])->name('customer#account#changePassword');
    });
});





