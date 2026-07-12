

<?php $__env->startSection('title', 'Create Category'); ?>

<?php $__env->startSection('content'); ?>
    <div class="bg-gradient-to-r from-green-600 to-emerald-600 text-white py-12 mb-8">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-4xl font-bold">Create New Category</h1>
                    <p class="text-green-100 mt-2">Add a new skill category to the platform</p>
                </div>
                <a href="/categories" class="btn btn-outline text-white border-white hover:bg-white hover:text-green-700">Back to Categories</a>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 pb-12">
        <div class="max-w-2xl mx-auto">
            <div class="card bg-base-100 shadow-xl border border-gray-200">
                <div class="card-body">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-error mb-6">
                            <div class="flex items-start gap-2">
                                <span>⚠️</span>
                                <ul class="list-disc list-inside">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/categories" class="space-y-6">
                        <?php echo csrf_field(); ?>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">Category Name</span>
                            </label>
                            <input type="text" name="name" value="<?php echo e(old('name')); ?>" placeholder="e.g., Music, Art, Programming" class="input input-bordered input-lg" required />
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-error text-sm mt-2"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">Description</span>
                            </label>
                            <textarea name="description" placeholder="Describe what skills fall under this category..." class="textarea textarea-bordered textarea-lg h-32" required><?php echo e(old('description')); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-error text-sm mt-2"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-control mt-8 flex flex-col sm:flex-row gap-3">
                            <button type="submit" class="btn btn-primary btn-lg font-bold">Create Category</button>
                            <a href="/categories" class="btn btn-outline btn-lg">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ELTE-CS\4th_Sem\web\skillswapApp\skillswap\resources\views/categories/create.blade.php ENDPATH**/ ?>