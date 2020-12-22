@extends('layouts.master')

@section('title')
    <title>Manajemen dana</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Atur Dana Departemen {{ $departemen[0]->nama_departemen }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Atur Dana</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        @card
                            @slot('title')
                            Tambah
                            @endslot
                            
                            @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif
​
                            <form role="form" action="{{ route('aturdana.tambahdana') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tahun</label>
                                    <select class="form-control {{ $errors->has('jumlah') ? 'is-invalid':'' }}" name="tahun" required="">
                                                        <option value="">Pilih</option>
                                                        @php $tahun = date('Y');
                                                             $jarak = $tahun-4;
                                                        @endphp
                                                        @for ($tahun;$tahun >= $jarak;$tahun--)
                                                              <option value="{{ $tahun }}"> {{$tahun}} </option>
                                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Jumlah</label>
                                    <input type="number" name="jumlah"  class="form-control {{ $errors->has('jumlah') ? 'is-invalid':'' }}" required=""></input>
                                </div>
                            @slot('footer')
                                <div class="card-footer">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                            @endslot
                        @endcard
                    </div>
                    <div class="col-md-8">
                        @card
                            @slot('title')
                            List Dana {{ $departemen[0]->nama_departemen }}
                            @endslot
                            
                            @if (session('success'))
                                @alert(['type' => 'success'])
                                    {!! session('success') !!}
                                @endalert
                            @endif
                            @if (session('errur'))
                                @alert(['type' => 'danger'])
                                    {!! session('errur') !!}
                                @endalert
                            @endif
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Tahun</td>
                                            <td>Jumlah</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @forelse ($dana as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->tahun }}</td>
                                            <td>Rp. {{ number_format($row->jumlah,2,",",".") }}</td>
                                            <td>
                                                <a href="#"  data-toggle="modal" data-target="#edit{{$row->id}}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                 <a href="{{ route('dana.detail', $row->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fa fa-eye"></i> Detail
                                                </a>
                                                <a href="{{ route('dana.hapus', $row->id) }}"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </a>
                                            </td>
                                            <!-- modal-edit -->
                                                <div class="modal fade" id="edit{{$row->id}}" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" style="border box-shadow : 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);">
                                                      <div class="modal-content" style="width: 500px">
                                                        <div class="modal-header" style="background-color: #007bff">
                                                          <h4 class="modal-title" style="color: #f8f9fa">Edit Dana</h4>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                          </button>
                                                        </div>
                                                        <div class="modal-body">
                                                          <form role="form" method="POST" action="{{ route('dana.update', $row->id) }}">
                                                          @csrf
                                                          <input type="hidden" name="_method" value="PUT">
                                                            <div class="card-body">
                                                              <div class="form-group">
                                                                <label>Tahun</label>
                                                                <input type="text" class="form-control" id="test" placeholder="masukkan jumlah anggaran" name="tahun" value="{{$row->tahun}}" readonly="">
                                                              </div>
                                                              <div class="form-group">
                                                                <label>Jumlah dana</label>
                                                                <input type="text" class="form-control" id="test" placeholder="masukkan jumlah anggaran" name="dana" value="{{$row->jumlah}}">
                                                              </div>
                                                            </div>
                                                            <!-- /.card-body --> 
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                          <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                          </form>
                                                      </div>
                                                      <!-- /.modal-content -->
                                                    </div>
                                                </div>
                                            <!-- /.modal-edit -->
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @slot('footer')
​                                      {{ $dana->links() }}     
                            @endslot
                        @endcard
                    </div>
                </div>
            </div>
        </section>
    </div>
  @endsection