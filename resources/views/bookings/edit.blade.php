@extends('layouts.main')

@section('title','Booking')

@section('content')

<div class="container p-5 mt-5">
    <form action="{{ route('booking.update',$booking->no_booking)  }}" method="post">
        @method('put')
        @csrf
        <div class="row">
            <div class="input-group mb-3">
                <span class="input-group-text">ID Booking</span>
                <input type="text" class="form-control @error('no_booking') is-invalid @enderror" name="no_booking" id="no_booking" placeholder=" " value="{{ $booking->no_booking }}" required>
                @error('no_booking')
                    <div class="invalid-tooltip">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-group mb-3" hidden>
                <span class="input-group-text">User</span>
                <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder=" " value="{{ auth()->user()->nama_user }}" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Tanggal Booking</span>
                <input type="text" class="form-control" name="tgl_booking" id="tgl_booking" placeholder=" " value="{{ $booking->tgl_booking }}" required>
                @error('tgl_booking')
                    <div class="invalid-tooltip">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-group mb-3 d-flex">
                <span class="input-group-text">Nama Customer</span>
                <select class="form-select" name="no_customer" id="no_customer">
                    @foreach($customers as $customer)
                        @if(old('no_customer',$booking->no_customer)==$customer->no_customer)
                            <option value="{{ $customer->no_customer }}" selected>{{ $customer->nama_customer }}</option>
                        @else
                            <option value="{{ $customer->no_customer }}">{{ $customer->nama_customer }}</option>
                        @endif
                    @endforeach
                </select>
                @error('no_customer')
                    <div class="invalid-tooltip">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Ruang</span>
                <select class="form-select" name="kode_ruang" id="kode_ruang">
                    @foreach($rooms as $room)
                        <option value="{{ $room->kode_ruang }}">{{ $room->nama_ruang }}</option>
                    @endforeach
                </select>
                @error('kode_ruang')
                    <div class="invalid-tooltip">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Tanggal Penggunaan Ruang</span>
                <input type="text" class="form-control" name="tgl_penggunaan_ruang" id="datepicker" value="{{ old('tgl_penggunaan_ruang',$booking->booking_details->value('tgl_penggunaan_ruang')) }}">
                <span class="input-group-text bg-light d-block"><i class="bi bi-calendar3"></i></span>
                @error('tgl_penggunaan_ruang')
                    <div class="invalid-tooltip">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Durasi</span>
                <input type="text" class="form-control" name="lama_booking" id="lama_booking" value="{{ old('lama_booking',$booking->booking_details->value('lama_booking')) }}">
                <span class="input-group-text bg-light d-block"><i class="bi bi-calendar3"></i></span>
                @error('lama_booking')
                    <div class="invalid-tooltip">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn text-light" style="background-color: #606c38;">Save Changes</button>
            <a type="button" href="{{ route('booking.index') }}" class="btn text-light" style="background-color: #93997f;">Cancel</a>
        </div>
    
    </form>
</div>

@endsection