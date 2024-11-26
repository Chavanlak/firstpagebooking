@extends('layout/adminlayout')

@section('content')
<div class="row">
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">รายการจองห้อง {{$room->roomName}}</h4>
            <p class="card-description">
                รายละเอียดการจองห้อง
            </p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ลำดับที่</th>
                            <th>หัวข้อการประชุม</th>
                            <th>วันที่ใช้งาน</th>
                            <th>เวลาเริ่ม</th>
                            <th>เวลาสิ้นสุด</th>
                            <th>ผู้จอง</th>
                            <th>ลบบทความ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookingList as $booking)
                        <tr>
                            <th>{{$booking->bookingId}}</th>
                            <th>{{$booking->bookingAgenda}}</th>
                            <th>{{$booking->bookingDate}}</th>
                            <th>{{$booking->bookingTimeStart}}</th>
                            <th>{{$booking->bookingTimeFinish}}</th>
                            <th>{{$booking->userId}}</th>
                            <th><a href="{{route('delete',$booking->bookingId)}}" class="btn btn-danger">ลบ{{$booking->bookingId}}</a></th>
                            {{-- <th>{{$booking->roomId}}</th> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
