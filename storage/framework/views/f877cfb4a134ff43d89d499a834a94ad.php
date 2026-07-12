

<?php $__env->startSection('title', 'SkillSwap - Skills'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-12 mb-12">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold mb-2">📚 Available Skills</h1>
                    <p class="text-blue-100">Discover and learn from community experts</p>
                </div>
                <a href="/skills/create" class="btn btn-warning btn-lg font-bold">+ Add Skill</a>
            </div>
        </div>
    </div>

    <!-- Skills Grid -->
    <div class="container mx-auto px-6 pb-12">
        <!-- Search Bar -->
        <div class="mb-8">
            <form method="GET" action="/skills" class="flex gap-2">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="🔍 Search skills..." class="input input-bordered input-lg flex-1" />
                <button type="submit" class="btn btn-primary btn-lg font-bold">Search</button>
                <?php if(request('search')): ?>
                    <a href="/skills" class="btn btn-ghost btn-lg">Clear</a>
                <?php endif; ?>
            </form>
            <?php if(request('search')): ?>
                <p class="text-sm text-gray-600 mt-2">Showing results for: <strong><?php echo e(request('search')); ?></strong></p>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all border border-gray-200 overflow-hidden group">
                    <?php if($skill->image): ?>
                        <figure class="h-48 overflow-hidden">
                            <img src="<?php echo e(asset('storage/' . $skill->image)); ?>" alt="<?php echo e($skill->name); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                        </figure>
                    <?php else: ?>
                        <figure class="h-48 bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white text-6xl">
                            📖
                        </figure>
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <h2 class="card-title text-xl font-bold"><?php echo e($skill->name); ?></h2>
                        <p class="text-gray-600 line-clamp-2"><?php echo e($skill->description); ?></p>
                        
                        <div class="flex items-center justify-between mt-4">
                            <div class="flex gap-2">
                                <div class="badge badge-info"><?php echo e($skill->category->name); ?></div>
                                <div class="badge badge-outline"><?php echo e(ucfirst($skill->difficulty)); ?></div>
                            </div>
                        </div>
                        
                        <div class="card-actions justify-end mt-4 gap-2">
                            <a href="/skills/<?php echo e($skill->id); ?>" class="btn btn-sm btn-info">👁️ View</a>
                            <a href="/skills/<?php echo e($skill->id); ?>/edit" class="btn btn-sm btn-primary">✏️ Edit</a>
                            <form action="/skills/<?php echo e($skill->id); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-error" onclick="return confirm('Are you sure?')">🗑️ Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <?php if($skills->isEmpty()): ?>
            <div class="text-center py-16">
                <p class="text-3xl text-gray-400 mb-4">📭</p>
                <p class="text-gray-500 text-lg">No skills yet. Create one to get started!</p>
                <a href="/skills/create" class="btn btn-primary mt-4">Create First Skill</a>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ELTE-CS\4th_Sem\web\assignments\skillswap\resources\views/skills/index.blade.php ENDPATH**/ ?>