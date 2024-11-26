<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Repository\RoomRepository;


class RoomController extends Controller{
    public static function getAllRoom(){
        $roomList = RoomRepository::getAll();
        return view('room/roomall',compact('roomList'));
    }


    public static function getAllroomAlbum(){
        $roomList = RoomRepository::getAll();
        return view('room/roomalbum',compact('roomList'));
    }

    public static function getBookinginRoom($roomId){
        $room = RoomRepository::getRoomById($roomId);
        $bookingList = $room->booking;
        return view('booking/bookinghis',compact('bookingList','room'));
    }
    public static function deleteBookinginRoom($bookingId){
        $booking = DB::table('booking')->where('bookingId',$bookingId)->first();
        $roomId = $booking->roomId;
        // $booking->delete();
        DB::table('booking')->where('bookingId',$bookingId)->delete();
    //   return redirect('/room');
        return redirect('/room/'.$roomId);
    }
    



}
