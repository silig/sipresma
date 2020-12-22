@extends('layouts.master')

@section('title')
    <title>Report Delegasi</title>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <style type="text/css">
    div.dataTables_wrapper {
        width: auto;
        margin: 5px;
    }</style>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Report Delegasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Report</li>
            </ol>
          </div>
        </div>
        <hr>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
	    <div class="row" style="margin-right: 10px; margin-left: 10px;">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                @if($request)
                      <form method="post" action="{{route('report.prestasi')}}">
                      @csrf
                      <input type="hidden" name="tahun" value="{{$request->tahun}}"></input>
                      <input type="hidden" name="jenis" value="{{$request->jenis}}"></input>
                      <input type="hidden" name="tingkat" value="{{$request->tingkat}}"></input>
                      <input type="submit" value="Download excel1"></input> 
                      </form>
                @endif
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 100px;">
                    
                    <h3 class="card-title float-right">
                     
                      </h3>
                    
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
              <table class="table table-hover display nowrap" id="example" style="width:100%" data-page-length="25">
                  <thead>
                      <tr>
                        <th >No</th>
                        <th >STATUS</th>
                        <th >NOMOR PROPOSAL</th>
                        <th >NAMA KEGIATAN</th>
                        <th >TEMPAT KEGIATAN</th>
                        <th >PRESTASI KEGIATAN</th>
                        <th >TINGKAT</th>
                        <th >TANGGAL PELAKSANAAN</th>
                        <th >URL </th>
                        <th >ANGGOTA </th>
                      </tr>
                  </thead>
                  <tbody>
                  @php
                   $a = 1;
                   @endphp
                  @forelse($data as $dat => $row)
                  <tr style="text-align: center;">
                    <td>{{$a++}} </td>
                    @if ($row->statuspro == 0)
                      <td> <a style="background-color: #ff8c00"> Proposal Belum Disetujui </a></td>
                    @endif

                    @if ($row->statuspro == 1 && $row->statuslpj == 0 && CekLengkap::delegasi($row->id) == false)
                      <td><a style="background-color: #3d9970">Proposal Disetujui</a></td>
                    @endif

                    @if ($row->statuspro == 1 && $row->statuslpj == 0 && CekLengkap::delegasi($row->id) == true)
                      <td><a style="background-color: #17a2b8">Berkas LPJ lengkap</a></td>
                    @endif

                    @if ($row->statuspro == 1 && $row->statuslpj == 1)
                      <td><a style="background-color: #dc3545">LPJ disetujui</a></td>
                    @endif

                    @if ($row->statuspro == 2)
                      <td><a style="background-color: black;color: white">Proposal ditolak</a></td>
                    @endif

                    @if ($row->statuspro == 1 && $row->statuslpj == 2)
                      <td><a style="background-color: #605ca8;">LPJ ditolak</a></td>
                    @endif

                    @if ($row->statuspro == 1 && $row->statuslpj == 3)
                      <td><a style="background-color: #adb5bd;color: Black">Tidak terlaksana</a></td>
                    @endif
                    <td>{{$row->nomor_proposal}}</td>
                    <td>{{$row->nama_kegiatan}}</td>
                    <td>{{$row->lokasi_kegiatan}}</td>
                    <td>{{$row->capaian}}</td>
                    <td>{{$row->tingkat}}</td>
                    <td>{{Tanggal::indo($row->tglmulai)}} - {{Tanggal::indo($row->tglselesai)}}</td>
                    <td>{{$row->url}}</td>
                    <td style="text-align: left">@php
                        $anggota= DB::select(DB::raw("SELECT a.id,NIM, Nama, jabatan, nama_departemen, id_proposal FROM anggota_proposal a inner join departemen b on b.id = a.id_departemen where id_proposal= $row->id order by jabatan desc" ));
                        $no = 1;
                            @endphp
                            @foreach($anggota as $comel => $ngah)
                            <b>{{$no++}}. </b>{{ucwords($ngah->Nama)}} - {{ucfirst($ngah->NIM)}}<br>
                            @endforeach</td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="8" style="text-align: center">Data kosong</td>
                  </tr>
                  @endforelse  
                  </tbody>
              </table>

                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

    </section>
    <!-- /.content -->
  </div>
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
        "scrollY": 350,
        "scrollX": true,
        
        
    } );
} );
</script>
@endsection
  