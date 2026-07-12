

<?php $__env->startSection('title', 'SkillSwap - Reviews'); ?>

<?php $__env->startSection('content'); ?>
    <div class="bg-gradient-to-r from-orange-600 to-yellow-600 text-white py-12 mb-8">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold">⭐ My Reviews</h1>
            <p class="text-orange-100 mt-2">Share and view feedback from skill exchange sessions</p>
        </div>
    </div>

    <div class="container mx-auto px-6 pb-12">
        <!-- Review Form Section -->
        <div class="mb-12">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-2xl font-bold mb-6">✍️ Submit a New Review</h2>
                
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

                <div class="card bg-base-100 shadow-xl border border-gray-200">
                    <div class="card-body">
                        <form method="POST" action="<?php echo e(url('/reviews')); ?>" class="space-y-6">
                            <?php echo csrf_field(); ?>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-bold text-lg">Session/Partner</span>
                                </label>
                                <select name="session_id" class="select select-bordered select-lg" required>
                                    <option disabled <?php echo e(old('session_id') ? '' : 'selected'); ?>>Select Session or Partner</option>
                                    <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($session->id); ?>" <?php echo e(old('session_id') == $session->id ? 'selected' : ''); ?>>
                                            <?php echo e($session->title); ?> - <?php echo e($session->skill->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['session_id'];
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
                                    <span class="label-text font-bold text-lg">📊 Rating</span>
                                </label>
                                <div class="rating gap-2 pt-2">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <input type="radio" name="rating" class="mask mask-star-2 bg-orange-400 cursor-pointer" value="<?php echo e($i); ?>" <?php echo e(old('rating') == $i ? 'checked' : ''); ?> />
                                    <?php endfor; ?>
                                </div>
                                <?php $__errorArgs = ['rating'];
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
                                    <span class="label-text font-bold text-lg">💬 Your Review</span>
                                </label>
                                <textarea name="comment" placeholder="Share your experience and feedback..." class="textarea textarea-bordered textarea-lg h-28" required><?php echo e(old('comment')); ?></textarea>
                                <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-error text-sm mt-2"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-control">
                                <button type="submit" class="btn btn-primary btn-lg font-bold">⭐ Submit Review</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Display Section -->
        <div class="max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold mb-6">📝 Your Reviews</h2>
            
            <?php if(isset($reviews) && count($reviews) > 0): ?>
                <div class="space-y-6">
                    <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card bg-base-100 shadow-lg border border-gray-200 hover:shadow-xl transition-all">
                            <div class="card-body">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <h4 class="font-bold text-lg"><?php echo e($review->session->title ?? 'Session'); ?></h4>
                                        <p class="text-gray-600 text-sm"><?php echo e($review->session->skill->name ?? 'Skill'); ?> • <?php echo e($review->created_at->format('M d, Y')); ?></p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div class="rating gap-1">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <input type="radio" class="mask mask-star-2 bg-orange-400" <?php echo e($i <= $review->rating ? 'checked' : ''); ?> disabled />
                                            <?php endfor; ?>
                                        </div>
                                        <div class="dropdown dropdown-end">
                                            <label tabindex="0" class="btn btn-sm btn-ghost btn-circle">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01"></path>
                                                </svg>
                                            </label>
                                            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-32">
                                                <li><a href="/reviews/<?php echo e($review->id); ?>/edit" class="text-blue-600">✏️ Edit</a></li>
                                                <li>
                                                    <form action="/reviews/<?php echo e($review->id); ?>" method="POST" class="w-full">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="text-red-600 w-full text-left" onclick="return confirm('Delete this review?')">🗑️ Delete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-base leading-relaxed"><?php echo e($review->comment); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="card bg-base-100 shadow-lg border border-gray-200 text-center">
                    <div class="card-body py-12">
                        <p class="text-5xl mb-4">📝</p>
                        <p class="text-gray-600 text-lg font-semibold">No reviews yet</p>
                        <p class="text-gray-500">Complete a session and share your feedback!</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\ELTE-CS\4th_Sem\web\skillswapApp\skillswap\resources\views/reviews.blade.php ENDPATH**/ ?>