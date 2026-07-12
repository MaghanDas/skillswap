

<?php $__env->startSection('title', 'User Management'); ?>

<?php $__env->startSection('content'); ?>
    <div class="bg-gradient-to-r from-red-600 to-pink-600 text-white py-12 mb-8">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold">👥 User Management</h1>
            <p class="text-red-100 mt-2">Manage all platform users and their roles</p>
        </div>
    </div>

    <div class="container mx-auto px-6 pb-12">
        <div class="card bg-base-100 shadow-xl border border-gray-200">
            <div class="card-body">
                <?php if(isset($users) && count($users) > 0): ?>
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr class="border-b-2 border-gray-300">
                                    <th class="text-lg font-bold">👤 Name</th>
                                    <th class="text-lg font-bold">📧 Email</th>
                                    <th class="text-lg font-bold">🎯 Role</th>
                                    <th class="text-lg font-bold text-center">⚙️ Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="hover:bg-gray-50 border-b border-gray-200">
                                        <td class="font-semibold"><?php echo e($user->name); ?></td>
                                        <td><?php echo e($user->email); ?></td>
                                        <td>
                                            <?php if($user->role === 'admin'): ?>
                                                <span class="badge badge-error badge-lg">🔐 Admin</span>
                                            <?php elseif($user->role === 'teacher'): ?>
                                                <span class="badge badge-info badge-lg">👨‍🏫 Teacher</span>
                                            <?php else: ?>
                                                <span class="badge badge-success badge-lg">👨‍🎓 Student</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="flex gap-2 justify-center">
                                                <a href="/users/<?php echo e($user->id); ?>" class="btn btn-sm btn-info">👁️ View</a>
                                                <a href="/users/<?php echo e($user->id); ?>/edit" class="btn btn-sm btn-warning">✏️ Edit</a>
                                                <form action="/users/<?php echo e($user->id); ?>" method="POST" class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-sm btn-error" onclick="return confirm('Are you sure?')">🗑️ Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-12">
                        <p class="text-5xl mb-4">👥</p>
                        <p class="text-gray-600 text-lg font-semibold">No users found</p>
                        <p class="text-gray-500">There are no users to manage yet</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ELTE-CS\4th_Sem\web\skillswapApp\skillswap\resources\views/users/index.blade.php ENDPATH**/ ?>