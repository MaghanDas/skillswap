

<?php $__env->startSection('title', 'SkillSwap - My Skills'); ?>

<?php $__env->startSection('content'); ?>
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-12 mb-8">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold">🎯 My Skills</h1>
                <p class="text-purple-100 mt-2">Manage your teaching and learning skills</p>
            </div>
            <a href="/dashboard" class="btn btn-outline btn-lg text-white border-white hover:bg-white hover:text-purple-600">Back to Dashboard</a>
        </div>
    </div>

    <div class="container mx-auto px-6 pb-12">
        <!-- Add New Skills Section -->
        <div class="card bg-base-100 shadow-xl border border-gray-200 mb-8">
            <div class="card-body">
                <h2 class="card-title text-xl">➕ Add Skills</h2>

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
                    <?php endif; ?>

                <form method="POST" action="/user-skills" class="space-y-6">
                    <?php echo csrf_field(); ?>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold text-lg">🎯 Select Skills to Add</span>
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <?php $__currentLoopData = $allSkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $hasSkill = $userSkills->contains('skill_id', $skill->id);
                                ?>
                                <?php if(!$hasSkill): ?>
                                    <div class="form-control">
                                        <label class="label cursor-pointer justify-start gap-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                                            <input type="checkbox" name="skills[]" value="<?php echo e($skill->id); ?>" class="checkbox checkbox-primary checkbox-lg" />
                                            <div>
                                                <span class="label-text text-base font-semibold"><?php echo e($skill->name); ?></span>
                                                <p class="text-sm text-gray-600"><?php echo e($skill->description); ?></p>
                                                <div class="badge badge-info badge-sm mt-1"><?php echo e($skill->category->name); ?></div>
                                            </div>
                                        </label>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php $__errorArgs = ['skills'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-error text-sm mt-2"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-control">
                        <label class="label cursor-pointer justify-start gap-3">
                            <input type="checkbox" name="is_teaching" value="1" class="checkbox checkbox-lg checkbox-primary" />
                            <span class="label-text font-bold text-lg">👨‍🏫 I want to teach these skills</span>
                        </label>
                        <p class="text-sm text-gray-500 mt-2">Check this if you want to offer these skills as a teacher. Leave unchecked if you want to learn them.</p>
                    </div>

                    <div class="form-control">
                        <button type="submit" class="btn btn-primary btn-lg font-bold">➕ Add Selected Skills</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- My Current Skills -->
        <?php if($userSkills->count() > 0): ?>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Teaching Skills -->
                <div class="card bg-base-100 shadow-xl border border-gray-200">
                    <div class="card-body">
                        <h2 class="card-title text-xl text-green-600">👨‍🏫 Teaching Skills (<?php echo e($userSkills->where('is_teaching', true)->count()); ?>)</h2>
                        <?php if($userSkills->where('is_teaching', true)->count() > 0): ?>
                            <div class="space-y-4">
                                <?php $__currentLoopData = $userSkills->where('is_teaching', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userSkill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                        <div class="flex justify-between items-start mb-2">
                                            <h3 class="font-bold text-lg"><?php echo e($userSkill->skill->name); ?></h3>
                                            <div class="flex gap-2">
                                                <?php if($userSkill->experience_level === 'beginner'): ?>
                                                    <span class="badge badge-ghost">🟢 Beginner</span>
                                                <?php elseif($userSkill->experience_level === 'intermediate'): ?>
                                                    <span class="badge badge-ghost">🟡 Intermediate</span>
                                                <?php else: ?>
                                                    <span class="badge badge-ghost">🔴 Advanced</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <p class="text-gray-600 mb-3"><?php echo e($userSkill->skill->description); ?></p>
                                        <div class="flex gap-2">
                                            <div class="badge badge-primary badge-sm"><?php echo e($userSkill->skill->category->name); ?></div>
                                        </div>
                                        <div class="mt-3 flex gap-2">
                                            <a href="/skills/<?php echo e($userSkill->skill->id); ?>" class="btn btn-sm btn-info">View Skill</a>
                                            <form action="/user-skills/<?php echo e($userSkill->id); ?>" method="POST" class="inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <input type="hidden" name="is_teaching" value="0">
                                                <button type="submit" class="btn btn-sm btn-warning">Switch to Learning</button>
                                            </form>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <p class="text-gray-500 text-center py-6">No teaching skills yet. Add some skills above and check "I want to teach"!</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Learning Skills -->
                <div class="card bg-base-100 shadow-xl border border-gray-200">
                    <div class="card-body">
                        <h2 class="card-title text-xl text-blue-600">📚 Learning Skills (<?php echo e($userSkills->where('is_teaching', false)->count()); ?>)</h2>
                        <?php if($userSkills->where('is_teaching', false)->count() > 0): ?>
                            <div class="space-y-4">
                                <?php $__currentLoopData = $userSkills->where('is_teaching', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userSkill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                        <div class="flex justify-between items-start mb-2">
                                            <h3 class="font-bold text-lg"><?php echo e($userSkill->skill->name); ?></h3>
                                            <div class="flex gap-2">
                                                <?php if($userSkill->experience_level === 'beginner'): ?>
                                                    <span class="badge badge-ghost">🟢 Beginner</span>
                                                <?php elseif($userSkill->experience_level === 'intermediate'): ?>
                                                    <span class="badge badge-ghost">🟡 Intermediate</span>
                                                <?php else: ?>
                                                    <span class="badge badge-ghost">🔴 Advanced</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <p class="text-gray-600 mb-3"><?php echo e($userSkill->skill->description); ?></p>
                                        <div class="flex gap-2">
                                            <div class="badge badge-primary badge-sm"><?php echo e($userSkill->skill->category->name); ?></div>
                                        </div>
                                        <div class="mt-3 flex gap-2">
                                            <a href="/skills/<?php echo e($userSkill->skill->id); ?>" class="btn btn-sm btn-info">View Skill</a>
                                            <form action="/user-skills/<?php echo e($userSkill->id); ?>" method="POST" class="inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <input type="hidden" name="is_teaching" value="1">
                                                <button type="submit" class="btn btn-sm btn-success">Switch to Teaching</button>
                                            </form>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <p class="text-gray-500 text-center py-6">No learning skills yet. Add some skills above without checking "I want to teach"!</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="card bg-base-100 shadow-xl border border-gray-200 text-center">
                <div class="card-body py-12">
                    <p class="text-6xl mb-4">🎯</p>
                    <p class="text-gray-600 text-lg font-semibold">No skills added yet</p>
                    <p class="text-gray-500">Add your first skills using the form above!</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ELTE-CS\4th_Sem\web\skillswapApp\skillswap\resources\views/user_skills/my-skills.blade.php ENDPATH**/ ?>