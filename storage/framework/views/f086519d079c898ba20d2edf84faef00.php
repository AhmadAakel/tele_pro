

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Admin Dashboard</h1>
    
    <div class="card mb-4">
        <div class="card-header">
            <h2>Channel Settings</h2>
        </div>
        <div class="card-body">
            <?php $__currentLoopData = $channels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mb-3">
                <form action="<?php echo e(route('admin.channel.update', $channel->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="input-group">
                        <input type="url" name="telegram_channel_url" class="form-control" value="<?php echo e($channel->telegram_channel_url); ?>" required>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                    <div class="form-check mt-2">
                        <input type="checkbox" class="form-check-input" id="active<?php echo e($channel->id); ?>" <?php echo e($channel->is_active ? 'checked' : ''); ?> disabled>
                        <label class="form-check-label" for="active<?php echo e($channel->id); ?>">Active</label>
                    </div>
                    <div class="mt-2">
                        <span class="badge bg-secondary">User Count: <?php echo e($channel->users_count); ?></span>
                        <a href="<?php echo e(route('admin.channel.users', $channel->id)); ?>" class="btn btn-sm btn-info">View Users</a>
                    </div>
                </form>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ahmad\Desktop\1\new\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>