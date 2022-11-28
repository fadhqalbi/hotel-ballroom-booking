@extends('layouts.main')

@section('title','Summary')

@section('content')

<div class="container p-5">
    @if(session('status'))
        <div class="alert {{session('status')=='success' ? 'alert-success' : 'alert-danger'}} alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- {{$summary}} -->

    <div class="room p-5" style="background-color: #fcfbf5;">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-sm-3 g-5">
                @foreach($rooms as $room)
                    <div class="col">
                        <div class="card shadow-sm" >
                            <img src="{{ URL::to('/' . $room->foto) }}" class="card-img-top" alt="" width="100%" height="300" >
                            <div class="card-body">
                                <h4 class="card-title">{{ $room->nama_ruang }}</h4>
                                <div class="row align-items-center justify-content-between text-end">
                                    <h6>Rp. {{ number_format(round(100000000/$room->kapasitas_maks)) }},-/pax</h6>
                                </div>
                                <div class="row align-items-center justify-content-between text-end">
                                    <h6>Capacity for {{ $room->kapasitas_maks }} pax</h6>
                                </div>
                                <hr/>
                                <div class="row align-items-center justify-content-between mt-2">
                                    @foreach($room->booking_summary as $sum)
                                        <div class="row justify-content-between">
                                            <h6>{{$sum['bulan_tahun']}}  <i class="bi bi-caret-right-fill"></i>  {{$sum['jumlah_booking_ruang']}} Booking</h6>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

@endsection