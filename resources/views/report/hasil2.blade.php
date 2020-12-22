<!-- <a href="{{route('report.prestasi')}}"><button class="btn btn-success">Download excel</button></a> -->

<!-- <table border="1">
	<tr>
		<th style="background-color: grey">No</th>
		<th style="background-color: grey">NOMOR PROPOSAL</th>
		<th style="background-color: grey">PENYELENGGARA KEGIATAN</th>
		<th style="background-color: grey">UNIT KEGIATAN</th>
		<th style="background-color: grey">NAMA KEGIATAN</th>
		<th style="background-color: grey">TANGGAL PELAKSANAAN</th>
		<th style="background-color: grey">STATUS </th>
	</tr>
	@php
	 $a = 1;
	 @endphp
	@forelse($data as $dat => $row)
		@if ($row->statuspro == 1 && $row->statuslpj == 0 && CekLengkap::penyelenggara($row->id) == false)	
			<tr style="text-align: center;">
				<td>{{$a++}} </td>
				<td>{{$row->nomor_proposal}} </td>
				<td>{{$row->penyelenggara_kegiatan}}</td>
				@if(isset($row->unit_kegiatan))
				<td>{{$row->unit_kegiatan}}</td>
				@else
				<td>-</td>
				@endif
				<td>{{$row->nama_kegiatan}}</td>
				<td>{{Tanggal::indo($row->tglmulai)}} - {{Tanggal::indo($row->tglselesai)}}</td>
				<td>Proposal disetujui</td>
			</tr>
		@endif

		@if ($row->statuspro == 1 && $row->statuslpj == 0 && CekLengkap::penyelenggara($row->id) == true)
		<tr style="text-align: center;">
				<td>{{$a++}} </td>
				<td>{{$row->nomor_proposal}} </td>
				<td>{{$row->penyelenggara_kegiatan}}</td>
				@if(isset($row->unit_kegiatan))
				<td>{{$row->unit_kegiatan}}</td>
				@else
				<td>-</td>
				@endif
				<td>{{$row->nama_kegiatan}}</td>
				<td>{{Tanggal::indo($row->tglmulai)}} - {{Tanggal::indo($row->tglselesai)}}</td>
				<td>Berkas LPJ lengkap</td>
			</tr>
		@endif

		@if ($row->statuspro == 1 && $row->statuslpj == 1)
		<tr style="text-align: center;">
				<td>{{$a++}} </td>
				<td>{{$row->nomor_proposal}} </td>
				<td>{{$row->penyelenggara_kegiatan}}</td>
				@if(isset($row->unit_kegiatan))
				<td>{{$row->unit_kegiatan}}</td>
				@else
				<td>-</td>
				@endif
				<td>{{$row->nama_kegiatan}}</td>
				<td>{{Tanggal::indo($row->tglmulai)}} - {{Tanggal::indo($row->tglselesai)}}</td>
				<td>LPJ disetujui</td>
			</tr>
		@endif
	@empty
	<tr>
		<td colspan="8" style="text-align: center">Data kosong</td>
	</tr>
	@endforelse
</table>
 -->
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
                @if($req1)
                      <form method="post" action="{{route('report.prestasi')}}">
                      @csrf
                      <input type="hidden" name="tahun" value="{{$req1->tahun}}"></input>
                      <input type="hidden" name="penyelenggara" value="{{$req1->penyelenggara_kegiatan}}"></input>
                      <input type="hidden" name="unit" value="{{$req1->unit}}"></input>
                      <input type="submit" value="Download excel"></input> 
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
						<th >NOMOR PROPOSAL</th>
						<th >PENYELENGGARA KEGIATAN</th>
						<th >UNIT KEGIATAN</th>
						<th >NAMA KEGIATAN</th>
						<th >TANGGAL PELAKSANAAN</th>
						<th >STATUS </th>
                      </tr>
                  </thead>
                  <tbody>
                  	@php
					 $a = 1;
					 @endphp
					@forelse($data as $dat => $row)
						@if ($row->statuspro == 1 && $row->statuslpj == 0 && CekLengkap::penyelenggara($row->id) == false)	
							<tr style="text-align: center;">
								<td>{{$a++}} </td>
								<td>{{$row->nomor_proposal}} </td>
								<td>{{$row->penyelenggara_kegiatan}}</td>
								@if(isset($row->unit_kegiatan))
								<td>{{$row->unit_kegiatan}}</td>
								@else
								<td>-</td>
								@endif
								<td>{{$row->nama_kegiatan}}</td>
								<td>{{Tanggal::indo($row->tglmulai)}} - {{Tanggal::indo($row->tglselesai)}}</td>
								<td>Proposal disetujui</td>
							</tr>
						@endif

						@if ($row->statuspro == 1 && $row->statuslpj == 0 && CekLengkap::penyelenggara($row->id) == true)
						<tr style="text-align: center;">
								<td>{{$a++}} </td>
								<td>{{$row->nomor_proposal}} </td>
								<td>{{$row->penyelenggara_kegiatan}}</td>
								@if(isset($row->unit_kegiatan))
								<td>{{$row->unit_kegiatan}}</td>
								@else
								<td>-</td>
								@endif
								<td>{{$row->nama_kegiatan}}</td>
								<td>{{Tanggal::indo($row->tglmulai)}} - {{Tanggal::indo($row->tglselesai)}}</td>
								<td>Berkas LPJ lengkap</td>
							</tr>
						@endif

						@if ($row->statuspro == 1 && $row->statuslpj == 1)
						<tr style="text-align: center;">
								<td>{{$a++}} </td>
								<td>{{$row->nomor_proposal}} </td>
								<td>{{$row->penyelenggara_kegiatan}}</td>
								@if(isset($row->unit_kegiatan))
								<td>{{$row->unit_kegiatan}}</td>
								@else
								<td>-</td>
								@endif
								<td>{{$row->nama_kegiatan}}</td>
								<td>{{Tanggal::indo($row->tglmulai)}} - {{Tanggal::indo($row->tglselesai)}}</td>
								<td>LPJ disetujui</td>
							</tr>
						@endif
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
