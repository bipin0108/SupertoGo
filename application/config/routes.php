<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'home';
$route['404_override'] = 'home/not_found';
$route['translate_uri_dashes'] = FALSE;
/* ----------------------------------------------------------------------
	                            ADMIN PANEL
-----------------------------------------------------------------------*/

// Change Lang
$route['admin/switchLang/(:any)'] = 'admin/AdminLoginController/switchLang/$1';

//Admin Panel
$route['admin'] = 'admin/AdminLoginController/index';
$route['admin/login'] = 'admin/AdminLoginController/index';
$route['admin/authlogincheck'] = 'admin/AdminLoginController/authlogincheck';
$route['admin/logout'] = 'admin/AdminLoginController/logout';
$route['admin/profile'] = 'admin/AdminLoginController/user_profile';
$route['admin/update-password'] = 'admin/AdminLoginController/change_admin_profile_password_update';
$route['admin/upload-profile'] = 'admin/AdminLoginController/change_photo';
$route['admin/profile-details-update'] = 'admin/AdminLoginController/user_update_profile_data';
$route['admin/i-forgot-my-password'] = 'admin/AdminLoginController/i_forgot_my_password';
$route['admin/reset-password/(:any)'] = 'admin/AdminLoginController/reset_password/$1';
$route['admin/dashboard'] = 'admin/DashboardController/index';

// City
$route['admin/city-list'] = 'admin/CityController/index';
$route['admin/create-city'] = 'admin/CityController/create_city';
$route['admin/add-city'] = 'admin/CityController/add_city';
$route['admin/edit-city/(:any)'] = 'admin/CityController/edit_city/$1';
$route['admin/update-city'] = 'admin/CityController/update_city';
$route['admin/trash-city'] = 'admin/CityController/trash_city';

// Banner
$route['admin/banner-list'] = 'admin/BannerController/index';
$route['admin/create-banner'] = 'admin/BannerController/create_banner';
$route['admin/add-banner'] = 'admin/BannerController/add_banner';
$route['admin/trash-banner'] = 'admin/BannerController/trash_banner';

// Store
$route['admin/store-list'] = 'admin/StoreController/index';
$route['admin/create-store'] = 'admin/StoreController/create_store';
$route['admin/add-store'] = 'admin/StoreController/add_store';
$route['admin/edit-store/(:any)'] = 'admin/StoreController/edit_store/$1';
$route['admin/update-store'] = 'admin/StoreController/update_store';
$route['admin/trash-store'] = 'admin/StoreController/trash_store';

// Category
$route['admin/category-list'] = 'admin/CategoryController/index';
$route['admin/create-category'] = 'admin/CategoryController/create_category';
$route['admin/add-category'] = 'admin/CategoryController/add_category';
$route['admin/edit-category/(:any)'] = 'admin/CategoryController/edit_category/$1';
$route['admin/update-category'] = 'admin/CategoryController/update_category';
$route['admin/trash-category'] = 'admin/CategoryController/trash_category';

// Brand
$route['admin/brand-list'] = 'admin/BrandController/index';
$route['admin/create-brand'] = 'admin/BrandController/create_brand';
$route['admin/add-brand'] = 'admin/BrandController/add_brand';
$route['admin/edit-brand/(:any)'] = 'admin/BrandController/edit_brand/$1';
$route['admin/update-brand'] = 'admin/BrandController/update_brand';
$route['admin/trash-brand'] = 'admin/BrandController/trash_brand';

// Product
$route['admin/product-list'] = 'admin/ProductController/index';
$route['admin/create-product'] = 'admin/ProductController/create_product';
$route['admin/add-product'] = 'admin/ProductController/add_product';
$route['admin/edit-product/(:any)'] = 'admin/ProductController/edit_product/$1';
$route['admin/update-product'] = 'admin/ProductController/update_product';
$route['admin/trash-product'] = 'admin/ProductController/trash_product';
$route['admin/demo-excel'] = 'admin/ProductController/demo_excel';
$route['admin/bulk-product'] = 'admin/ProductController/bulk_product';

// Order
$route['admin/pending-order-list'] = 'admin/OrderController/pending_order_list';
$route['admin/pending-order-list-ajax'] = 'admin/OrderController/pending_order_list_ajax';
$route['admin/pending-order-save-pdf'] = 'admin/OrderController/pending_order_save_pdf';
$route['admin/pending-order-save-excel'] = 'admin/OrderController/pending_order_save_excel';

$route['admin/running-order-list'] = 'admin/OrderController/running_order_list';
$route['admin/running-order-list-ajax'] = 'admin/OrderController/running_order_list_ajax';
$route['admin/running-order-save-pdf'] = 'admin/OrderController/running_order_save_pdf';
$route['admin/running-order-save-excel'] = 'admin/OrderController/running_order_save_excel';

