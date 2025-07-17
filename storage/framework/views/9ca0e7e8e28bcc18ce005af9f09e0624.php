

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Admin Dashboard</h1>

    <div class="card mb-4">
        <div class="card-header">
            <h2>Channel Settings</h2>
        </div>
        <div class="card-body">
            <?php $__currentLoopData = $channels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card mb-3">
                <div class="card-header">
                    channel
                </div>
                <div class="card-body">
                    <figure>
                        <blockquote class="blockquote">
                            <p><?php echo e($channel->telegram_channel_url); ?></p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                            <cite title="Source Title"><?php echo e($channel->comment); ?></cite>
                        </figcaption>
                        <div class="form-check mt-2">
                        <input type="checkbox" class="form-check-input" id="active<?php echo e($channel->id); ?>" <?php echo e($channel->is_active ? 'checked' : ''); ?> disabled>
                        <label class="form-check-label" for="active<?php echo e($channel->id); ?>">Active</label>
                    </div>
                    <div class="mt-2">
                        <span class="badge bg-secondary">User Count: <?php echo e($channel->users_count); ?></span>
                        <a href="<?php echo e(route('admin.channel.users', $channel->id)); ?>" class="btn btn-sm btn-info">View Users</a>
                    </div>
                    </figure>
                </div>
            </div>
            


            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="mb-3 mt-3">
                <form action="<?php echo e(route('admin.channel.add')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <!-- <?php echo method_field('PUT'); ?> -->
                    <div class="input-group mb-3">
                        <input type="url" name="telegram_channel_url" class="form-control" value="" placeholder="New Channel Link" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="comment" placeholder="Your Comment" class="form-control" aria-placeholder="Commnet" value="">
                    </div>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">add channel</button>
                        </div>
                    
                    
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\project\back\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>