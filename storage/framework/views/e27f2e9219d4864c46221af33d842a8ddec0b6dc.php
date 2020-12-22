<?php $__env->startSection('title'); ?>
    <title>LPJ Masuk</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <style type="text/css">
    div.dataTables_wrapper {
        width: auto;
        margin: 5px;
    }</style>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar LPJ yang disetujui</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item ">LPJ</li>
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
                

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 100px;">
                      
                  </div>
                </div>
              </div>
              <?php if(session('error')): ?>
                                <?php $__env->startComponent('components.alert', ['type' => 'danger']); ?>
                                    <?php echo session('error'); ?>

                                <?php echo $__env->renderComponent(); ?>
              <?php endif; ?>
              <?php if(session('success')): ?>
                                <?php $__env->startComponent('components.alert', ['type' => 'success']); ?>
                                    <?php echo session('success'); ?>

                                <?php echo $__env->renderComponent(); ?>
              <?php endif; ?>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover display nowrap" id="example" style="width:100%" data-page-length="25">
                  <thead>
            <tr>
                <th>No</th>
                <th>Action</th>
                <th>Tanggal Pengajuan</th>
                <th>Nomor Proposal</th>
                <th>Nama Kegiatan</th>
                <th>Bentuk Kegiatan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Jumlah Dana Disetujui</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; ?>
        <?php $__empty_1 = true; $__currentLoopData = $lpj; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rew => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($no++); ?></td>
                  <td>
                  <?php if($row->jenis_proposal=='delegasi'): ?>
                      <a href="<?php echo e(route('delegasi.detail', encrypt($row->id) )); ?>"  target="_blank"><button type="button" class="btn btn-default btn-sm"><i class="fas fa-eye"></i></button></a>
                      <div class="btn-group" >
                      
      
                  <?php endif; ?>
                  <?php if($row->jenis_proposal=='penyelenggara'): ?>
                      <a href="<?php echo e(route('penyelenggara.detail', encrypt($row->id) )); ?>" target="_blank"><button type="button" class="btn btn-default btn-sm"><i class="fas fa-eye"></i></button></a>
                      
                  <?php endif; ?>  

                      <!-- modal-approve -->
                                          <div class="modal fade" id="approve<?php echo e($row->id); ?>" style="display: none;" aria-hidden="true">
                                              <div class="modal-dialog modal-sm" style="border box-shadow : 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);">
                                                <div class="modal-content" style="width: 500px">
                                                  <div class="modal-header" style="background-color: #007bff">
                                                    <h4 class="modal-title" style="color: #f8f9fa">Setujui</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">×</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <form role="form" method="get" action="<?php echo e(route('Daftarlpj.approve', encrypt($row->id) )); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <center>Apakah anda yakin ingin mencairkan dana?</center>
                                                      <!-- /.card-body --> 
                                                  </div>
                                                  <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                  </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                              </div>
                                          </div>
                                          <!-- /.modal-edit -->

                                          <!-- modal-tolak -->
                                          <div class="modal fade" id="tolak<?php echo e($row->id); ?>" style="display: none;" aria-hidden="true">
                                              <div class="modal-dialog modal-sm" style="border box-shadow : 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);">
                                                <div class="modal-content" style="width: 500px">
                                                  <div class="modal-header" style="background-color: #dc3545">
                                                    <h4 class="modal-title" style="color: #f8f9fa">Tolak</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">×</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <form role="form" method="POST" action="<?php echo e(route('DaftarMasuk.tolak', encrypt($row->id) )); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="PUT">
                                                      <div class="card-body">
                                                        <div class="form-group">
                                                          <label>Berikan Alasan</label>
                                                          <input type="textbox" class="form-control" id="test" placeholder="" name="alasan" value="">
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
                                          <!-- /.modal-tolak -->                    
                  </td>
                <td><?php echo e(Tanggal::Indo(substr($row->created_at,0,10))); ?></td>
                <td><?php echo e($row->nomor_proposal); ?></td>
                <td><?php echo e($row->nama_kegiatan); ?></td>
                <td><?php echo e($row->bentuk_kegiatan); ?></td>
                <td><?php echo e(Tanggal::Indo($row->tglmulai)); ?></td>
                <td><?php echo e(Tanggal::Indo($row->tglselesai)); ?></td>
                <td>Rp. <?php echo e(number_format($row->danadisetujui,0,",",".")); ?></td>
            </tr>
          
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
            	<td colspan="11" class="text-center">Tidak ada data</td>
			</tr>
        <?php endif; ?>    
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
        "scrollY": 350,
        "scrollX": true,
        
        
    } );
} );
</script>
<?php $__env->stopSection(); ?>
  
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sipresma\resources\views/pengajuanmasuk/lpjdisetujui.blade.php ENDPATH**/ ?>