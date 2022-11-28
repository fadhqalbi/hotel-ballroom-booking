@extends('layouts.main')

@section('title','Customer')

@section('content')

<div class="container p-5 mt-5">
    <form action="{{ route('customer.update',$customer->no_customer)  }}" method="post">
        @method('put')
        @csrf
        <div class="row">
            <div class="input-group mb-3">
                <span class="input-group-text">ID Customer</span>
                <div class="form-floating">
                    <input type="text" class="form-control @error('no_customer') is-invalid @enderror" name="no_customer" id="no_customer" placeholder=" " value="{{old('no_customer',$customer->no_customer)}}" required>
                    <label for="no_customer">Customer</label>
                    @error('no_customer')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Nama Lengkap</span>
                <div class="form-floating">
                    <input type="text" class="form-control" name="nama_customer" id="nama_customer" placeholder=" " value="{{old('nama_customer',$customer->nama_customer)}}"required>
                    <label for="nama_customer">Customer</label>
                    @error('nama_customer')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Alamat</span>
                <div class="form-floating">
                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder=" " value="{{old('alamat',$customer->alamat)}}" required>
                    <label for="alamat">Alamat</label>
                    @error('alamat')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Kota</span>
                <div class="form-floating">
                    <select class="form-select" id="kota" name="kota" value="{{old('alamat',$customer->kota)}}">
                        <option selected class="text-muted" disabled>Pilih Kota</option>
                        <option value="Kota Batu">Kota Batu</option>
                        <option value="Kota Blitar">Kota Blitar</option>
                        <option value="Kota Kediri">Kota Kediri</option>
                        <option value="Kota Madiun">Kota Madiun</option>
                        <option value="Kota Malang">Kota Malang</option>
                        <option value="Kota Mojokerto">Kota Mojokerto</option>
                        <option value="Kota Pasuruan">Kota Pasuruan</option>
                        <option value="Kota Probolinggo">Kota Probolinggo</option>
                        <option value="Kota Surabaya">Kota Surabaya</option>
                    </select>
                    <label for="kota">Kota</label>
                </div>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Email</span>
                <div class="form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder=" " value="{{old('email',$customer->email)}}" required>
                    <label for="email">Email</label>
                    @error('email')
                        <span class="invalid-tooltip">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">No. HP</span>
                <div class="form-floating">
                    <input type="text" class="form-control" name="hp" id="hp" placeholder=" " value="{{old('hp',$customer->hp)}}" required>
                    <label for="hp">No. HP</label>
                    @error('hp')
                        <div class="invalid-tooltip">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success fw-semibold">Save Changes</button>
            <a type="button" href="{{ route('customer.index') }}" class="btn btn-secondary fw-semibold">Cancel</a>
        </div>
        </div>
    </form>
</div>



@endsection