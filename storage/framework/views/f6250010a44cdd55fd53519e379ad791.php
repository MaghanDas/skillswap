

<?php $__env->startSection('title', 'SkillSwap - Login'); ?>

<?php $__env->startSection('content'); ?>
    <main class="flex items-center justify-center min-h-screen bg-base-200 py-12 px-4 sm:px-6 lg:px-8">
        <div class="card w-full max-w-md bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-3xl font-bold text-center mb-6">Login</h2>

                <?php if(session('status')): ?>
                    <div class="alert alert-success mb-4">
                        <span><?php echo e(session('status')); ?></span>
                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div class="alert alert-error mb-4">
                        <div>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div><?php echo e($error); ?></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Email</span></label>
                        <input type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="email@example.com" class="input input-bordered" required />
                    </div>
                    <div class="form-control mt-4">
                        <label class="label"><span class="label-text">Password</span></label>
                        <input type="password" name="password" placeholder="Password" class="input input-bordered" required />
                    </div>
                    <div class="form-control mt-8">
                        <button type="submit" class="btn btn-primary w-full">Login</button>
                    </div>
                </form>
                <div class="mt-4 text-center">
                    <p>Don't have an account? <a href="<?php echo e(route('register')); ?>" class="link link-primary">Register here</a></p>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ELTE-CS\4th_Sem\web\skillswapApp\skillswap\resources\views/login.blade.php ENDPATH**/ ?>