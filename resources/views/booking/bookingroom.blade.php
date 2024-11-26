@extends('layout/secretarylayout')


@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="card-title">จองห้อง</div>
                <p class="card-description">
                    จองห้องประชุม {{$room->roomName}}
                </p>
                @if (session('message'))
                <h6 class="font-weight-bold text-danger">{{session('message')}}</h6>
                @endif
                <form class="forms-sample"  action="/booking/addbooking" method="post" >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="roomnameInput">ชื่อห้องประชุม</label>
                        <input type="text" class="form-control" id="roomnameInput" name="roomName" placeholder="ระบุชื่อห้อง" value="{{$room->roomName}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="roomnameInput">หัวข้อการประชุม</label>
                        <input type="text" class="form-control" id="roomnameInput" name="bookingAgenda" placeholder="ห้องการประชุม" required>
                    </div>
                    <div class="form-group">
                        <label for="roomnameInput">วันที่ใช้ห้อง</label>
                        <input type="date" class="form-control" id="roomnameInput" name="bookingDate" >
                    </div>
                    <div class="form-group">
                        <label for="time">เวลาที่ใช้ห้อง</label>
                        <div class="row" id="time">
                            <div class="col-sm-6">
                                <label for="timestart">เวลาเริ่ม</label>
                                <input type="time" class="form-control" id="timestart" name="bookingTimeStart" >
                            </div>
                            <div class="col-sm-6">
                                <label for="timeend">เวลาสิ้นสุด</label>
                                <input type="time" class="form-control" id="timeend" name="bookingTimeFinish">
                            </div>
                        </div>

                    </div>
                    {{-- userid => 1 --}}
                    <input type="hidden" name="roomId" value="{{$room->roomId}}">
                    <input type="hidden" name="userId" value="{{$userId}}">
                    <input type="submit" class="btn btn-warning" value="จองห้อง">
                </form>
            </div>

        </div>

        </div>
        
    </div>
</div>
@endsection
