<?php $__env->startSection('title'); ?>
    <title>Manajemen Kategori</title>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/toastr/toastr.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid" >
                <div class="row mb-2" style="margin-left: 20px">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Ganti password</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">hmm</li>
                        </ol>
                    </div>
                </div>
                <hr>
            </div>
        </div>
<!-- <?php if(session('error1')): ?>
        <p class="toastrDefaultError1"></p>                        
<?php endif; ?>
<?php if(session('error')): ?>
        <p class="toastrDefaultError"></p>                        
<?php endif; ?>
<?php if(session('success')): ?>
        <p class="toastrDefaultError"></p>                        
<?php endif; ?> -->
        <section class="content">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center">
                  <div class="col-lg-4 col-6">
                    <div class="card card-primary">
                      <div class="card-header ">
                        <h3 class="card-title" >Change Password</h3>
                      </div>
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
                      <!-- /.card-header -->
                      <!-- form start -->
                      <form role="form" action="<?php echo e(route('gantipassword', encrypt($di))); ?>" method="POST">
                        <div class="card-body">
                         <?php echo csrf_field(); ?>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Old Password</label>
                            <input type="password" name="oldpassword" class="form-control"  placeholder="old password" required="">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">New Password</label>
                            <input type="password" name="newpassword" class="form-control"  placeholder="Password" required="">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Retype New Password</label>
                            <input type="password" name="newpassword1" class="form-control"  placeholder="Password" required="">
                          </div>
                          
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </form>
                    </div>
                  </div>  
                </div>
            </div>
        </section>

    </div>
  <?php $__env->stopSection(); ?>

  <?php $__env->startSection('javascript'); ?>
  <script src="<?php echo e(asset('plugins/toastr/toastr.min.js')); ?>"></script>
<script type="text/javascript">
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    $('.toastrDefaultError1').show(function() {
      toastr.error('password lama salah')
    });
    $('.toastrDefaultError').show(function() {
      toastr.error('password baru tidak sama')
    });
    $('.toastrDefaultSuccess').click(function() {
      toastr.success('password berhasil diganti')
    });
    
  });

</script>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sipresma\resources\views/auth/passwords/gantipassword.blade.php ENDPATH**/ ?>