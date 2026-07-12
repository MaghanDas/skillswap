<?php $__env->startSection('title', 'Edit Skill'); ?>

<?php $__env->startSection('content'); ?>
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-12 mb-8">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold">✨ Edit Skill</h1>
            <p class="text-blue-100 mt-2">Update your skill details and information</p>
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

                    <form method="POST" action="<?php echo e(url('/skills/' . $skill->id)); ?>" enctype="multipart/form-data" class="space-y-6">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">Skill Name</span>
                            </label>
                            <input type="text" name="name" value="<?php echo e(old('name', $skill->name)); ?>" placeholder="e.g., Guitar, Web Development, Photography" class="input input-bordered input-lg" required />
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
                            <textarea name="description" placeholder="Describe what you can teach about this skill..." class="textarea textarea-bordered textarea-lg h-32" required><?php echo e(old('description', $skill->description)); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-error text-sm mt-2"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-bold text-lg">Category</span>
                                </label>
                                <select name="category_id" class="select select-bordered select-lg" required>
                                    <option disabled <?php echo e(old('category_id', $skill->category_id) ? '' : 'selected'); ?>>Select category</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $skill->category_id) == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['category_id'];
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
                                    <span class="label-text font-bold text-lg">Difficulty Level</span>
                                </label>
                                <select name="difficulty" class="select select-bordered select-lg" required>
                                    <option value="beginner" <?php echo e(old('difficulty', $skill->difficulty) == 'beginner' ? 'selected' : ''); ?>>🟢 Beginner</option>
                                    <option value="intermediate" <?php echo e(old('difficulty', $skill->difficulty) == 'intermediate' ? 'selected' : ''); ?>>🟡 Intermediate</option>
                                    <option value="advanced" <?php echo e(old('difficulty', $skill->difficulty) == 'advanced' ? 'selected' : ''); ?>>🔴 Advanced</option>
                                </select>
                                <?php $__errorArgs = ['difficulty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-error text-sm mt-2"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">📷 Skill Image</span>
                            </label>
                            <?php if($skill->image): ?>
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600 mb-2">Current image:</p>
                                    <img src="<?php echo e(asset($skill->image)); ?>" alt="<?php echo e($skill->name); ?>" class="h-40 w-40 object-cover rounded-lg border border-gray-200" />
                                </div>
                            <?php endif; ?>
                            <input type="file" name="image" class="file-input file-input-bordered file-input-lg w-full" accept="image/*" />
                            <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-error text-sm mt-2"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-control mt-8 flex gap-3">
                            <button type="submit" class="btn btn-primary btn-lg font-bold">💾 Update Skill</button>
                            <a href="/skills" class="btn btn-outline btn-lg">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ELTE-CS\4th_Sem\web\skillswapApp\skillswap\resources\views/skills/edit.blade.php ENDPATH**/ ?>