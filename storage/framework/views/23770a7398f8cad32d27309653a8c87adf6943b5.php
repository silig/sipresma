<?php $__env->startSection('content'); ?>
<div class="limiter">
    <div class="container-login100" style="background-image: url('<?php echo e(asset('css_login/images/a.jpg')); ?>');">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="POST" action="<?php echo e(route('login')); ?>">
                
                <?php echo csrf_field(); ?>
                <span class="login100-form-logo" >
                    <img src="<?php echo e(asset('css_login/images/logo.png')); ?>" alt="logo undip" style="width:138px;height:138px;">
                </span>
                <span class="login100-form-title p-b-15 p-t-15" style="color: yellow">
                    SIPRESMA FT
                </span>
                <span class="login100-form-title p-b-27 p-t-0" >
                   <h4> Login </h4>
                </span>
                
                <?php echo csrf_field(); ?>
                <?php if(session('error')): ?>
                    <?php $__env->startComponent('components.alert', ['type' => 'danger']); ?>
                        <?php echo e(session('error')); ?>

                    <?php echo $__env->renderComponent(); ?>
                <?php endif; ?>
                <div class="wrap-input100 validate-input" data-validate = "Enter username">
                    <input type="text"
                        name="username" 
                        class="input100 <?php echo e($errors->has('username') ? ' is-invalid' : ''); ?>" 
                        placeholder="<?php echo e(__('Username')); ?>"
                        value="<?php echo e(old('username')); ?>">
                    <span class="focus-input100"> <?php echo e($errors->first('username')); ?></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input type="password" 
                        name="password"
                        class="input100 <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?> " 
                        placeholder="<?php echo e(__('Password')); ?>">
                    <span class="focus-input100"> <?php echo e($errors->first('password')); ?></span>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit">
                        Login
                    </button>
                </div>

                <div class="text-center p-t-90">
                    
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sipresma\resources\views/auth/login.blade.php ENDPATH**/ ?>