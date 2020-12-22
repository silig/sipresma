<?php $__env->startSection('title'); ?>
    <title>Laporan</title>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/toastr/toastr.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>




<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Report Penyelenggaraan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <hr>
    </section>
    <?php if(session('success')): ?>
	                                <?php $__env->startComponent('components.alert', ['type' => 'success']); ?>
	                                    <?php echo session('success'); ?>

	                                <?php echo $__env->renderComponent(); ?>
	                <?php endif; ?>
	                <?php if(session('error')): ?>
	                                <?php $__env->startComponent('components.alert', ['type' => 'danger']); ?>
	                                    <?php echo session('error'); ?>

	                                <?php echo $__env->renderComponent(); ?>
	                <?php endif; ?>

    <center>
    <!-- Main content -->
	    <section class="content col-sm-8" style="margin-left: 15px;margin-right: 15px">
		    <div class="card card-primary ">
	              <div class="card-header" >
	                <a class="card-title" >Pilih kriteria</a>
	              </div>
	              <!-- /.card-header -->
	              <!-- form start -->
	              <form role="form" action="<?php echo e(route('report.penyelenggara.hasil')); ?>" method="post">
                <?php echo csrf_field(); ?>
	                <div class="card-body col-sm-5">
	                  <div class="form-group"> 
	                    <label class="card-title" >Tahun</label>
	                    <select class="form-control" name="tahun" style="text-align-last:center" required="">
                            <option value="">-- Pilih --</option>
                            <?php $tahun = date('Y');
                            $jarak = $tahun-4;
                            ?>
                            <?php for($tahun;$tahun >= $jarak;$tahun--): ?>
                            <option value="<?php echo e($tahun); ?>"> <?php echo e($tahun); ?> </option>
                            <?php endfor; ?>
                        </select>
	                  </div>
                    <div class="form-group">
                      <label class="card-title" >Jenis</label>
                      <select class="form-control" name="jenis" style="text-align-last:center" required="">
                              <option value="">-- Pilih --</option>
                              <option value="semua">SEMUA</option>
                              <option value="lomba"> Lomba</option>
                              <option value="softskill"> Softskill</option>
                              <option value="lainnya"> Lainnya</option>
                      </select>
                    </div>
	                  <div class="form-group"> 
	                    <label class="card-title" >Penyelenggara Kegiatan </label>
	                    	<select name="penyelenggara_kegiatan"  onchange="tes()" class="form-control" style="text-align-last:center" required="">
                                  <option value="" id="pil">-- Pilih --</option>
                                  <option value="semua" id="semua">SEMUA</option>
                                  <option value="BEM" id="bem" >BEM</option>
                                  <option value="Senat" id="senat" >Senat</option>
                                  <option value="UPK" id="upk" >UPK</option>
                                  <option value="Himpunan" id="hmj" >Himpunan</option>
                            </select>
	                  </div>
	                  <div class="form-group" id="UKM" style="text-align-last:center;display: none"> 
	                    <label class="card-title" >Unit Kegiatan UPK </label>
	                        <select name="unit_kegiatan_upk"  class="form-control" >
                                  <option value="semua" id="kintil">Semua</option>
                                  <option value="PRMK" id="prmk" >PRMK</option>
                                  <option value="PMK" id="pmk" >PMK</option>
                                  <option value="IZZATI" id="izzati" >IZZATI </option>
                                  <option value="FST" id="fst" >FST</option>
                                  <option value="MOMENTUM" id="momentum" >MOMENTUM</option>
                                  <option value="PSMT" id="psmt" >PSMT</option>
                            </select>
	                  </div>
	                  <div class="form-group"  id="HM" style="text-align-last:center;display: none"> 
	                    <label class="card-title" >Unit Kegiatan Himpunan </label>
	                    	<select name="unit_kegiatan_hmj"  class="form-control" >
                                  <option value="semua" id="Pilih">Semua</option>
                                  <option value="HMTK" >HMTK</option>
                                  <option value="HMTI"  >HMTI</option>
                                  <option value="HMTP"  >HMTP </option>
                                  <option value="HME"  >HME</option>
                                  <option value="HMM"  >HMM</option>
                                  <option value="HIMASPAL"  >HIMASPAL</option>
                                  <option value="HM Teknik Geodesi"  >HM Teknik Geodesi</option>
                                  <option value="HMA Amogasida"  >HMA Amogasida</option>
                                  <option value="HMTG Mamgadipa"  >HMTG Mamgadipa</option>
                                  <option value="HMS"  >HMS</option>
                                  <option value="HIMASKOM"  >HIMASKOM</option>
                                  <option value="HMTL"  >HMTL</option>
                             </select>
	                  </div>
	                  
	                </div>
	                <!-- /.card-body -->

	                <div class="card-footer">
	                  <button type="submit" class="btn btn-primary">Submit</button>
	                </div>
	              </form>
	            </div>

	    </section>
    <!-- /.content -->
    </center>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('plugins/toastr/toastr.min.js')); ?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    $('.swalDefaultError').show(function() {
      Toast.fire({
        type: 'error',
        title: 'Tidak boleh ada yang kosong'
      })
    });
    $('.toastrDefaultError').show(function() {
      toastr.error('Tidak boleh ada yang kosong')
    });
    
  });

function tes() {
    if (document.getElementById('upk').selected) {

        document.getElementById('UKM').style.display = '';
        document.getElementById('UKM').required = true;

        document.getElementById('HM').style.display = 'none';
        document.getElementById('HM').required = false;

        document.getElementById('pilih').selected = true;
    } else if (document.getElementById('hmj').selected) {

        document.getElementById('HM').style.display = '';
        document.getElementById('HM').required = true;

        document.getElementById('UKM').style.display = 'none';
        document.getElementById('UKM').required = false;

        document.getElementById('kintil').selected = true;
    }
    else if (document.getElementById('bem').selected) {
        document.getElementById('HM').style.display = 'none';
        document.getElementById('UKM').style.display = 'none';
        document.getElementById('HM').required = false;
        document.getElementById('UKM').required = false;
   }
   else if (document.getElementById('senat').selected) {
        document.getElementById('HM').style.display = 'none';
        document.getElementById('UKM').style.display = 'none';

        document.getElementById('HM').required = false;
        document.getElementById('UKM').required = false;
   }
   else if (document.getElementById('pil').selected) {
        document.getElementById('HM').style.display = 'none';
        document.getElementById('UKM').style.display = 'none';

        document.getElementById('HM').required = false;
        document.getElementById('UKM').required = false;
   }
   else if (document.getElementById('semua').selected) {
        document.getElementById('HM').style.display = 'none';
        document.getElementById('UKM').style.display = 'none';

        document.getElementById('HM').required = false;
        document.getElementById('UKM').required = false;
   }
}


</script>

<?php $__env->stopSection(); ?>

  
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sipresma\resources\views/report/penyelenggara.blade.php ENDPATH**/ ?>