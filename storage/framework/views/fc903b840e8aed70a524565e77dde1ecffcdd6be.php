<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Employee Profile')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Employee Profile')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <a class="btn btn-sm btn-primary collapsed" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button"
        aria-expanded="false" aria-controls="multiCollapseExample1" data-bs-toggle="tooltip" title="<?php echo e(__('Filter')); ?>">
        <i class="ti ti-filter"></i>
    </a>
<?php $__env->stopSection(); ?>


<?php
$profile = asset(Storage::url('uploads/avatar/'));
?>
<?php $__env->startSection('content'); ?>
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12">
        <div class="multi-collapse mt-2 collapse" id="multiCollapseExample1" style="">
            <div class="card">
                <div class="card-body">
                    <?php echo e(Form::open(['route' => ['employee.profile'], 'method' => 'get', 'id' => 'employee_profile_filter'])); ?>

                    <div class="d-flex align-items-center justify-content-end">
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                            <div class="btn-box">

                                <?php echo e(Form::label('branch', __('Select Branch*'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('branch', $brances, isset($_GET['branch']) ? $_GET['branch'] : '', ['class' => ' select-width form-control'])); ?>


                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                            <div class="btn-box">

                                <?php echo e(Form::label('department', __('Select Department*'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('department', $departments, isset($_GET['department']) ? $_GET['department'] : '', ['class' => ' select-width form-control'])); ?>


                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                            <div class="btn-box">

                                <?php echo e(Form::label('designation', __('Designation'), ['class' => 'form-label'])); ?>

                                <select class="  select-width select2-multiple form-control" id="designation_id"
                                    name="designation" data-placeholder="<?php echo e(__('Select Designation ...')); ?>">
                                    <option value=""><?php echo e(__('Designation')); ?></option>
                                </select>

                            </div>
                        </div>

                        <div class="col-auto float-end ms-2 mt-4">
                            <a href="#" class="btn btn-sm btn-primary"
                                onclick="document.getElementById('employee_profile_filter').submit(); return false;"
                                data-bs-toggle="tooltip" title="" data-bs-original-title="Apply">
                                <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                            </a>
                            <a href="<?php echo e(route('employee.profile')); ?>" class="btn btn-sm btn-danger"
                                data-bs-toggle="tooltip" title="" data-bs-original-title="Reset">
                                <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off "></i></span>
                            </a>
                        </div>

                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
  
        <?php if(\Auth::user()->id == $employee->user_id): ?>
         <div class="col-lg-3 col-sm-6">
                <div class="card hover-shadow-lg">
                    <div class="card-header border-0 pb-0 pt-2 px-3">
    
                    </div>
                    <div class="card-body text-center client-box">
                        <div class="avatar-parent-child">
                            <img src="<?php echo e(!empty($employee->user->avatar) ? asset(Storage::url('uploads/avatar')) . '/' . $employee->user->avatar : asset(Storage::url('uploads/avatar')) . '/avatar.png'); ?>"
                                alt="kal" class="img-user wid-80 rounded-circle">
                        </div>
                        <h5 class="h6 mt-4 mb-0"><?php echo e($employee->name); ?></h5>
                        <a href="#" class="text-sm text-muted mb-3"><?php echo e(ucfirst(!empty($employee->department) ? $employee->department->name : '')); ?></a><br>
                        <a href="#" class="text-sm text-muted mb-3">Personal Contact #: <?php echo e(ucfirst(!empty($employee->phone) ? $employee->phone : '')); ?></a><br>
                         <a href="#" class="text-sm text-muted mb-3">Official Contact #: <?php echo e(ucfirst(!empty($employee->official) ? $employee->official : '')); ?></a><br>
                         
                        <a href="#" class="text-sm text-muted mb-3"><?php echo e(ucfirst(!empty($employee->designation) ? $employee->designation->name : '')); ?></a>
    
                <?php if(\Auth::user()->name == 'SuperAdmin'): ?>
                        <div class="row mt-2">
                            <div class="col-12 col-sm-12">
                                <div class="d-grid">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Employee Profile')): ?>
                                        <a  class="btn btn-outline-primary mx-5"
                                            href="<?php echo e(route('show.employee.profile', \Illuminate\Support\Facades\Crypt::encrypt($employee->id))); ?>"><?php echo e(\Auth::user()->employeeIdFormat($employee->employee_id)); ?></a>
                                    <?php else: ?>
                                        <a class="btn btn-outline-primary mx-5" href="#"><?php echo e(\Auth::user()->employeeIdFormat($employee->employee_id)); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
   
     <?php else: ?>
        <div class="col-lg-3 col-sm-6">
            <div class="card hover-shadow-lg">
                <div class="card-header border-0 pb-0 pt-2 px-3">

                </div>
                <div class="card-body text-center client-box">
                    <div class="avatar-parent-child">
                        <img src="<?php echo e(!empty($employee->user->avatar) ? asset(Storage::url('uploads/avatar')) . '/' . $employee->user->avatar : asset(Storage::url('uploads/avatar')) . '/avatar.png'); ?>"
                            alt="kal" class="img-user wid-80 rounded-circle">
                    </div>
                    <h5 class="h6 mt-4 mb-0"><?php echo e($employee->name); ?></h5>
                    <a href="#" class="text-sm text-muted mb-3"><?php echo e(ucfirst(!empty($employee->department) ? $employee->department->name : '')); ?></a><br>
                    <a href="#" class="text-sm text-muted mb-3">Personal Contact #: <?php echo e(ucfirst(!empty($employee->phone) ? $employee->phone : '')); ?></a><br>
                     <a href="#" class="text-sm text-muted mb-3">Official Contact #: <?php echo e(ucfirst(!empty($employee->official) ? $employee->official : '')); ?></a><br>
                     
                    <a href="#" class="text-sm text-muted mb-3"><?php echo e(ucfirst(!empty($employee->designation) ? $employee->designation->name : '')); ?></a>

            <?php if(\Auth::user()->name == 'SuperAdmin'): ?>
                    <div class="row mt-2">
                        <div class="col-12 col-sm-12">
                            <div class="d-grid">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Employee Profile')): ?>
                                    <a  class="btn btn-outline-primary mx-5"
                                        href="<?php echo e(route('show.employee.profile', \Illuminate\Support\Facades\Crypt::encrypt($employee->id))); ?>"><?php echo e(\Auth::user()->employeeIdFormat($employee->employee_id)); ?></a>
                                <?php else: ?>
                                    <a class="btn btn-outline-primary mx-5" href="#"><?php echo e(\Auth::user()->employeeIdFormat($employee->employee_id)); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
     <?php endif; ?>
     
     
        
        <!--<?php if(\Auth::user()->name == $employee->name): ?>-->
        <!--   <div class="col-xl-3">-->
        <!--    <div class="card  text-center">-->
        <!--        <div class="card-header border-0 pb-0">-->
        <!--            <div class="d-flex justify-content-between align-items-center">-->
        <!--                <h6 class="mb-0">-->
                            
        <!--                </h6>-->
        <!--            </div>-->
        <!--            <div class="card-header-right">-->
        <!--                <div class="btn-group card-option">-->
        <!--                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"-->
        <!--                        aria-expanded="false">-->
        <!--                        <i class="feather icon-more-vertical"></i>-->
        <!--                    </button>-->
        <!--                    <div class="dropdown-menu dropdown-menu-end">-->
        <!--                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Employee')): ?>-->
        <!--                            <a href="<?php echo e(route('employee.edit', \Illuminate\Support\Facades\Crypt::encrypt($employee->id))); ?>"-->
        <!--                                class="dropdown-item" data-url="" data-size="md" data-ajax-popup="true"-->
        <!--                                data-title="<?php echo e(__('Edit employee')); ?>"><i class="ti ti-edit "></i><span-->
        <!--                                    class="ms-2"><?php echo e(__('Edit')); ?></span></a>-->
        <!--                        <?php endif; ?>-->

        <!--                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Employee')): ?>-->
        <!--                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['employee.destroy', $employee->id], 'id' => 'delete-form-' . $employee->id]); ?>-->
        <!--                            <a href="#" class="bs-pass-para dropdown-item" data-confirm="<?php echo e(__('Are You Sure?')); ?>"-->
        <!--                                data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"-->
        <!--                                data-confirm-yes="delete-form-<?php echo e($employee->id); ?>" title="<?php echo e(__('Delete')); ?>"><i-->
        <!--                                    class="ti ti-trash"></i><span-->
        <!--                                    class="ms-2"><?php echo e(__('Delete')); ?></span></a>-->
        <!--                            <?php echo Form::close(); ?>-->
        <!--                        <?php endif; ?>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="card-body">-->
        <!--            <div class="avatar">-->
        <!--                <a href="<?php echo e(!empty($employee->user->avatar) ? asset(Storage::url('uploads/avatar')) . '/' . $employee->user->avatar : asset(Storage::url('uploads/avatar')) . '/avatar.png'); ?>" target="_blank">-->
        <!--                <img src="<?php echo e(!empty($employee->user->avatar) ? asset(Storage::url('uploads/avatar')) . '/' . $employee->user->avatar : asset(Storage::url('uploads/avatar')) . '/avatar.png'); ?>"-->
        <!--                    class="rounded-circle" style="width: 25%">-->
        <!--                </a>-->

        <!--            </div>-->
        <!--            <h4 class="mt-2 text-primary"><?php echo e($employee->name); ?></h4>-->
        <!--            <small-->
        <!--                class=""><?php echo e(ucfirst(!empty($employee->designation) ? $employee->designation->name : '')); ?></small>-->

        <!--            <div class="row mt-2">-->
        <!--                <div class="col-12 col-sm-12">-->
        <!--                    <div class="d-grid">-->
        <!--                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Employee Profile')): ?>-->
                                   
        <!--                                <a class="btn btn-outline-primary"-->
        <!--                                href="<?php echo e(route('show.employee.profile', \Illuminate\Support\Facades\Crypt::encrypt($employee->id))); ?>"><?php echo e(\Auth::user()->employeeIdFormat($employee->employee_id)); ?></a>-->
                                   
        <!--                        <?php else: ?>-->
                                   
        <!--                            <a class="btn btn-outline-primary"-->
        <!--                                href="<?php echo e(route('employee.show', \Illuminate\Support\Facades\Crypt::encrypt($employee->id))); ?>"><?php echo e(\Auth::user()->employeeIdFormat($employee->employee_id)); ?></a>-->

        <!--                        <?php endif; ?>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!--<?php endif; ?>-->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).ready(function() {
            var d_id = $('#department').val();
            getDesignation(d_id);
        });

        $(document).on('change', 'select[name=department]', function() {
            var department_id = $(this).val();
            getDesignation(department_id);
        });

        function getDesignation(did) {
            $.ajax({
                url: '<?php echo e(route('employee.json')); ?>',
                type: 'POST',
                data: {
                    "department_id": did,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    $('#designation_id').empty();
                    $('#designation_id').append('<option value=""><?php echo e(__('Select Designation')); ?></option>');
                    $.each(data, function(key, value) {
                        $('#designation_id').append('<option value="' + key + '">' + value +
                            '</option>');
                    });
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/devopcom/hrm.devop360.com/resources/views/employee/profile.blade.php ENDPATH**/ ?>