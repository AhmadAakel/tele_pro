<?php if($paginator->hasPages()): ?>
    <div class="d-flex justify-content-center justify-content-md-end">
        <nav aria-label="Pagination Navigation">
            <ul class="pagination pagination-sm mb-0">
                
                <?php if($paginator->onFirstPage()): ?>
                    <li class="page-item disabled">
                        <span class="page-link">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    </li>
                <?php else: ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php if(is_string($element)): ?>
                        <li class="page-item disabled">
                            <span class="page-link"><?php echo e($element); ?></span>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(is_array($element)): ?>
                        <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($page == $paginator->currentPage()): ?>
                                <li class="page-item active">
                                    <span class="page-link bg-primary border-primary"><?php echo e($page); ?></span>
                                </li>
                            <?php else: ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <?php if($paginator->hasMorePages()): ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="page-item disabled">
                        <span class="page-link">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
<?php endif; ?>

<style>
.pagination .page-link {
    border: 1px solid #dee2e6;
    color: #6c757d;
    padding: 0.375rem 0.75rem;
    margin: 0 2px;
    border-radius: 0.375rem;
    transition: all 0.15s ease-in-out;
}

.pagination .page-link:hover {
    background-color: #e9ecef;
    border-color: #adb5bd;
    color: #495057;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.pagination .page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: white;
    box-shadow: 0 2px 4px rgba(13, 110, 253, 0.2);
}

.pagination .page-item.disabled .page-link {
    color: #adb5bd;
    background-color: transparent;
    border-color: #dee2e6;
}
</style><?php /**PATH D:\project\back\resources\views/custom/pagination.blade.php ENDPATH**/ ?>