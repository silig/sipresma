​
<?php $__env->startSection('title'); ?>
    <title>Add New Users</title>
<?php $__env->stopSection(); ?>
​
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add New Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('users.index')); ?>">User</a></li>
                            <li class="breadcrumb-item active">Add New</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
​
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
                            
                            <form action="<?php echo e(route('users.store')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="form-group" style="display: none">
                                    <label for="">NIM</label>
                                    <input type="text" name="NIM" class="form-control <?php echo e($errors->has('NIM') ? 'is-invalid':''); ?>" >
                                    <p class="text-danger"><?php echo e($errors->first('NIM')); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Usename</label>
                                    <input type="text" name="username" class="form-control <?php echo e($errors->has('username') ? 'is-invalid':''); ?>" required>
                                    <p class="text-danger"><?php echo e($errors->first('username')); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" class="form-control <?php echo e($errors->has('password') ? 'is-invalid':''); ?>" required>
                                    <p class="text-danger"><?php echo e($errors->first('password')); ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Role</label>
                                    <select name="role" class="form-control <?php echo e($errors->has('role') ? 'is-invalid':''); ?>" required>
                                        <option value="">Pilih</option>
                                        <?php $__currentLoopData = $role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($row->name); ?>"><?php echo e($row->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <p class="text-danger"><?php echo e($errors->first('role')); ?></p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fa fa-send"></i> Simpan
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sipresma\resources\views/users/create.blade.php ENDPATH**/ ?>