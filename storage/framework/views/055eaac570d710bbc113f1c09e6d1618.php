

<?php $__env->startSection('title', 'Edit User'); ?>

<?php $__env->startSection('content'); ?>
    <div class="bg-gradient-to-r from-red-600 to-pink-600 text-white py-12 mb-8">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold">✏️ Edit User Role</h1>
            <p class="text-red-100 mt-2">Update user permissions and role assignment</p>
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

                    <form method="POST" action="/users/<?php echo e($user->id); ?>" class="space-y-6">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">👤 Name</span>
                            </label>
                            <input type="text" value="<?php echo e($user->name); ?>" disabled class="input input-bordered input-lg bg-gray-100" />
                            <p class="text-sm text-gray-500 mt-2">(Read-only field)</p>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">📧 Email</span>
                            </label>
                            <input type="text" value="<?php echo e($user->email); ?>" disabled class="input input-bordered input-lg bg-gray-100" />
                            <p class="text-sm text-gray-500 mt-2">(Read-only field)</p>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">🎯 User Role</span>
                            </label>
                            <select name="role" class="select select-bordered select-lg" required>
                                <option value="student" <?php echo e($user->role == 'student' ? 'selected' : ''); ?>>👨‍🎓 Student</option>
                                <option value="teacher" <?php echo e($user->role == 'teacher' ? 'selected' : ''); ?>>👨‍🏫 Teacher</option>
                                <option value="admin" <?php echo e($user->role == 'admin' ? 'selected' : ''); ?>>🔐 Admin</option>
                            </select>
                            <p class="text-sm text-gray-500 mt-2">Select the role to assign to this user</p>
                            <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-error text-sm mt-2"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-control mt-8 flex gap-3">
                            <button type="submit" class="btn btn-primary btn-lg font-bold">💾 Update Role</button>
                            <a href="/users" class="btn btn-outline btn-lg">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ELTE-CS\4th_Sem\web\skillswapApp\skillswap\resources\views/users/edit.blade.php ENDPATH**/ ?>