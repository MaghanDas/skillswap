

<?php $__env->startSection('title', 'SkillSwap - Categories'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-600 to-emerald-600 text-white py-12 mb-12">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold mb-2">🏷️ Categories</h1>
                    <p class="text-green-100">Organize and manage skill categories</p>
                </div>
                <a href="<?php echo e(url('/categories/create')); ?>" class="btn btn-warning btn-lg font-bold">+ Add Category</a>
            </div>
        </div>
    </div>

    <!-- Categories Grid -->
    <div class="container mx-auto px-6 pb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all border border-gray-200">
                    <div class="card-body">
                        <h2 class="card-title text-2xl mb-3">🎯 <?php echo e($category->name); ?></h2>
                        <p class="text-gray-600 mb-4"><?php echo e($category->description); ?></p>
                        
                        <div class="card-actions justify-end mt-6 gap-2">
                            <a href="/categories/<?php echo e($category->id); ?>" class="btn btn-sm btn-info">👁️ View Skills</a>
                            <a href="/categories/<?php echo e($category->id); ?>/edit" class="btn btn-sm btn-primary">Edit</a>
                            <form action="/categories/<?php echo e($category->id); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-error" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php if($categories->isEmpty()): ?>
            <div class="text-center py-16">
                <p class="text-3xl text-gray-400 mb-4">📭</p>
                <p class="text-gray-500 text-lg">No categories yet. Create one to get started!</p>
                <a href="/categories/create" class="btn btn-primary mt-4">Create First Category</a>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ELTE-CS\4th_Sem\web\skillswapApp\skillswap\resources\views/categories/index.blade.php ENDPATH**/ ?>