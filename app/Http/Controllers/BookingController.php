<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repository\RoomRepository;
use App\Repository\BookingRepository;

use Carbon\Carbon;

class BookingController extends Controller
{

    // input time and information for booking
    public static function getBookingInRoom($roomId){
        $room = RoomRepository::getRoomById($roomId);
        $userId = Auth::user()->userId;
        $bookingList = $room->booking;
        return view('booking/bookingroom',compact('room','userId','bookingList'));
    }

    public static function addBooking(Request $req){
        $bookingAgenda = $req->bookingAgenda;
        $bookingDate = $req->bookingDate;
        $bookingTimeStart = $req->bookingTimeStart ;
        $bookingTimeFinish = $req->bookingTimeFinish;
        $userId = $req->userId;
        $roomId = $req->roomId;

        $dateNow = Carbon::now();
        $dateRaw = $bookingDate." ".$bookingTimeStart;
        $dateSelect = Carbon::parse($dateRaw);
        // $dateSelect->hours();
        // dd($dateNow);
        // can booking
        if($dateSelect->gte($dateNow)){
            $result = BookingRepository::addBooking($bookingAgenda, $bookingDate, $bookingTimeStart, $bookingTimeFinish, $userId, $roomId);
            if($result){
                return redirect('/roombooking');
            }
            return redirect('/booking/'.$roomId)->with('message','ไม่สามารถจองได้เพราะทับเวลาคนอื่น');
        }
        return redirect('/booking/'.$roomId)->with('message','ไม่สามารถจองย้อนหลังได้');



    }
}
