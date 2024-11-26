<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;


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

// Route::group(['prefix'=>'booking'],function(){
//     Route::get('/',[BookingController::class,'roomListBooking']);
//     Route::get('/{roomId}',[BookingController::class,'roomBookingInfo']);
//     Route::post('/addbooking',[BookingController::class,'roombookingadd']);
// });


// before login
Route::group(['middleware'=>'guest'],function(){
    Route::get('/register',[AuthController::class,'register']);
    Route::post('/registerpost',[AuthController::class,'registerPost']);

    Route::get('/login',[AuthController::class,'login'])->name('login');
    Route::post('/loginpost',[AuthController::class,'loginPost']);

    Route::get('/login/{roomId}',[AuthController::class,'loginRoomId']);
    Route::post('/loginpostroomid',[AuthController::class,'loginPostRoomId']);


    Route::get('/',[RoomController::class,'getAllroomAlbum']);



});

// affter login
Route::group(['middleware'=>'auth'],function(){

    Route::get('/roombooking',[RoomController::class,'getAllroomAlbum']);
    Route::get('/home',[AuthController::class,'home']);
    Route::get('/logout',[AuthController::class,'logout']);

});


Route::group(['prefix'=>'booking','middleware'=>'BookingRoom'],function(){
    Route::get('/{roomId}',[BookingController::class,'getBookingInRoom']);
    Route::post('/addbooking',[BookingController::class,'addBooking']);

});





Route::group(['prefix'=>'room'],function(){
    Route::get('/',[RoomController::class,'getAllRoom']);
    Route::get('/{roomId}',[RoomController::class,'getBookinginRoom']);
});

Route::get('delete/{bookingId}',[RoomController::class,'deleteBookinginRoom'])->name('delete');


