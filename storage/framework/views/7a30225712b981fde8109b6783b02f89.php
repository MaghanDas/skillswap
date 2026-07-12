

<?php $__env->startSection('title', 'SkillSwap - Sessions'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-12 mb-12">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold mb-2">📅 Sessions</h1>
                    <p class="text-purple-100">Manage your learning and teaching sessions</p>
                </div>
                <?php if(auth()->user()->role !== 'student'): ?>
                    <a href="/sessions/create" class="btn btn-warning btn-lg font-bold">+ Schedule Session</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Sessions Grid -->
    <div class="container mx-auto px-6 pb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $myBooking = auth()->user()->role === 'student' ? $s->bookings->first() : null;
                ?>
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all border border-gray-200 overflow-hidden">
                    <div class="card-body">
                        <div class="flex justify-between items-start mb-3">
                            <h2 class="card-title text-xl"><?php echo e($s->title); ?></h2>
                            <span class="badge <?php echo e($myBooking ? ($myBooking->status=='pending'?'badge-warning':($myBooking->status=='confirmed'?'badge-info':($myBooking->status=='completed'?'badge-success':'badge-error'))) : ($s->status=='pending'?'badge-warning':($s->status=='confirmed'?'badge-info':($s->status=='completed'?'badge-success':'badge-error')))); ?>">
                                <?php echo e($myBooking ? 'My ' . ucfirst($myBooking->status) : ucfirst($s->status)); ?>

                            </span>
                        </div>

                        <div class="space-y-2 text-sm text-gray-600">
                            <p class="flex items-center gap-2"><span>📚</span> <?php echo e($s->skill ? $s->skill->name : 'N/A'); ?></p>
                            <p class="flex items-center gap-2"><span>👨‍🏫</span> Teacher: <strong><?php echo e($s->teacher ? $s->teacher->name : 'N/A'); ?></strong></p>
                            <p class="flex items-center gap-2"><span>📍</span> <?php echo e($s->location); ?></p>
                            <p class="flex items-center gap-2"><span>📅</span> <?php echo e($s->session_date); ?></p>
                            <p class="flex items-center gap-2"><span>🕐</span> <?php echo e($s->session_time); ?> (<?php echo e($s->duration); ?> mins)</p>
                        </div>
                        
                        <div class="card-actions justify-end mt-4 gap-2">
                            <a href="/sessions/<?php echo e($s->id); ?>" class="btn btn-sm btn-info">👁️ View</a>
                            <?php if(auth()->user()->role === 'student'): ?>
                                <?php if($myBooking): ?>
                                    <a href="/sessions/<?php echo e($s->id); ?>" class="btn btn-sm btn-primary">Update Booking</a>
                                <?php else: ?>
                                    <form action="/sessions/<?php echo e($s->id); ?>/book" method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-sm btn-success">Book Session</button>
                                    </form>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="/sessions/<?php echo e($s->id); ?>/edit" class="btn btn-sm btn-primary">Edit</a>
                                <form action="/sessions/<?php echo e($s->id); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-error" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php if(isset($myBookings) && $myBookings->count() > 0): ?>
            <div class="mt-12">
                <h2 class="text-2xl font-bold mb-4">My Booked Sessions</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php $__currentLoopData = $myBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card bg-base-100 shadow-xl border border-gray-200">
                            <div class="card-body">
                                <h3 class="card-title text-lg"><?php echo e($booking->session->title); ?></h3>
                                <p class="text-sm text-gray-600">👨‍🏫 <?php echo e($booking->session->teacher->name); ?></p>
                                <p class="text-sm text-gray-600">📚 <?php echo e($booking->session->skill->name); ?></p>
                                <p class="text-sm text-gray-600">📅 <?php echo e($booking->session->session_date); ?> at <?php echo e($booking->session->session_time); ?></p>
                                <div class="card-actions justify-between items-center mt-4">
                                    <span class="badge badge-info"><?php echo e(ucfirst($booking->status)); ?></span>
                                    <a href="/sessions/<?php echo e($booking->session->id); ?>" class="btn btn-sm btn-primary">Open</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if($sessions->isEmpty()): ?>
            <div class="text-center py-16">
                <p class="text-3xl text-gray-400 mb-4">📭</p>
                <p class="text-gray-500 text-lg">No sessions yet.</p>
                <?php if(auth()->user()->role !== 'student'): ?>
                    <a href="/sessions/create" class="btn btn-primary mt-4">Create Your First Session</a>
                <?php else: ?>
                    <a href="/skills" class="btn btn-primary mt-4">Browse Skills</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ELTE-CS\4th_Sem\web\assignments\skillswap\resources\views/sessions/index.blade.php ENDPATH**/ ?>