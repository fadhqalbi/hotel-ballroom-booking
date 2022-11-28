@extends('layouts.main')

@section('title','Booking')

@section('content')

<div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mt-5 mb-2 mx-3 border-bottom bg-white">    
    <h5>{{ $today }}</h5>
</div>

<div class="container p-3">
    @if(session('status'))
        <div class="alert {{session('status')=='success' ? 'alert-success' : 'alert-danger'}} alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-grid gap-2 d-md-flex justify-content-md-end my-3 mx-3">
        <button class="btn px-3 btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addModal">Add</button>
        <!-- Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true" data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content p-4">
                    <form action="{{ route('booking.store')  }}" method="post">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addModalLabel">New Booking</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group mb-3" hidden>
                                <span class="input-group-text">User</span>
                                <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder=" " value="{{ auth()->user()->nama_user }}" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Tanggal Booking</span>
                                <input type="text" class="form-control" name="tgl_booking" id="tgl_booking" placeholder=" " value="{{ $date }}" required>
                                @error('tgl_booking')
                                    <div class="invalid-tooltip">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Nama Customer</span>
                                <select class="form-select" name="no_customer" id="no_customer">
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->no_customer }}">{{ $customer->nama_customer }}</option>
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
                                <input type="text" class="form-control" name="tgl_penggunaan_ruang" id="datepickerrange">
                                <span class="input-group-text bg-light d-block"><i class="bi bi-calendar3"></i></span>
                                @error('tgl_penggunaan_ruang')
                                    <div class="invalid-tooltip">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success fw-semibold">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>
    
    <table class="table table-striped table-responsive text-center">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Booking ID</th>
                <th scope="col">Tanggal Booking</th>
                <th scope="col">Nama Customer</th>
                <th scope="col">Ruangan</th>
                <th scope="col">Tanggal Penggunaan</th>
                <th scope="col">Durasi</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$booking->no_booking}}</td>
                    <td>{{$booking->tgl_booking}}</td>
                    <td>{{$booking->customer->nama_customer}}</td>
                    @foreach($booking->rooms()->get() as $room)
                        <td>{{$room->nama_ruang}}</td>
                    @endforeach
                    <td>{{ $booking->booking_details->value('tgl_penggunaan_ruang') }}</td>
                    <td>{{ $booking->booking_details->value('lama_booking') }}</td>
                    <td>
                        <!-- <a  class="btn btn-sm btn-warning" href="{{route('booking.edit',$booking->no_booking)}}"><i class="bi bi-pencil-fill"></i></a> -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-{{ $booking->no_booking }}"><i class="bi bi-pencil-fill"></i></button>
                        <!-- Modal -->
                        <div class="modal fade" id="editModal-{{ $booking->no_booking }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" data-bs-backdrop="static" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content p-4">
                                    <form action="{{ route('booking.update',$booking->no_booking)  }}" method="post">
                                        @method('put')
                                        @csrf
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="editModalLabel">New Booking</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">ID Booking</span>
                                                <input type="text" class="form-control @error('no_booking') is-invalid @enderror" name="no_booking" id="no_booking" placeholder=" " value="{{ old('no_booking',$booking->no_booking) }}" readonly>
                                                @error('no_booking')
                                                    <div class="invalid-tooltip">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="input-group mb-3" hidden>
                                                <span class="input-group-text">User</span>
                                                <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder=" " value="{{ auth()->user()->nama_user }}" readonly>
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
                                                <input type="text" class="form-control" name="tgl_penggunaan_ruang" id="text" value="{{ old('tgl_penggunaan_ruang',$booking->booking_details->value('tgl_penggunaan_ruang')) }}">
                                                <span class="input-group-text bg-light d-block" id=><i class="bi bi-calendar3"></i></span>
                                                @error('tgl_penggunaan_ruang')
                                                    <div class="invalid-tooltip">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Durasi</span>
                                                <input type="number" class="form-control" name="lama_booking" id="lama_booking" value="{{ old('lama_booking',$booking->booking_details->value('lama_booking')) }}">
                                                <span class="input-group-text bg-light d-block"><i class="bi bi-calendar3"></i></span>
                                                @error('lama_booking')
                                                    <div class="invalid-tooltip">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success fw-semibold">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        
                        <form action="{{route('booking.destroy',$booking->no_booking)}}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button  class="btn btn-sm btn-danger" type="submit"  onclick="return confirm('Do you want to remove booking {{ $booking->no_booking }} ?')"><i class="bi bi-trash-fill"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>


@endsection