$route['admin/cancelled-order-list'] = 'admin/OrderController/cancelled_order_list';
$route['admin/cancelled-order-list-ajax'] = 'admin/OrderController/cancelled_order_list_ajax';
$route['admin/cancelled-order-save-pdf'] = 'admin/OrderController/cancelled_order_save_pdf';
$route['admin/cancelled-order-save-excel'] = 'admin/OrderController/cancelled_order_save_excel';

$route['admin/complete-order-list'] = 'admin/OrderController/index';
$route['admin/complete-order-list-ajax'] = 'admin/OrderController/complete_order_list_ajax';
$route['admin/complete-order-save-pdf'] = 'admin/OrderController/complete_order_save_pdf';
$route['admin/complete-order-save-excel'] = 'admin/OrderController/complete_order_save_excel';

$route['admin/order-view/(:any)'] = 'admin/OrderController/order_view/$1';
$route['admin/order-cancel'] = 'admin/OrderController/order_cancel';

$route['admin/get_order_detail_by_orderID_ajax'] = 'admin/OrderController/get_order_detail_by_orderID_ajax';
$route['admin/get_nearby_driver_ajax'] = 'admin/OrderController/get_nearby_driver_ajax';
$route['admin/assign_driver_to_order_ajax'] = 'admin/OrderController/assign_driver_to_order_ajax';

// Payment
$route['admin/payment-driver-list'] = 'admin/PaymentController/index';
$route['admin/payment-driver-list-ajax'] = 'admin/PaymentController/payment_driver_list_ajax';
$route['admin/payment-driver-save-pdf'] = 'admin/PaymentController/payment_driver_save_pdf';
$route['admin/payment-driver-save-excel'] = 'admin/PaymentController/payment_driver_save_excel';

$route['admin/payment-txn-list'] = 'admin/PaymentController/payment_txn_list';
$route['admin/payment-txn-list-ajax'] = 'admin/PaymentController/payment_txn_list_ajax';
$route['admin/payment-txn-save-pdf'] = 'admin/PaymentController/payment_txn_save_pdf';
$route['admin/payment-txn-save-excel'] = 'admin/PaymentController/payment_txn_save_excel';

// Brand
$route['admin/time-slot-list'] = 'admin/TimeSlotController/index';
$route['admin/create-time-slot'] = 'admin/TimeSlotController/create_time_slot';
$route['admin/add-time-slot'] = 'admin/TimeSlotController/add_time_slot'; 
$route['admin/trash-time-slot'] = 'admin/TimeSlotController/trash_time_slot';

// Promocode
$route['admin/promocode-list'] = 'admin/PromocodeController/index';
$route['admin/create-promocode'] = 'admin/PromocodeController/create_promocode';
$route['admin/add-promocode'] = 'admin/PromocodeController/add_promocode';
$route['admin/edit-promocode/(:any)'] = 'admin/PromocodeController/edit_promocode/$1';
$route['admin/update-promocode'] = 'admin/PromocodeController/update_promocode';
$route['admin/trash-promocode'] = 'admin/PromocodeController/trash_promocode';

// User
$route['admin/user-list'] = 'admin/UserController/index';

// Delivery Boy
$route['admin/delivery-boy-list'] = 'admin/DeliveryBoyController/index'; 
$route['admin/create-delivery-boy'] = 'admin/DeliveryBoyController/create_delivery_boy';
$route['admin/add-delivery-boy'] = 'admin/DeliveryBoyController/add_delivery_boy';

// Notification
$route['admin/notification-user-list'] = 'admin/NotificationController/index'; 
$route['admin/user-list-ajax'] = 'admin/NotificationController/user_list_ajax'; 
$route['admin/notification-delivery-boy-list'] = 'admin/NotificationController/delivery_boy_list'; 
$route['admin/delivery-boy-list-ajax'] = 'admin/NotificationController/delivery_boy_list_ajax'; 
$route['admin/send-notification'] = 'admin/NotificationController/send_notification';

// Pages
$route['admin/page-list'] = 'admin/PageController/index';
$route['admin/edit-page/(:any)'] = 'admin/PageController/edit_page/$1';
$route['admin/update-page/(:any)'] = 'admin/PageController/update_page/$1';

// Setting
$route['admin/setting'] = 'admin/SettingController/index'; 
$route['admin/update-setting'] = 'admin/SettingController/update_setting'; 

// Ajax 
$route['admin/ajax/getCityByStoreId/(:any)'] = 'admin/AjaxController/getCityByStoreId/$1';
$route['admin/ajax/getBrand'] = 'admin/AjaxController/getBrand';
$route['admin/ajax/addBrand/(:any)'] = 'admin/AjaxController/addBrand/$1';
$route['admin/ajax/userActiveDeactiveStatus'] = 'admin/AjaxController/userActiveDeactiveStatus';
$route['admin/ajax/promocodeActiveDeactiveStatus'] = 'admin/AjaxController/promocodeActiveDeactiveStatus';
$route['admin/ajax/deliveryBoyActiveDeactiveStatus'] = 'admin/AjaxController/deliveryBoyActiveDeactiveStatus';