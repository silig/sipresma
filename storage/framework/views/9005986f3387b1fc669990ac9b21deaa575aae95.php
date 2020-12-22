<?php $__env->startSection('title'); ?>
    <title>SIPRESMA</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item ">User</li>
                  <li class="breadcrumb-item active">Edit</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
          <hr>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <?php $__env->startComponent('components.card'); ?>
                            <?php $__env->slot('title'); ?>
                            
                            <?php $__env->endSlot(); ?>
                            
                            <?php if(session('error')): ?>
                                <?php $__env->startComponent('components.alert', ['type' => 'danger']); ?>
                                    <?php echo session('error'); ?>

                                <?php echo $__env->renderComponent(); ?>
                            <?php endif; ?>
                            
                            <form action="<?php echo e(route('users.update', $user->id)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="name" 
                                        value="<?php echo e($user->name); ?>"
                                        class="form-control <?php echo e($errors->has('name') ? 'is-invalid':''); ?>" required>
                                    <p class="text-danger"><?php echo e($errors->first('name')); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" 
                                        value="<?php echo e($user->email); ?>"
                                        class="form-control <?php echo e($errors->has('email') ? 'is-invalid':''); ?>" 
                                        required readonly>
                                    <p class="text-danger"><?php echo e($errors->first('email')); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" 
                                        class="form-control <?php echo e($errors->has('password') ? 'is-invalid':''); ?>">
                                    <p class="text-danger"><?php echo e($errors->first('password')); ?></p>
                                    <p class="text-warning">Biarkan kosong, jika tidak ingin mengganti password</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fa fa-send"></i> Update
                                    </button>
                                </div>
                            </form>
                            <?php $__env->slot('footer'); ?>
​
                            <?php $__env->endSlot(); ?>
                        <?php echo $__env->renderComponent(); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sipresma\resources\views/users/edit.blade.php ENDPATH**/ ?>