@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Kategori</title>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <a href="{{ route('kategori.create') }}" class="btn btn-md btn-success">Tambah Data</a>
                        </div>
                        <div class="d-flex">
                            <a href="{{ route('kategori.index') }}" class="btn btn-md btn-secondary mr-2">
                                <i class="fas fa-sync-alt"></i></a>
                            <form action="{{ route('kategori.search') }}" method="GET" class="form-inline">
                                <div class="form-group mr-2">
                                    <input type="text" name="search" class="form-control" placeholder="Cari Barang">
                                </div>
                                <button type="submit" class="btn btn-md btn-primary">Cari</button>
                            </form>
                        </div>
                    </div>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            @php
                                $no = 1; // Inisialisasi nomor urut
                            @endphp
                              @forelse ($kategori as $post)
                                <tr>
                                    <td>$no++</td>
                                    <td>{!! $post->kategori !!}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('kategori.destroy', $post->id) }}" method="POST">
                                            <a href="{{ route('kategori.show', $post->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                            <a href="{{ route('kategori.edit', $post->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data Kategori belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>  
                          {{ $kategori->links() }}
                    </div>
                </div>
            </div>
        </div>  
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script>

</body>
</html>
@endsection