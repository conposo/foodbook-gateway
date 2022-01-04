<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\MealsController;
use App\Http\Controllers\MealsDishController;

use App\Http\Controllers\DishController;
use App\Http\Controllers\DishUserController;

use App\Http\Controllers\SettingsController;

use App\Http\Controllers\StaticController;

use App\Http\Controllers\ListController;
use App\Http\Controllers\ListItemsController;

use App\Http\Controllers\ReservationsController;

use App\Http\Controllers\HouseholdController;

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

/*
|--------------------------------------------------------------------------
| Static Web Routes
|--------------------------------------------------------------------------
*/

Auth::routes(['verify', true]);
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::get('category/{category_name}', [StaticController::class, 'category'])->name('category');
Route::get('dish/{slug}', [StaticController::class, 'dish'])->name('dish');
Route::get('restaurant/{slug}', [StaticController::class, 'restaurant'])->name('restaurant');

Route::get('/logout', [Auth\LoginController::class, 'logout'])->name('logout' );


// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth'])->group(function () {
        
    Route::get('/', [MealsController::class, 'index'])->name('home');
    Route::get('/menu', [HomeController::class, 'menu'])->name('menu');

    Route::get('breakfast', [MealsController::class, 'getMeal'])->name('breakfast');
    Route::get('lunch', [MealsController::class, 'getMeal'])->name('lunch');
    Route::get('dinner', [MealsController::class, 'getMeal'])->name('dinner');

    Route::post('meal-dish', [MealsDishController::class, 'store'])->name('meal-dish-add');
    Route::patch('meal-dish/{meal_id}', [MealsDishController::class, 'increaseQuantity'])->name('meal-dish-increase-quantity');
    Route::delete('meal-dish/{meal_id}', [MealsDishController::class, 'destroy'])->name('meal-dish-remove');

    // shopping lists
    Route::get('list/daily', [ListController::class, 'index'])->name('list-daily');
    Route::patch('list', [ListController::class, 'update'])->name('list-update');
    Route::get('list/weekly', [ListController::class, 'weekly'])->name('list-weekly');
    Route::get('list/monthly', [ListController::class, 'monthly'])->name('list-monthly');

    Route::post('list/item', [ListItemsController::class, 'addItem'])->name('list-add-item');
    Route::put('list/item', [ListItemsController::class, 'updateItem'])->name('list-update-item');
    Route::delete('list/item', [ListItemsController::class, 'deleteItem'])->name('list-item-delete');

    // household
    Route::get('household', [HouseholdController::class, 'index'])->name('household');
    Route::post('household', [HouseholdController::class, 'store'])->name('household-new');
    Route::patch('household/{household_id}', [HouseholdController::class, 'update'])->name('household-update');
    Route::post('household/member', [HouseholdController::class, 'storeMember'])->name('household-member-add');
    Route::delete('household/member', [HouseholdController::class, 'removeMember'])->name('household-member-remove');
    Route::patch('household/member/{member_id}', [HouseholdController::class, 'updateMember'])->name('household-member-update');

    // reservations
    Route::get('reservations', [ReservationsController::class, 'index'])->name('reservations');
    Route::get('reservation/{id}', [ReservationsController::class, 'show'])->name('reservation');
    Route::post('reservation', [ReservationsController::class, 'store'])->name('reservation-new');
    Route::patch('reservation/{id}', [ReservationsController::class, 'update'])->name('reservation-update');
    Route::post('reservation/{id}/item', [ReservationsMenuController::class, 'store'])->name('reservation-dish-add');
    Route::patch('reservation/{id}/item', [ReservationsMenuController::class, 'update'])->name('reservation-dish-update');
    Route::delete('reservation/{id}/item', [ReservationsMenuController::class, 'destroy'])->name('reservation-dish-remove');
    // reservation guests
    Route::post('guest', [ReservationsGuestsController::class, 'store'])->name('reservation-guest-new');
    Route::patch('guest/{id}', [ReservationsGuestsController::class, 'update'])->name('reservation-guest-update');
    Route::delete('guest/{id}', [ReservationsGuestsController::class, 'destroy'])->name('reservation-guest-delete');
    // reservation menus
    Route::post('menus', [ReservationsMenusController::class, 'store'])->name('reservation-menu-new');

    // settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
    Route::get('password', [SettingsController::class, 'password'])->name('password');
    Route::patch('settings', [SettingsController::class, 'update'])->name('settings');
    Route::post('settings/save-position', [SettingsController::class, 'save_position'])->name('save-position');
    Route::get('restaurants', [RestaurantAdminController::class, 'ownedRestaurants'])->name('restaurants');

    // User recipes
    Route::get('recipes/{category?}', [DishUserController::class, 'index'])->name('recipes')->middleware(['auth']);
    Route::post('recipes', [DishUserController::class, 'store'])->name('recipe-add');
    Route::get('recipes/{dish_type}/{dish_slug}', [DishUserController::class, 'edit'])->name('recipe-edit');
    Route::patch('recipes/{dish_type}/{dish_id}', [DishUserController::class, 'update'])->name('recipe-update');
    Route::delete('recipes/{dish_type}/{dish_id}', [DishUserController::class, 'destroy'])->name('recipe-delete');
    // User Categories
    Route::post('category', [DishUserController::class, 'category'])->name('user-new-category');
    Route::delete('category', [DishUserController::class, 'category'])->name('user-delete-category');

    /*
    |--------------------------------------------------------------------------
    | Restaurant Admin Web Routes
    |--------------------------------------------------------------------------
    */

    Route::get('restaurant/new', [RestaurantAdminController::class, 'newRestaurant'])->name('restaurant-new');
    Route::post('restaurant/new', [RestaurantAdminController::class, 'newRestaurant'])->name('restaurant-new');
    
    Route::get('restaurant/{slug}/settings', [RestaurantAdminController::class, 'settings'])->name('restaurant-settings');
    Route::get('restaurant/{slug}/edit', [RestaurantAdminController::class, 'edit'])->name('restaurant-edit');
    Route::patch('restaurant/{slug}/edit', [RestaurantAdminController::class, 'update'])->name('restaurant-edit');
    Route::post('restaurant/{restaurant_id}/staff', [RestaurantAdminController::class, 'staff'])->name('restaurant-staff');

    // Restaurants Admin Regions
    Route::post('restaurant/{restaurant_id}/edit/regions', [RestaurantAdminController::class, 'regions'])->name('restaurant-regions');
    Route::delete('restaurant/{restaurant_id}/edit/regions', [RestaurantAdminController::class, 'regions'])->name('restaurant-regions');
    // Restaurants Admin Categories
    Route::post('restaurant/{restaurant_id}/edit/categories', [RestaurantAdminController::class, 'categories'])->name('restaurant-categories');
    Route::delete('restaurant/{restaurant_id}/edit/categories', [RestaurantAdminController::class, 'categories'])->name('restaurant-categories');
    // Restaurants Admin Dishes
    Route::get('restaurant/{slug}/edit/dishes/{category}', [DishController::class, 'index'])->name('restaurant-dishes');
    Route::post('restaurant/{slug}/edit/dishes', [DishController::class, 'store'])->name('restaurant-dishes-add');
    Route::put('restaurant/{slug}/edit/dishes/{category}', [DishController::class, 'update'])->name('restaurant-dishes-edit');
    Route::delete('/dishes/{dish_type}/{dish_id}', [DishController::class, 'destroy'])->name('dish-delete');
    // Restaurants Admin Menu Main
    Route::get('restaurant/{slug}/edit/menu/main/{category}', [RestaurantAdminController::class, 'menuMain'])->name('restaurant-menu-main');
    Route::post('restaurant/{slug}/edit/menu/main/{category}', [RestaurantAdminController::class, 'menuMain'])->name('restaurant-menu-main-add');
    Route::patch('restaurant/{slug}/edit/menu/main', [RestaurantAdminController::class, 'menuMain'])->name('restaurant-menu-main-edit');
    Route::delete('restaurant/{slug}/edit/menu/main', [RestaurantAdminController::class, 'menuMain'])->name('restaurant-menu-main-delete');
    // Restaurants Admin Menu Lunch
    Route::get('restaurant/{slug}/edit/menu/lunch/{category}', [RestaurantAdminController::class, 'menuLunch'])->name('restaurant-menu-lunch');
    Route::post('restaurant/{slug}/edit/menu/lunch/{category}', [RestaurantAdminController::class, 'menuLunch'])->name('restaurant-menu-lunch-add');
    Route::delete('restaurant/{slug}/edit/menu/lunch', [RestaurantAdminController::class, 'menuLunch'])->name('restaurant-menu-lunch-delete');
    // Restaurants Admin Reservations
    Route::get('restaurant/{slug}/reservations', [RestaurantReservationsController::class, 'index'])->name('restaurant-reservations');
    Route::get('restaurant/{slug}/reservation/{reservation_id}', [RestaurantReservationsController::class, 'show'])->name('restaurant-reservation');
    Route::post('restaurant/{slug}/reservation', [RestaurantReservationsController::class, 'add'])->name('restaurant-reservation-add');

    Route::get('restaurant/{slug}/tables', [RestaurantReservationsController::class, 'tables'])->name('restaurant-tables');
    Route::get('restaurant/{slug}/tables/{table}', [RestaurantReservationsController::class, 'table'])->name('restaurant-table');

});

/*
|--------------------------------------------------------------------------
| Not Yet Implemented Web Routes
|--------------------------------------------------------------------------
*/

Route::get('weekly', [MealsController::class, 'weekly'])->name('weekly');
Route::get('monthly', [MealsController::class, 'monthly'])->name('monthly');
