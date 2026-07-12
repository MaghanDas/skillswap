

<?php $__env->startSection('title', 'SkillSwap - <?php echo e($user->name); ?> Profile'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-600 to-blue-600 text-white py-12 mb-12">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-6">
                    <div class="avatar">
                        <div class="w-20 h-20 rounded-full ring ring-white ring-offset-4 ring-offset-green-600">
                            <img src="https://i.pravatar.cc/80?u=<?php echo e($user->id); ?>" alt="<?php echo e($user->name); ?>" />
                        </div>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold mb-2"><?php echo e($user->name); ?></h1>
                        <div class="flex items-center gap-4">
                            <span class="badge badge-warning badge-lg"><?php echo e(ucfirst($user->role)); ?></span>
                            <?php if($avgRating > 0): ?>
                                <div class="flex items-center gap-2">
                                    <div class="rating rating-sm">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <input type="radio" class="mask mask-star-2 bg-yellow-400" <?php echo e($i <= round($avgRating) ? 'checked' : ''); ?> disabled />
                                        <?php endfor; ?>
                                    </div>
                                    <span class="text-yellow-200"><?php echo e(number_format($avgRating, 1)); ?> (<?php echo e($reviews->count()); ?> reviews)</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <a href="/users" class="btn btn-outline btn-lg text-white border-white hover:bg-white hover:text-green-600">Back to Users</a>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->role === 'admin'): ?>
                            <a href="/users/<?php echo e($user->id); ?>/edit" class="btn btn-warning btn-lg font-bold">Edit Role</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="container mx-auto px-6 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="card bg-gradient-to-br from-blue-50 to-blue-100 shadow-md p-6">
                        <div class="text-3xl font-bold text-blue-600"><?php echo e($completedSessions); ?></div>
                        <p class="text-gray-600 text-sm mt-2">Completed Sessions</p>
                    </div>
                    <div class="card bg-gradient-to-br from-green-50 to-green-100 shadow-md p-6">
                        <div class="text-3xl font-bold text-green-600"><?php echo e($upcomingSessions); ?></div>
                        <p class="text-gray-600 text-sm mt-2">Upcoming Sessions</p>
                    </div>
                    <div class="card bg-gradient-to-br from-purple-50 to-purple-100 shadow-md p-6">
                        <div class="text-3xl font-bold text-purple-600"><?php echo e($teachingSkills->count() + $learningSkills->count()); ?></div>
                        <p class="text-gray-600 text-sm mt-2">Total Skills</p>
                    </div>
                </div>

                <!-- Teaching Skills -->
                <?php if($teachingSkills->count() > 0): ?>
                    <div class="card bg-base-100 shadow-xl border border-gray-200">
                        <div class="card-body">
                            <h3 class="card-title text-xl text-green-600">👨‍🏫 Teaching Skills</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <?php $__currentLoopData = $teachingSkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                        <div class="flex justify-between items-start mb-2">
                                            <h4 class="font-bold"><?php echo e($skill->name); ?></h4>
                                            <div class="badge badge-info"><?php echo e(ucfirst($skill->difficulty)); ?></div>
                                        </div>
                                        <p class="text-sm text-gray-600 mb-3"><?php echo e($skill->description); ?></p>
                                        <div class="flex gap-2">
                                            <div class="badge badge-primary badge-sm"><?php echo e($skill->category->name); ?></div>
                                        </div>
                                        <div class="mt-3">
                                            <a href="/skills/<?php echo e($skill->id); ?>" class="btn btn-sm btn-info">View Skill</a>
                                            <?php if(auth()->guard()->check()): ?>
                                                <?php if(auth()->user()->role === 'student'): ?>
                                                    <a href="/sessions" class="btn btn-sm btn-primary ml-2">Book Session</a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Learning Skills -->
                <?php if($learningSkills->count() > 0): ?>
                    <div class="card bg-base-100 shadow-xl border border-gray-200">
                        <div class="card-body">
                            <h3 class="card-title text-xl text-blue-600">📚 Learning Skills</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <?php $__currentLoopData = $learningSkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                        <div class="flex justify-between items-start mb-2">
                                            <h4 class="font-bold"><?php echo e($skill->name); ?></h4>
                                            <div class="badge badge-info"><?php echo e(ucfirst($skill->difficulty)); ?></div>
                                        </div>
                                        <p class="text-sm text-gray-600 mb-3"><?php echo e($skill->description); ?></p>
                                        <div class="flex gap-2">
                                            <div class="badge badge-primary badge-sm"><?php echo e($skill->category->name); ?></div>
                                        </div>
                                        <div class="mt-3">
                                            <a href="/skills/<?php echo e($skill->id); ?>" class="btn btn-sm btn-info">View Skill</a>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Reviews Section -->
                <?php if($reviews->count() > 0): ?>
                    <div class="card bg-base-100 shadow-xl border border-gray-200">
                        <div class="card-body">
                            <h3 class="card-title text-xl">⭐ Reviews (<?php echo e($reviews->count()); ?>)</h3>
                            <div class="space-y-4">
                                <?php $__currentLoopData = $reviews->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="flex items-center gap-2">
                                                <div class="avatar">
                                                    <div class="w-8 h-8 rounded-full">
                                                        <img src="https://i.pravatar.cc/32?u=<?php echo e($review->user->id); ?>" alt="Reviewer" />
                                                    </div>
                                                </div>
                                                <span class="font-semibold"><?php echo e($review->user->name); ?></span>
                                                <span class="text-sm text-gray-500"><?php echo e($review->created_at->format('M d, Y')); ?></span>
                                            </div>
                                            <div class="rating rating-sm">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <input type="radio" class="mask mask-star-2 bg-orange-400" <?php echo e($i <= $review->rating ? 'checked' : ''); ?> disabled />
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                        <p class="text-gray-700"><?php echo e($review->comment); ?></p>
                                        <p class="text-sm text-gray-600 mt-2">Session: <?php echo e($review->session->title); ?></p>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($reviews->count() > 5): ?>
                                    <p class="text-center text-gray-500">And <?php echo e($reviews->count() - 5); ?> more reviews...</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Contact Info -->
                <div class="card bg-base-100 shadow-xl border border-gray-200">
                    <div class="card-body">
                        <h3 class="card-title text-lg">📞 Contact Information</h3>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">📧</span>
                                <div>
                                    <p class="font-semibold">Email</p>
                                    <p class="text-gray-600"><?php echo e($user->email); ?></p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">📅</span>
                                <div>
                                    <p class="font-semibold">Joined</p>
                                    <p class="text-gray-600"><?php echo e($user->created_at->format('M d, Y')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->role === 'admin'): ?>
                        <div class="card bg-base-100 shadow-xl border border-gray-200">
                            <div class="card-body">
                                <h3 class="card-title text-lg">⚙️ Admin Actions</h3>
                                <div class="space-y-2">
                                    <a href="/users/<?php echo e($user->id); ?>/edit" class="btn btn-primary btn-block">Edit User Role</a>
                                    <form action="/users/<?php echo e($user->id); ?>" method="POST" class="w-full">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-error btn-block" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php elseif(auth()->user()->id !== $user->id && (auth()->user()->role === 'student' || auth()->user()->role === 'teacher')): ?>
                        <div class="card bg-base-100 shadow-xl border border-gray-200">
                            <div class="card-body">
                                <h3 class="card-title text-lg">💬 Actions</h3>
                                <div class="space-y-2">
                                    <?php if($user->role === 'teacher' && $teachingSkills->count() > 0): ?>
                                        <a href="/sessions" class="btn btn-primary btn-block">Book a Session</a>
                                    <?php endif; ?>
                                    <button class="btn btn-outline btn-block">Send Message</button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ELTE-CS\4th_Sem\web\skillswapApp\skillswap\resources\views/users/show.blade.php ENDPATH**/ ?>