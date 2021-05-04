<?php

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
// =========  Admin Home Route =======
// Route::get('/', function () {
//     return view('home');
// });

Auth::routes();

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', 'HomeController@home');
Route::get('/home', 'HomeController@home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

/// Create Question Route With Controller 

Route::get('/addquestion', 'QuestionController@addquestion')->name('admin.addquestion');
Route::post('/questionpost', 'QuestionController@questionpost')->name('admin.question.posts');
Route::get('/question_active/{question_id}', 'QuestionController@question_active')->name('admin.question_active');
Route::get('/edit_question/{question_id}', 'QuestionController@edit_question')->name('admin.edit_question');
Route::post('/edit_questionpost', 'QuestionController@edit_questionpost')->name('admin.edit_questionpost');
Route::get('/delete_question/{question_id}', 'QuestionController@delete_question')->name('admin.delete_question');



/**
 * Display a listing of the resource.
 *
 * AUMLAN
 */

////***************Notification *********/////////

Route::post('/productAlert', 'Admin\ProductController@quantityAlert_notification')->name('admin.productAlert');



////***************POS *********/////////

// Route::get('/pos', 'Admin\posController@index')->name('admin.pos');
// //admin/product_search
// Route::get('/pos/product_search', 'Admin\posController@productSearch')->name('pos.product-search');
// //Route::get('/pos/product_search/{id}', 'Admin\posController@getProduct')->name('pos.product-get');

// //Route::get('/pos', function () {return view('admin/pos/index'); })->name('admin.pos');

Route::get('/pos', 'Admin\posController@index')->name('admin.pos');
//admin/product_search
Route::get('/pos/product_search', 'Admin\posController@productSearch')->name('pos.product-search'); //on click find
Route::get('/pos/filter', 'Admin\posController@productFilter')->name('pos.product-filter'); // on-key search
Route::get('/pos/product_category/{category_id}', 'Admin\posController@productCategory')->name('pos.product_category'); // assemble by catagory
Route::get('/pos/product_brand/{brand_id}', 'Admin\posController@productBrand')->name('pos.product_brand'); // assemble by brand
Route::get('/pos/product_check', 'Admin\posController@productCeheck')->name('pos.product_ceheck'); // assemble by brand
Route::get('/pos/product_featured', 'Admin\posController@productFeatured')->name('pos.product_featured'); // assemble by featured
Route::post('/pos', 'Admin\posController@store')->name('pos.store');
Route::post('/pos/addCustomer', 'Admin\posController@addCustomer')->name('pos.addCustomer');

Route::get('/pos/get_gift_card', 'admin\poscontroller@getgiftcard')->name('pos.getgiftcard');
Route::post('/pos/deletDraft', 'admin\poscontroller@deletedraft')->name('pos.deletdraft');
Route::get('/pos/editDraft', 'admin\poscontroller@editdraft')->name('pos.editdraft');
Route::get('/pos/getCoupon', 'admin\poscontroller@getcoupon')->name('pos.getcoupon');

//Route::get('/pos', function () {return view('admin/pos/index'); })->name('admin.pos');

////***************Product *********/////////

Route::get('admin/Product/add', 'Admin\ProductController@index')->name('admin.addProduct');
Route::post('/searchProduct/{id}', 'Admin\ProductController@SearchProduct');
Route::post('/addProduct', 'Admin\ProductController@addProduct')->name('admin.addProductList');
///
Route::post('/addProductImage', 'Admin\ProductController@addProductImage')->name('admin.addProductImage');
//admin.editProduct
Route::get('admin/edit-product/{id}', 'Admin\ProductController@editproduct')->name('admin.editProduct');
Route::post('/updateProductStandard/{id}', 'Admin\ProductController@updateProductStandard')->name('admin.updateProductStandard');
//updateProductCombo
Route::post('/updateProductCombo/{id}', 'Admin\ProductController@updateProductCombo')->name('admin.updateProductCombo');


Route::get('/deleteProduct/{id}', 'Admin\ProductController@deleteProduct')->name('admin.deleteProduct');

///getAllProduct
Route::get('/getAllProduct', 'Admin\ProductController@getAllProduct')->name('admin.getAllProduct');
//editProductStandard


Route::get('admin/productListTable', 'Admin\ProductController@productListTable');
Route::post('admin/add-productList', 'Admin\ProductController@addproductList');
Route::get('admin/edit-productList/{id}', 'Admin\ProductController@editproductList')->name('admin.edit-productList');
Route::post('admin/edit-productList/{id}', 'Admin\ProductController@updateproductList')->name('admin.edit-productList');
Route::post('admin/delete-productList/{id}', 'Admin\ProductController@deleteproductList')->name('admin.delete-productList');

////***************ProductList *********/////////

// Route::get('admin/productList', function () {
//     return view('admin/product/product');
// })->name('admin.productList');
Route::get('admin/productList', 'Admin\ProductController@productList')->name('admin.productList');

////***************product Catagory*********/////////\

Route::get('admin/productCategory', function () {
    return view('admin/product/productCatagory');
})->name('admin.productCategory');
Route::get('admin/productCategoryListTable', 'Admin\ProductController@productCategoryListTable');

Route::post('/admin/add-productCategory', 'Admin\ProductController@addProductCategory');

Route::get('/admin/edit-productCategory/{id}', 'Admin\ProductController@editProductCategory')->name('admin.edit-productCategory');

Route::post('/admin/edit-productCategory/{id}', 'Admin\ProductController@updateProductCategory')->name('admin.edit-productCategoryList');

Route::post('/admin/delete-category/{id}', 'Admin\ProductController@deleteProductCategory')->name('admin.delete-productCategory');



////***************Supplier *********/////////


Route::get('admin/addSupplier', function () {
    return view('admin/supplier/supplier');
})->name('admin.addSupplier');

Route::get('admin/supplierListTable', 'Admin\SupplierController@supplierListTable');
Route::post('admin/add-supplierList', 'Admin\SupplierController@addSupplierList');

Route::get('admin/edit-supplierList/{id}', 'Admin\SupplierController@editSupplierList')->name('admin.edit-supplierList');

Route::post('admin/edit-supplierList/{id}', 'Admin\SupplierController@updateSupplierList')->name('admin.edit-supplierList');

Route::post('admin/delete-supplierList/{id}', 'Admin\SupplierController@deleteSupplierList')->name('admin.delete-supplierList');



////*************Product Brand********************///////\

Route::get('admin/productBrand', 'BrandController@index')->name('admin.productBrand');
Route::get('/admin/productCategoryList', 'BrandController@show');
//Route::get('/admin/productCategoryListTable', 'Admin\ProductController@productCategoryListTable');
Route::post('/admin/add-productBrand', 'BrandController@addProductCategory');

Route::post('/admin/delete-brand/{id}', 'BrandController@deleteProductCategory')->name('admin.delete-productCategory');


Route::get('/admin/edit-productBrand/{id}', 'BrandController@editProductCategory')->name('admin.edit-productCategory');

Route::post('/admin/edit-productBrand/{id}', 'BrandController@updateProductCategory')->name('admin.edit-productCategoryList');
//Route::get('admin/productBrand', function () {
//    return view('admin/brand/productBrand');
//})->name('admin.productBrand');


////*************Setting ********************///////

Route::get('/setting', 'SettingController@index')->name('admin.setting');
Route::post('/setting/store', 'SettingController@store')->name('setting.store');


////*************Profile ********************///////

Route::get('general/profile', 'Admin\ProfileController@index')->name('admin.profile');
//Route::post('/setting/store', 'SettingController@store')->name('setting.store');


////***************Expense *********/////////

Route::get('admin/addExpense', 'Admin\ExpenseController@index')->name('admin.addExpense');

Route::get('admin/expenseListTable', 'Admin\ExpenseController@expenseListTable');
Route::post('admin/add-expenseList', 'Admin\ExpenseController@addExpenseList');
Route::get('admin/edit-expenseList/{id}', 'Admin\ExpenseController@editExpenseList')->name('admin.edit-expenseList');
Route::post('admin/edit-expenseList/{id}', 'Admin\ExpenseController@updateExpenseList')->name('admin.edit-expenseList');
Route::post('admin/delete-expenseList/{id}', 'Admin\ExpenseController@deleteExpenseList')->name('admin.delete-expenseList');

Route::get('admin/expenseList', 'Admin\ExpenseController@index')->name('admin.expenseList');



////***************Expense Catagory*********/////////

Route::get('admin/expenseCategory', function () {
    return view('admin/expense/expenseCatagory');
})->name('admin.expenseCategory');
Route::get('admin/expenseCategoryListTable', 'Admin\ExpenseController@expenseCategoryListTable');

Route::post('/admin/add-expenseCategoryList', 'Admin\ExpenseController@addExpenseCategoryList');
Route::get('/admin/edit-expenseCategoryList/{id}', 'Admin\ExpenseController@editExpenseCategoryList')->name('admin.edit-expenseCategoryList');
Route::post('/admin/edit-expenseCategoryList/{id}', 'Admin\ExpenseController@updateExpenseCategoryList')->name('admin.edit-expenseCategoryList');
Route::post('/admin/delete-expenseCategoryList/{id}', 'Admin\ExpenseController@deleteExpenseCategoryList')->name('admin.delete-expenseCategoryList');


////***************User management*********/////////
//Route::get('admin/expenseListTable', 'Admin\ExpenseController@expenseListTable');
Route::post('/add-user', 'AddUserController@addUser')->name('admin.addUser');

////***************Return Purchase*********/////////















/**
 * Customer management
 *
 * Shaon Ahmed
 */

Route::get('/customer', 'customerController@getIndex');
Route::get('/customer/data', 'customerController@getData');
Route::post('/customer/store', 'customerController@postStore');
Route::get('/customer/edit/{id}', 'customerController@editData');
Route::post('/customer/update/{id}', 'customerController@postUpdate');
Route::get('/customer/delete/{id}', 'customerController@Delete');
//  --------------------------------SalesRoute--------------------
Route::get('/sales', 'Admin\salesController@getIndex');
Route::get('/sales/data', 'Admin\salesController@getData');
Route::get('/sales/add', 'Admin\salesController@addsale')->name('add.sale');
Route::get('/sales/import', 'Admin\salesController@importsale')->name('edit');
Route::post('/search', 'Admin\salesController@Search');

Route::get('/pos/product_ceheck', 'Admin\salesController@productCeheck');
Route::get('/pos/get_gift_card', 'Admin\salesController@gift');



Route::get('/find/{id}', 'Admin\salesController@Find');


//  --------------------------------SalesRouteend--------------------

// ------------------giftroute--------------
Route::get('/giftcard', 'Admin\salesController@getGiftcard');
Route::get('/giftcard/data', 'Admin\salesController@giftcard');
Route::get('/giftcard/edit/{id}', 'Admin\salesController@gifteditData');
Route::post('/gift/store', 'Admin\salesController@giftStore');
Route::post('/gift/update/{id}', 'Admin\salesController@postUpdate');

Route::get('/gift/delete/{id}', 'Admin\salesController@giftDelete');
Route::get('/item/delete/{id}', 'Admin\salesController@sDelete');

// -----------------------giftroutrend-------------
//Coupon.....................
Route::get('/coupon', 'Admin\salesController@getCoupon');
Route::get('/coupon/data', 'Admin\salesController@getcouponData');
Route::post('/coupon/store', 'Admin\salesController@couponStore');
Route::get('/coupon/delete/{id}', 'Admin\salesController@couponDelete');
Route::get('/coupon/edit/{id}', 'Admin\salesController@couponeditData');
Route::post('/coupon/update/{id}', 'Admin\salesController@dataUpdate');


//endcoupon...........................
Route::post('/payment', 'Admin\salesController@payment')->name('payment');

Route::get('/sale/delete/{id}', 'Admin\salesController@saleDelete');
Route::get('/sale/editdata/{id}', 'Admin\salesController@saleEdit');
Route::post('/updatesale/{id}', 'Admin\salesController@saleUpdate');
Route::get('/productsale/delete/{id}', 'Admin\salesController@productsaleDelete');




Route::get('/delivary', 'Admin\salesController@getDelivary');
Route::get('/delivary/data', 'Admin\salesController@getdelivaryData');


/**
 *  -Product Delivary-- 
 *
 * Ashraful Alam
 */

// Route::get('/delivary', 'Admin\salesController@getDelivary');
// Route::get('/delivary/data', 'Admin\salesController@getdelivaryData');

// Route::get('/delivary', 'Admin\salesController@getDelivary');
// Route::get('/delivary/data', 'Admin\salesController@getdelivaryData');


Route::get('/delivery', 'Admin\salesController@getDelivery');
Route::get('/delivery/data', 'Admin\salesController@getdeliveryData');

Route::get('/delivery/{id}/edit', 'Admin\salesController@editDeliveryData');
Route::patch('/delivery/{id}', 'admin\salescontroller@updatedeliverydata')->name('delivery.update');
Route::delete('/delivery/{id}', 'Admin\salesController@deleteDeliveryData');


////************** Biller Start ********////

Route::get('admin/billers', 'Admin\BillerController')->name('admin.billers');
Route::resource('admin/biller-operations', 'Admin\BillerController');

////************** Biller End ********////





/**
 *  --warehouse-- 
 *
 * Ashiq Haque
 */
Route::get('/warehouse', 'warehouse\WarehouseController@index')->name('warehouse');
Route::get('/getWarehouse', 'warehouse\WarehouseController@getWarehouses')->name('warehouse.get'); // to get all warehouse by ajax
Route::get('/deleteWarehouse/{delete_id}', 'warehouse\WarehouseController@deleteWarehouse')->name('warehouse.delete');
Route::post('/updateWarehouse/{update_id}', 'warehouse\WarehouseController@updateWarehouse')->name('warehouse.update');
Route::get('/findWarehouse/{find_id}', 'warehouse\WarehouseController@findWarehouse')->name('warehouse.find');
Route::post('/warehouse', 'warehouse\WarehouseController@addWarehouse')->name('warehouse.add');



/**
 *  --Purchase-- 
 *
 * Ashiq Haque
 */
Route::get('/purchase', 'purchase\PurchaseController@index')->name('purchase');
Route::get('/addPurchase', 'purchase\PurchaseController@addPurchase')->name('purchase.add');
Route::post('/addPurchase', 'purchase\PurchaseController@store')->name('purchase.store');
Route::get('/getProductToPurchase', 'purchase\PurchaseController@searchProducts')->name('purchase.productSearch'); // to search product by ajax
Route::get('/findProduct/{find_id}', 'purchase\PurchaseController@findProduct')->name('purchase.find');

Route::get('admin/purchaseList', 'purchase\PurchaseController@purchaseList')->name('admin.purchaseList');

// admin.editPurchase
// admin.deletePurchase
Route::get('admin/edit-purchase/{id}', 'purchase\PurchaseController@editPurchase')->name('admin.editPurchase');
Route::post('/update-Purchase/{id}', 'purchase\PurchaseController@updatePurchase')->name('admin.deletePurchase');


// get add_payment_modal
Route::get('/purchase/add-payment-modal/{id}', 'purchase\purchasecontroller@add_payment_modal')->name('admin.addpaymentmodal');
Route::patch('/purchase/add-payment/{id}', 'purchase\purchasecontroller@add_payment')->name('admin.addpayment');



/*Route::get('/deleteWarehouse/{delete_id}', 'warehouse\WarehouseController@deleteWarehouse')->name('warehouse.delete');
Route::post('/updateWarehouse/{update_id}', 'warehouse\WarehouseController@updateWarehouse')->name('warehouse.update');
Route::post('/warehouse', 'warehouse\WarehouseController@addWarehouse')->name('warehouse.add'); */

//********************Search************************

//Route::post('/search', 'purchase\PurchaseController@Search');
//Route::get('/find/{id}', 'AdjustmentController@Find');



/**
 * Display a listing of the resource.
 *
 * EMRAN HOSSAIN
 */


//Add Adjustment

Route::get('/add_Adjustment', 'AdjustmentController@index');
Route::post('/warehouse/value', 'AdjustmentController@searchState');
Route::post('/search', 'AdjustmentController@Search');
Route::get('/find/{id}', 'AdjustmentController@Find');
Route::post('/admin/add-productWarehouse', 'AdjustmentController@addProductCategory');
Route::get('/Adjustment/list', 'AdjustmentController@adjustmentList');

//Stock Count
Route::get('/stock_count', 'StockcountController@index');
Route::post('/admin/stock_count', 'StockcountController@addStockCount');
Route::get('/admin/stock_countList', 'StockcountController@show');



// Create Question Route With Controller 
Route::post('/answerpost', 'AnswerController@answerpost')->name('user.answerpost');
// Create  View Answer and Question route and Controller
Route::get('/view_answer', 'QuestionViewController@view_answer')->name('user.view_answer');
// Create User Route and controller 
Route::get('/users', 'HomeController@users')->name('admin.users');
// ===== Delete User Route and Controller ===== //
Route::get('/user_delete/{user_id}', 'HomeController@user_delete')->name('admin.user_delete');
// =====  User Edit Route and Controller ===== //
Route::get('/user_edit/{user_id}', 'HomeController@user_edit')->name('admin.user_edit');
Route::post('/edit_user_post', 'HomeController@edit_user_post')->name('admin.edit_user_post');
// Add User method and controller 
Route::get('/add_user', 'AddUserController@index')->name('admin.add_user');
Route::post('/userpost', 'AddUserController@userpost')->name('admin.userpost');
// ==== Create Edit Profile Route and Controller ==== ///

Route::get('/editprofile', 'HomeController@editprofile')->name('admin.editprofile');
Route::post('/editprofilepost', 'HomeController@editprofilepost')->name('admin.editprofilepost');

// ============= Create Category Route and Controller =====//
Route::get('/category', 'CategoryController@index')->name('admin.category');
Route::post('/categorypost', 'CategoryController@categorypost')->name('admin.categorypost');
Route::get('/active_category/{category_id}', 'CategoryController@active_category')->name('admin.active_category');
Route::get('/edit_category/{category_id}', 'CategoryController@edit_category')->name('admin.edit_category');
Route::post('/edit_categorypost', 'CategoryController@edit_categorypost')->name('admin.edit_categorypost');
Route::get('/delete_category/{category_id}', 'CategoryController@delete_category')->name('admin.delete_category');
// ========== Create Route and Controller For App Info ==========//
Route::get('/appinfo', 'AppInfoController@index')->name('admin.appinfo');
Route::post('/appinfopost', 'AppInfoController@appinfopost')->name('admin.appinfopost');
Route::get('/active_app/{app_id}', 'AppInfoController@active_app')->name('admin.active_app');
Route::get('/edit_app/{app_id}', 'AppInfoController@edit_app')->name('admin.edit_app');
Route::post('/editinfopost', 'AppInfoController@editinfopost')->name('admin.editinfopost');
Route::get('/delete_app/{app_id}', 'AppInfoController@delete_app')->name('admin.delete_app');