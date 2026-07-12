

<?php $__env->startSection('title', 'Schedule Session'); ?>

<?php $__env->startSection('content'); ?>
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-12 mb-8">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold">📅 Schedule New Session</h1>
            <p class="text-purple-100 mt-2">Create a skill exchange session with a teacher or student</p>
        </div>
    </div>

    <div class="container mx-auto px-6 pb-12">
        <div class="max-w-3xl mx-auto">
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

                    <form method="POST" action="/sessions" class="space-y-6">
                        <?php echo csrf_field(); ?>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">Session Title</span>
                            </label>
                            <input type="text" name="title" value="<?php echo e(old('title')); ?>" placeholder="e.g., Learn Guitar Basics" class="input input-bordered input-lg" required />
                            <?php $__errorArgs = ['title'];
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
                            <textarea name="description" placeholder="Describe what will be covered in this session..." class="textarea textarea-bordered textarea-lg h-24" required><?php echo e(old('description')); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-error text-sm mt-2"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="alert alert-info">
                            <span>Students will book this session separately from their own portal.</span>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">🎯 Skill</span>
                            </label>
                            <select name="skill_id" class="select select-bordered select-lg" required>
                                <option disabled <?php echo e(old('skill_id') ? '' : 'selected'); ?>>Select skill</option>
                                <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($skill->id); ?>" <?php echo e(old('skill_id') == $skill->id ? 'selected' : ''); ?>><?php echo e($skill->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['skill_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-error text-sm mt-2"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-bold text-lg">📅 Date</span>
                                </label>
                                <input type="date" name="session_date" value="<?php echo e(old('session_date')); ?>" class="input input-bordered input-lg" required />
                                <?php $__errorArgs = ['session_date'];
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
                                    <span class="label-text font-bold text-lg">⏰ Time</span>
                                </label>
                                <input type="time" name="session_time" value="<?php echo e(old('session_time')); ?>" class="input input-bordered input-lg" required />
                                <?php $__errorArgs = ['session_time'];
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
                                    <span class="label-text font-bold text-lg">⏱️ Duration (min)</span>
                                </label>
                                <input type="number" name="duration" value="<?php echo e(old('duration')); ?>" min="1" placeholder="60" class="input input-bordered input-lg" required />
                                <?php $__errorArgs = ['duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-error text-sm mt-2"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-bold text-lg">📍 Location</span>
                                </label>
                                <input type="text" name="location" value="<?php echo e(old('location')); ?>" placeholder="e.g., Coffee Shop, Online" class="input input-bordered input-lg" required />
                                <?php $__errorArgs = ['location'];
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
                                    <span class="label-text font-bold text-lg">✅ Status</span>
                                </label>
                                <select name="status" class="select select-bordered select-lg">
                                    <option value="pending" <?php echo e(old('status') == 'pending' ? 'selected' : ''); ?>>⏳ Pending</option>
                                    <option value="confirmed" <?php echo e(old('status') == 'confirmed' ? 'selected' : ''); ?>>✅ Confirmed</option>
                                    <option value="completed" <?php echo e(old('status') == 'completed' ? 'selected' : ''); ?>>🎉 Completed</option>
                                    <option value="cancelled" <?php echo e(old('status') == 'cancelled' ? 'selected' : ''); ?>>❌ Cancelled</option>
                                </select>
                                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-error text-sm mt-2"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="form-control mt-8 flex gap-3">
                            <button type="submit" class="btn btn-primary btn-lg font-bold">📅 Create Session</button>
                            <a href="/sessions" class="btn btn-outline btn-lg">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ELTE-CS\4th_Sem\web\skillswapApp\skillswap\resources\views/sessions/create.blade.php ENDPATH**/ ?>