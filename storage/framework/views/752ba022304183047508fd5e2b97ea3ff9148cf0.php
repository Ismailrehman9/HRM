

<?php $__env->startSection('page-title'); ?>
   <?php echo e(__("Manage Contract Type")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__("Home")); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__("Contract Type")); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    
    <div class="row align-items-center m-1">
        <?php if(\Auth::user()->type != 'employee'): ?>
            <div class="col-auto pe-0">
                <a href="#" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Create Contract')); ?>" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('Create Contract Type')); ?>" data-url="<?php echo e(route('contract_type.create')); ?>"><i class="ti ti-plus text-white"></i></a>
            </div>
        <?php endif; ?>
    </div>
 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="col-3">
    <?php echo $__env->make('layouts.hrm_setup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<div class="col-9">
    <div class="card">
        <div class="card-body table-border-style">
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th><?php echo e(__('Contract Type')); ?></th>
                            <th><?php echo e(__('Attachment')); ?></th>
                            <th width="250px"><?php echo e(__('Action')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $contractTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contractType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($contractType->name); ?></td>
                            <td>
                                <?php if($contractType->attachment): ?>
                                <a target="_blank" href="https://hrm.devop360.com/storage/<?php echo e($contractType->attachment); ?>">Attachment</a>
                                <?php endif; ?>
                            </td>
                            <td class="Action">
                                <span>
                                    <?php if(\Auth::user()->type != 'employee'): ?>
                                        <div class="action-btn btn-info ms-2">
                                            <a href="#" data-size="md" data-url="<?php echo e(URL::to('contract_type/'.$contractType->id.'/edit')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Contract Type')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Edit Contract Type')); ?>"><i class="ti ti-pencil text-white"></i></a>
                                        </div>
                                        <div class="action-btn bg-danger ms-2">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['contract_type.destroy', $contractType->id]]); ?>

                                            <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center bs-pass-para" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Delete')); ?>"><span class="text-white"><i class="ti ti-trash"></i></span></a>
                                            <?php echo Form::close(); ?>

                                        </div>
                                    <?php endif; ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/devopcom/hrm.devop360.com/resources/views/contract_type/index.blade.php ENDPATH**/ ?>