@extends('layouts.main')

@section('title','Customer')

@section('content')

<div class="container p-5">
    @if(session('status'))
        <div class="alert {{session('status')=='success' ? 'alert-success' : 'alert-danger'}} alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <form action="{{route('customer.store')}}" method="post">
        @csrf
        <div class="container container-fluid p-5">
            <h3 class="text-center my-3">NEW CUSTOMER</h3>
            <div class="row">
                <div class="input-group mb-3">
                    <span class="input-group-text">ID Customer</span>
                    <div class="form-floating">
                        <input type="text" class="form-control @error('no_customer') is-invalid @enderror" name="no_customer" id="no_customer" placeholder=" " required>
                        <label for="no_customer">Customer</label>
                        @error('no_customer')
                            <div class="invalid-tooltip">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-group mb-3">
                    <span class="input-group-text">Nama Lengkap</span>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="nama_customer" id="nama_customer" placeholder=" " required>
                        <label for="nama_customer">Customer</label>
                        @error('nama_customer')
                            <div class="invalid-tooltip">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-group mb-3">
                    <span class="input-group-text">Alamat</span>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder=" " required>
                        <label for="alamat">Alamat</label>
                        @error('alamat')
                            <div class="invalid-tooltip">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-group mb-3">
                    <span class="input-group-text">Kota</span>
                    <div class="form-floating">
                        <select class="form-select" id="kota" name="kota">
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
            </div>
            <div class="row">
                <div class="input-group mb-3">
                    <span class="input-group-text">Email</span>
                    <div class="form-floating">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder=" " required>
                        <label for="email">Email</label>
                        @error('email')
                            <span class="invalid-tooltip">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-group mb-3">
                    <span class="input-group-text">No. HP</span>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="hp" id="hp" placeholder=" " required>
                        <label for="hp">No. HP</label>
                        @error('hp')
                            <div class="invalid-tooltip">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{route('customer.index')}}" class="btn text-light" style="background-color: #93997f;" >Back</a>
                <button type="submit" class="btn text-light" style="background-color: #606c38;">Save</button>
            </div>
        </div>
    </form>
</div>


@endsection