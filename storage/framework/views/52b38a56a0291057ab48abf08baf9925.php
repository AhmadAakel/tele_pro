

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-1 text-gray-800">User Management</h1>
                    <p class="text-muted mb-0">Manage and monitor all registered users</p>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge bg-primary fs-6"><?php echo e($users->total()); ?> Total Users</span>
                </div>
            </div>

            <!-- Search and Filters Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <form action="<?php echo e(route('user.search')); ?>" method="GET" class="d-flex">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                    <input 
                                        type="search" 
                                        name="query" 
                                        class="form-control border-start-0 ps-0" 
                                        placeholder="Search by name, email, or phone..." 
                                        value="<?php echo e(request('query')); ?>"
                                        aria-label="Search users"
                                    >
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search me-1"></i>Search
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 text-md-end mt-3 mt-md-0">
                            <?php if(request('query')): ?>
                                <a href="<?php echo e(route('user.search')); ?>" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-1"></i>Clear Search
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Table Card -->
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-users me-2 text-primary"></i>Users List
                            </h5>
                        </div>
                        <div class="col-auto">
                            <small class="text-muted">
                                Showing <?php echo e($users->firstItem() ?: 0); ?> to <?php echo e($users->lastItem() ?: 0); ?> 
                                of <?php echo e($users->total()); ?> results
                            </small>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    <?php if($users->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0 fw-semibold text-muted text-uppercase small">
                                            <i class="fas fa-user me-1"></i>User
                                        </th>
                                        <th class="border-0 fw-semibold text-muted text-uppercase small">
                                            <i class="fas fa-envelope me-1"></i>Contact
                                        </th>
                                        <th class="border-0 fw-semibold text-muted text-uppercase small">
                                            <i class="fas fa-shield-alt me-1"></i>Verification
                                        </th>
                                        <th class="border-0 fw-semibold text-muted text-uppercase small">
                                            <i class="fas fa-clock me-1"></i>Status
                                        </th>
                                        <th class="border-0 fw-semibold text-muted text-uppercase small text-center">
                                            <i class="fas fa-cog me-1"></i>Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!$user->is_admin): ?>
                                            <tr class="border-bottom">
                                                <td class="py-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar me-3">
                                                            <div class="avatar-initial bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                                <?php echo e(strtoupper(substr($user->firstname, 0, 1) . substr($user->lastname, 0, 1))); ?>

                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-1 fw-semibold"><?php echo e($user->firstname); ?> <?php echo e($user->lastname); ?></h6>
                                                            <small class="text-muted">ID: #<?php echo e($user->id); ?></small>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td class="py-3">
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1">
                                                            <i class="fas fa-envelope text-muted me-2" style="width: 12px;"></i>
                                                            <span class="small"><?php echo e($user->email); ?></span>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-phone text-muted me-2" style="width: 12px;"></i>
                                                            <span class="small text-muted"><?php echo e($user->phone); ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td class="py-3">
                                                    <?php if($user->is_verified): ?>
                                                        <div>
                                                            <span class="badge bg-success-subtle text-success fw-medium">
                                                                <i class="fas fa-check-circle me-1"></i>Verified
                                                            </span>
                                                            <?php if($user->email_verified_at): ?>
                                                                <div class="small text-muted mt-1">
                                                                    <?php echo e(\Carbon\Carbon::parse($user->email_verified_at)->format('M d, Y H:i')); ?>

                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php else: ?>
                                                        <div>
                                                            <span class="badge bg-warning-subtle text-warning fw-medium">
                                                                <i class="fas fa-clock me-1"></i>Code: <?php echo e($user->verification_code); ?>

                                                            </span>
                                                            <div class="small text-muted mt-1">Pending verification</div>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                                
                                                <td class="py-3">
                                                    <?php if($user->is_verified): ?>
                                                        <span class="badge bg-success d-inline-flex align-items-center">
                                                            <i class="fas fa-check-circle me-1"></i>Active
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-warning d-inline-flex align-items-center">
                                                            <i class="fas fa-hourglass-half me-1"></i>Pending
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                
                                                <td class="py-3 text-center">
                                                    <?php if(!$user->is_admin && auth()->check() && auth()->user()->is_admin): ?>
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-outline-danger btn-sm"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#deleteModal<?php echo e($user->id); ?>"
                                                        >
                                                            <i class="fas fa-trash-alt me-1"></i>Remove
                                                        </button>
                                                        
                                                        <!-- Delete Confirmation Modal -->
                                                        <div class="modal fade" id="deleteModal<?php echo e($user->id); ?>" tabindex="-1">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header border-0 pb-0">
                                                                        <h5 class="modal-title">
                                                                            <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                                                                            Confirm User Removal
                                                                        </h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="text-center">
                                                                            <div class="mb-3">
                                                                                <div class="avatar-initial bg-danger-subtle text-danger rounded-circle d-inline-flex align-items-center justify-center mb-3" style="width: 60px; height: 60px; font-size: 24px;">
                                                                                    <i class="fas fa-user-times"></i>
                                                                                </div>
                                                                            </div>
                                                                            <h6 class="mb-2">Remove User Account</h6>
                                                                            <p class="text-muted mb-0">
                                                                                Are you sure you want to remove <strong><?php echo e($user->firstname); ?> <?php echo e($user->lastname); ?></strong>?
                                                                                This action cannot be undone.
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer border-0 pt-0">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                            <i class="fas fa-times me-1"></i>Cancel
                                                                        </button>
                                                                        <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST" class="d-inline">
                                                                            <?php echo csrf_field(); ?>
                                                                            <?php echo method_field('DELETE'); ?>
                                                                            <button type="submit" class="btn btn-danger">
                                                                                <i class="fas fa-trash-alt me-1"></i>Remove User
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-users text-muted" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="text-muted">No Users Found</h5>
                            <p class="text-muted mb-0">
                                <?php if(request('query')): ?>
                                    No users match your search criteria. Try adjusting your search terms.
                                <?php else: ?>
                                    There are currently no users registered in the system.
                                <?php endif; ?>
                            </p>
                            <?php if(request('query')): ?>
                                <a href="<?php echo e(route('admin.users')); ?>" class="btn btn-primary mt-3">
                                    <i class="fas fa-arrow-left me-1"></i>View All Users
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Pagination -->
                <?php if($users->hasPages()): ?>
                    <div class="card-footer bg-light border-top">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="text-muted small">
                                    Showing <?php echo e($users->firstItem() ?: 0); ?> to <?php echo e($users->lastItem() ?: 0); ?> 
                                    of <?php echo e($users->total()); ?> results
                                </div>
                            </div>
                            <div class="col-md-6">
                                <nav aria-label="Users pagination">
                                    <?php echo e($users->appends(request()->query())->links('custom.pagination')); ?>

                                </nav>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
.avatar-initial {
    font-weight: 600;
    font-size: 14px;
}

.table th {
    font-size: 11px;
    letter-spacing: 0.5px;
}

.badge {
    font-weight: 500;
}

.btn-outline-danger:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(220, 53, 69, 0.2);
}

.card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.table-hover tbody tr:hover {
    background-color: rgba(13, 110, 253, 0.02);
}

.input-group-text {
    background-color: #f8f9fa;
}

.modal-content {
    border: none;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\1\new\resources\views/admin/allusers.blade.php ENDPATH**/ ?>