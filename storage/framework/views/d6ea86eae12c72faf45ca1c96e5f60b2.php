

<?php $__env->startSection('content'); ?>

<div class="container mx-auto">
    <h1 class="text-4xl font-bold mb-2">Welcome, <?php echo e(auth()->user()->name); ?>! 👋</h1>
    <p class="text-gray-600 mb-8">Student Learning Dashboard</p>

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
            <div class="text-3xl font-bold text-purple-600"><?php echo e($mySkills->count()); ?></div>
            <p class="text-gray-600 text-sm mt-2">Skills Learning</p>
        </div>
        <div class="card bg-orange-50 shadow-md p-6">
            <div class="text-3xl font-bold text-orange-600"><?php echo e($totalHours); ?></div>
            <p class="text-gray-600 text-sm mt-2">Hours Learned</p>
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
                                        <p class="text-sm text-gray-600">👨‍🏫 <?php echo e($session->teacher->name); ?></p>
                                        <p class="text-sm text-gray-600">📚 <?php echo e($session->skill->name ?? 'N/A'); ?></p>
                                        <p class="text-sm text-blue-600 mt-2">🕐 <?php echo e($session->session_date); ?> at <?php echo e($session->session_time); ?></p>
                                    </div>
                                    <span class="badge badge-info"><?php echo e(ucfirst($session->status)); ?></span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500 text-center py-6">No upcoming sessions. Browse available sessions below!</p>
                    <a href="/sessions" class="btn btn-primary w-full">Browse Sessions</a>
                <?php endif; ?>
            </div>

            <!-- Browse Sessions -->
            <div class="card bg-base-100 shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">🔍 Browse Available Sessions</h2>
                <p class="text-gray-600 mb-4">Find and enroll in sessions from experienced teachers</p>
                <a href="/sessions" class="btn btn-primary w-full">Explore Sessions</a>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="space-y-6">
            <!-- My Skills Learning -->
            <div class="card bg-base-100 shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">📚 Skills I'm Learning</h2>
                <?php if($mySkills->count() > 0): ?>
                    <div class="space-y-2">
                        <?php $__currentLoopData = $mySkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                                <span class="font-medium"><?php echo e($skill->name); ?></span>
                                <span class="badge"><?php echo e(ucfirst($skill->pivot->experience_level)); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500 text-sm text-center py-4">No skills selected yet</p>
                <?php endif; ?>
                <a href="/my-skills" class="btn btn-outline btn-sm w-full mt-4">Manage Skills</a>
            </div>

            <!-- Recent Reviews -->
            <div class="card bg-base-100 shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">⭐ Reviews</h2>
                <?php if($reviews->count() > 0): ?>
                    <div class="space-y-3">
                        <?php $__currentLoopData = $reviews->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                <?php else: ?>
                    <p class="text-gray-500 text-sm text-center py-4">No reviews yet. Complete sessions to receive reviews!</p>
                <?php endif; ?>
                <a href="/reviews" class="btn btn-outline btn-sm w-full mt-4">View All Reviews</a>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ELTE-CS\4th_Sem\web\assignments\skillswap\resources\views/dashboard/student.blade.php ENDPATH**/ ?>