<?php

namespace App\Repository;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class BookingRepository{
    public static function addBooking($bookingAgenda, $bookingDate, $bookingTimeStart, $bookingTimeFinish, $userId, $roomId){


        // $isbooking = Booking::select("select * exists(select * from booking where (booking.bookingTimeStart between $bookingTimeStart and $bookingTimeFinish) or (booking.bookingTimeFinish between $bookingTimeStart and $bookingTimeFinish)
        //     or ( booking.bookingTimeStart < $bookingTimeStart and booking.bookingTimeFinish > $bookingTimeFinish) and booking.roomId = $roomId and booking.bookingDate != $bookingDate) as result");

        // if(!$isbooking){
        //     $booking = new Booking();
        //     $booking->bookingAgenda = $bookingAgenda;
        //     $booking->bookingDate = $bookingDate;
        //     $booking->bookingTimeStart = $bookingTimeStart;
        //     $booking->bookingTimeFinish = $bookingTimeFinish;
        //     $booking->userId = $userId;
        //     $booking->roomId = $roomId;
        //     $result = $booking->save();
        //     return $result;
        // }
        // return false;


        $bookingTimeStart =Carbon::parse($bookingTimeStart)->format('H:i:s');
        $bookingTimeFinish = Carbon::parse($bookingTimeFinish)->format('H:i:s');

        // if(!$isbooking){

        // }
        // return false;
        DB::enableQueryLog();
        $isbooking = DB::select('
            select exists(
                select *
                from booking
                where
                    ((booking.bookingTimeStart between ? and ? and booking.bookingTimeFinish between ? and ?)
                    or
                    (booking.bookingTimeStart < ? and booking.bookingTimeFinish > ?))
                    and booking.roomId = ?
                    and booking.bookingDate = ?
            ) as result ', [$bookingTimeStart, $bookingTimeFinish, $bookingTimeStart, $bookingTimeFinish, $bookingTimeStart, $bookingTimeFinish, $roomId, $bookingDate]);


        // dd($isbooking['0']->result == 0);
        // echo "result ".($isbooking != null);

        if($isbooking['0']->result == 0){
            $booking = new Booking();
            $booking->bookingAgenda = $bookingAgenda;
            $booking->bookingDate = $bookingDate;
            $booking->bookingTimeStart = $bookingTimeStart;
            $booking->bookingTimeFinish = $bookingTimeFinish;
            $booking->userId = $userId;
            $booking->roomId = $roomId;
            $result = $booking->save();
            return $result;
        }
        return false;





    }
    public static function getbookingincurrentDate($roomId) {
        $bookingList = Booking::select(['booking.bookingAgenda,booking.bookingDate,booking.bookingTimeStart,booking.bookingTimeFinish,booking.userId'])
        ->whereRaw('booking.bookingDate = CURRENT_DATE')->where('booking.roomId','=',$roomId)
        ->order('booking.bookingTimeStart','asc');
        return bookingList;
    }
}








?>
