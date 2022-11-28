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
    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5">
        <button class="btn btn-primary fw-semibold" type="button" data-bs-toggle="modal" data-bs-target="#addModal">Add</button>
    </div>
    <div class="card my-3">
        <div class="card-header">Customer Lists</div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end my-3 mx-3">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary fw-semibold" type="submit">Search</button>
            </form>
        </div>
        <div class="card-body">
            <!-- Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true" data-bs-backdrop="static" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content p-4">
                        <form action="{{ route('customer.store')  }}" method="post">
                            @csrf
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addModalLabel">New Customer</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Nama Lengkap</span>
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="nama_customer" id="nama_customer" placeholder=" " value="{{old('nama_customer')}}"required>
                                        <label for="nama_customer">Customer</label>
                                        @error('nama_customer')
                                            <div class="invalid-tooltip">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Alamat</span>
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder=" " value="{{old('alamat')}}" required>
                                        <label for="alamat">Alamat</label>
                                        @error('alamat')
                                            <div class="invalid-tooltip">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
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
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Email</span>
                                    <div class="form-floating">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder=" " value="{{old('email')}}" required>
                                        <label for="email">Email</label>
                                        @error('email')
                                            <span class="invalid-tooltip">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">No. HP</span>
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="hp" id="hp" placeholder=" " value="{{old('hp')}}" required>
                                        <label for="hp">No. HP</label>
                                        @error('hp')
                                            <div class="invalid-tooltip">{{ $message }}</div>
                                        @enderror
                                    </div>
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
            <table class="table table-striped table-responsive">
                <thead class="text-center">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Cust ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">City</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$customer->no_customer}}</td>
                            <td>{{$customer->nama_customer}}</td>
                            <td>{{$customer->alamat}}</td>
                            <td>{{$customer->kota}}</td>
                            <td>{{$customer->email}}</td>
                            <td>{{$customer->hp}}</td>
                            <td>
                                <a  class="btn btn-sm btn-warning" href="{{route('customer.edit',$customer->no_customer)}}"><i class="bi bi-pencil-fill"></i></a>
                                <form action="{{route('customer.destroy',$customer->no_customer)}}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button  class="btn btn-sm btn-danger" type="submit"  onclick="return confirm('Do you want to remove customer {{ $customer->no_customer }} ?')"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    
    
        </div>
    </div>
</div>


@endsection