

<?php $__env->startSection('content'); ?>

<div class="container mx-auto">
    <h1 class="text-4xl font-bold mb-2">Welcome, <?php echo e(auth()->user()->name); ?>! 👋</h1>
    <p class="text-gray-600 mb-8">Teacher Dashboard - Manage your sessions and skills</p>

    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="card bg-blue-50 shadow-md p-6">
            <div class="text-3xl font-bold text-blue-600"><?php echo e($upcomingSessions->count()); ?></div>
            <p class="text-gray-600 text-sm mt-2">Upcoming Sessions</p>
        </div>
        <div class="card bg-green-50 shadow-md p-6">
            <div class="text-3xl font-bold text-green-600"><?php echo e($completedSessions->count()); ?></div>
            <p class="text-gray-600 text-sm mt-2">Sessions Completed</p>
        </div>
        <div class="card bg-purple-50 shadow-md p-6">
            <div class="text-3xl font-bold text-purple-600"><?php echo e($totalHours); ?></div>
            <p class="text-gray-600 text-sm mt-2">Hours Taught</p>
        </div>
        <div class="card bg-orange-50 shadow-md p-6">
            <div class="text-3xl font-bold text-orange-600"><?php echo e($reviews->count()); ?></div>
            <p class="text-gray-600 text-sm mt-2">Reviews Received</p>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Sidebar -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Upcoming Sessions -->
            <div class="card bg-base-100 shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold">📅 Upcoming Sessions</h2>
                    <a href="/sessions" class="btn btn-sm btn-outline">View All</a>
                </div>
                <?php if($upcomingSessions->count() > 0): ?>
                    <div class="space-y-3">
                        <?php $__currentLoopData = $upcomingSessions->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-bold text-lg"><?php echo e($session->title); ?></h3>
                                        <p class="text-sm text-gray-600">👨‍🎓 Student: <?php echo e($session->student->name ?? 'Unassigned'); ?></p>
                                        <p class="text-sm text-gray-600">📚 <?php echo e($session->skill->name ?? 'N/A'); ?></p>
                                        <p class="text-sm text-blue-600 mt-2">🕐 <?php echo e($session->session_date); ?> at <?php echo e($session->session_time); ?></p>
                                        <p class="text-sm text-gray-600">⏱️ Duration: <?php echo e($session->duration); ?> minutes</p>
                                    </div>
                                    <span class="badge badge-info"><?php echo e(ucfirst($session->status)); ?></span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500 text-center py-6">No upcoming sessions. Create one to get started!</p>
                    <a href="/sessions/create" class="btn btn-primary w-full">Create Session</a>
                <?php endif; ?>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-2 gap-4">
                <a href="/sessions" class="card bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-md p-6 hover:shadow-lg transition">
                    <p class="text-lg font-semibold">📋 View Sessions</p>
                    <p class="text-sm opacity-90">Manage all sessions</p>
                </a>
                <a href="/sessions/create" class="card bg-gradient-to-br from-green-500 to-green-600 text-white shadow-md p-6 hover:shadow-lg transition">
                    <p class="text-lg font-semibold">➕ Create Session</p>
                    <p class="text-sm opacity-90">Schedule new session</p>
                </a>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="space-y-6">
            <!-- My Teaching Skills -->
            <div class="card bg-base-100 shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">🎓 Teaching Skills</h2>
                <?php if($teachingSkills->count() > 0): ?>
                    <div class="space-y-2">
                        <?php $__currentLoopData = $teachingSkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                                <span class="font-medium"><?php echo e($skill->name); ?></span>
                                <span class="badge badge-primary">Teaching</span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500 text-sm text-center py-4">No teaching skills added yet</p>
                <?php endif; ?>
                <a href="/my-skills" class="btn btn-outline btn-sm w-full mt-4">Manage Skills</a>
            </div>

            <!-- Student Reviews -->
            <div class="card bg-base-100 shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">⭐ Student Reviews</h2>
                <?php if($reviews->count() > 0): ?>
                    <div class="space-y-3">
                        <?php $__currentLoopData = $reviews->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="border-l-4 border-yellow-400 p-3 bg-yellow-50 rounded">
                                <div class="flex gap-1">
                                    <?php for($i = 0; $i < $review->rating; $i++): ?>
                                        <span class="text-yellow-400">★</span>
                                    <?php endfor; ?>
                                </div>
                                <p class="text-sm text-gray-700 mt-2">"<?php echo e(Str::limit($review->comment, 80)); ?>"</p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="mt-4 p-3 bg-green-50 rounded">
                        <p class="text-sm font-semibold text-green-700">📊 Average Rating: <?php echo e(number_format($avgRating, 1)); ?>/5</p>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500 text-sm text-center py-4">No reviews yet. Complete sessions to receive reviews!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ELTE-CS\4th_Sem\web\skillswapApp\skillswap\resources\views/dashboard/teacher.blade.php ENDPATH**/ ?>