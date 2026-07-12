

<?php $__env->startSection('title', 'SkillSwap - Session Details'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-12 mb-12">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold mb-2">📅 Session Details</h1>
                    <p class="text-purple-100"><?php echo e($session->title); ?></p>
                </div>
                <div class="flex gap-2">
                    <?php if(auth()->user()->role !== 'student'): ?>
                        <a href="/sessions/<?php echo e($session->id); ?>/edit" class="btn btn-warning btn-lg font-bold">Edit Session</a>
                    <?php endif; ?>
                    <a href="/sessions" class="btn btn-outline btn-lg text-white border-white hover:bg-white hover:text-purple-600">Back to Sessions</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Session Details -->
    <div class="container mx-auto px-6 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Session Info Card -->
                <div class="card bg-base-100 shadow-xl border border-gray-200">
                    <div class="card-body">
                        <div class="flex justify-between items-start mb-4">
                            <h2 class="card-title text-2xl"><?php echo e($session->title); ?></h2>
                            <span class="badge <?php echo e($session->status=='pending'?'badge-warning':($session->status=='confirmed'?'badge-info':($session->status=='completed'?'badge-success':'badge-error'))); ?> badge-lg">
                                <?php echo e(ucfirst($session->status)); ?>

                            </span>
                        </div>

                        <div class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">📚</span>
                                    <div>
                                        <p class="font-semibold">Skill</p>
                                        <p class="text-gray-600"><?php echo e($session->skill ? $session->skill->name : 'N/A'); ?></p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">👨‍🏫</span>
                                    <div>
                                        <p class="font-semibold">Teacher</p>
                                        <p class="text-gray-600"><?php echo e($session->teacher ? $session->teacher->name : 'N/A'); ?></p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">📍</span>
                                    <div>
                                        <p class="font-semibold">Location</p>
                                        <p class="text-gray-600"><?php echo e($session->location); ?></p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">📅</span>
                                    <div>
                                        <p class="font-semibold">Date</p>
                                        <p class="text-gray-600"><?php echo e($session->session_date); ?></p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">🕐</span>
                                    <div>
                                        <p class="font-semibold">Time & Duration</p>
                                        <p class="text-gray-600"><?php echo e($session->session_time); ?> (<?php echo e($session->duration); ?> minutes)</p>
                                    </div>
                                </div>
                            </div>

                            <div class="divider"></div>

                            <div>
                                <h3 class="font-bold text-lg mb-2">Description</h3>
                                <p class="text-gray-700 leading-relaxed"><?php echo e($session->description); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if(auth()->user()->role === 'student' && ! $myBooking): ?>
                    <div class="card bg-base-100 shadow-xl border border-gray-200">
                        <div class="card-body">
                            <h3 class="card-title text-xl">Book This Session</h3>
                            <p class="text-gray-600">Create your personal booking without affecting any other student.</p>
                            <form action="/sessions/<?php echo e($session->id); ?>/book" method="POST" class="mt-4">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-primary">Book Session</button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($myBooking): ?>
                    <div class="card bg-base-100 shadow-xl border border-gray-200">
                        <div class="card-body">
                            <h3 class="card-title text-xl">My Booking</h3>
                            <p class="text-gray-600 mb-4">This status is only for your booking.</p>
                            <form action="/session-bookings/<?php echo e($myBooking->id); ?>" method="POST" class="space-y-4">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <div class="form-control">
                                    <label class="label"><span class="label-text font-bold">Booking Status</span></label>
                                    <select name="status" class="select select-bordered select-lg">
                                        <option value="pending" <?php echo e($myBooking->status === 'pending' ? 'selected' : ''); ?>>Pending</option>
                                        <option value="confirmed" <?php echo e($myBooking->status === 'confirmed' ? 'selected' : ''); ?>>Confirmed</option>
                                        <option value="completed" <?php echo e($myBooking->status === 'completed' ? 'selected' : ''); ?>>Completed</option>
                                        <option value="cancelled" <?php echo e($myBooking->status === 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update My Booking</button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Reviews Section -->
                <?php if($session->status == 'completed' || ($myBooking && $myBooking->status == 'completed')): ?>
                    <div class="card bg-base-100 shadow-xl border border-gray-200">
                        <div class="card-body">
                            <h3 class="card-title text-xl">⭐ Reviews</h3>
                            <?php if($session->reviews->count() > 0): ?>
                                <div class="space-y-4">
                                    <?php $__currentLoopData = $session->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="border border-gray-200 rounded-lg p-4">
                                            <div class="flex items-center justify-between mb-2">
                                                <div class="flex items-center gap-2">
                                                    <div class="avatar">
                                                        <div class="w-8 h-8 rounded-full">
                                                            <img src="https://i.pravatar.cc/32?u=<?php echo e($review->user->id); ?>" alt="Reviewer" />
                                                        </div>
                                                    </div>
                                                    <span class="font-semibold"><?php echo e($review->user->name); ?></span>
                                                </div>
                                                <div class="rating rating-sm">
                                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                                        <input type="radio" class="mask mask-star-2 bg-orange-400" <?php echo e($i <= $review->rating ? 'checked' : ''); ?> disabled />
                                                    <?php endfor; ?>
                                                </div>
                                            </div>
                                            <p class="text-gray-700"><?php echo e($review->comment); ?></p>
                                            <p class="text-sm text-gray-500 mt-2"><?php echo e($review->created_at->format('M d, Y')); ?></p>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php else: ?>
                                <p class="text-gray-600">No reviews yet for this session.</p>
                            <?php endif; ?>

                            <?php if(auth()->check() && (auth()->user()->role === 'teacher' || $myBooking)): ?>
                                <div class="mt-6">
                                    <a href="/reviews" class="btn btn-primary">Write a Review</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="card bg-base-100 shadow-xl border border-gray-200">
                    <div class="card-body">
                        <h3 class="card-title text-lg">Quick Actions</h3>
                        <div class="space-y-2">
                            <?php if(auth()->user()->role !== 'student'): ?>
                                <a href="/sessions/<?php echo e($session->id); ?>/edit" class="btn btn-primary btn-block">Edit Session</a>
                            <?php endif; ?>
                            <?php if(auth()->user()->role === 'student' && ! $myBooking): ?>
                                <form action="/sessions/<?php echo e($session->id); ?>/book" method="POST" class="inline-block w-full">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-success btn-block">Book Session</button>
                                </form>
                            <?php endif; ?>
                            <?php if($myBooking): ?>
                                <form action="/session-bookings/<?php echo e($myBooking->id); ?>" method="POST" class="inline-block w-full">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="btn btn-info btn-block">Mark My Booking Completed</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Participants Info -->
                <?php if($session->teacher): ?>
                    <div class="card bg-base-100 shadow-xl border border-gray-200">
                        <div class="card-body">
                            <h3 class="card-title text-lg">👨‍🏫 Teacher</h3>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="w-12 h-12 rounded-full">
                                        <img src="https://i.pravatar.cc/48?u=<?php echo e($session->teacher->id); ?>" alt="Teacher" />
                                    </div>
                                </div>
                                <div>
                                    <p class="font-semibold"><?php echo e($session->teacher->name); ?></p>
                                    <p class="text-sm text-gray-600"><?php echo e($session->teacher->email); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($session->bookings->count() > 0): ?>
                    <div class="card bg-base-100 shadow-xl border border-gray-200">
                        <div class="card-body">
                            <h3 class="card-title text-lg">👨‍🎓 Bookings</h3>
                            <div class="space-y-3">
                                <?php $__currentLoopData = $session->bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex items-center justify-between border border-gray-200 rounded-lg p-3">
                                        <div>
                                            <p class="font-semibold"><?php echo e($booking->user->name); ?></p>
                                            <p class="text-sm text-gray-600"><?php echo e($booking->user->email); ?></p>
                                        </div>
                                        <span class="badge badge-info"><?php echo e(ucfirst($booking->status)); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ELTE-CS\4th_Sem\web\assignments\skillswap\resources\views/sessions/show.blade.php ENDPATH**/ ?>