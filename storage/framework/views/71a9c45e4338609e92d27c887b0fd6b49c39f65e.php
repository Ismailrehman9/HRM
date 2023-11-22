<?php
    $setting = App\Models\Utility::settings();
?>
<?php echo e(Form::open(['url' => 'leave', 'method' => 'post', 'enctype' => 'multipart/form-data'])); ?>


<div class="modal-body">
    <?php if(\Auth::user()->type != 'employee'): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('employee_id', __('Employee'), ['class' => 'col-form-label'])); ?>

                    <?php echo e(Form::select('employee_id', $employees, null, ['class' => 'form-control select2', 'id' => 'employee_id', 'placeholder' => __('Select Employee')])); ?>

                </div>
            </div>
        </div>
    <?php else: ?>
     <input type="hidden" name="employee_id" value="<?php echo e(\Auth::user()->id); ?>">
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('leave_type_id', __('Leave Type'), ['class' => 'col-form-label'])); ?>

                <select name="leave_type_id" id="leave_type_id" class="form-control select" onchange="attachment()">
                    <?php $__currentLoopData = $leavetypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!--<?php if(\Auth::user()->type == 'employee1'): ?>-->
                            <?php if($leave->id == 4): ?>
                                <option value="<?php echo e($leave->id); ?>"><?php echo e($leave->title); ?> (<p class="float-right pr-5"><?php echo e($leave->days); ?></p>)</option>
                        <!--    <?php endif; ?>-->
                        <!--<?php else: ?>-->
                            <option value="<?php echo e($leave->id); ?>"><?php echo e($leave->title); ?> (<p class="float-right pr-5"><?php echo e($leave->days); ?></p>)</option>
                        <!--<?php endif; ?>/-->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::text('start_date', null, ['class' => 'form-control d_week', 'autocomplete' => 'off', 'placeholder' => 'Select start date'])); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::text('end_date', null, ['class' => 'form-control d_week', 'autocomplete' => 'off', 'placeholder' => 'Select end date'])); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('leave_reason', __('Leave Reason'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::textarea('leave_reason', null, ['class' => 'form-control', 'placeholder' => __('Leave Reason'), 'rows' => '3'])); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('remark', __('Remark'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::textarea('remark', null, ['class' => 'form-control', 'placeholder' => __('Leave Remark'), 'rows' => '3'])); ?>

            </div>
        </div>
    </div>
   <div class="row" id="attachment" style="display:none">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('attachment', __('Attachment'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::file('attachment', ['class' => 'form-control', 'id' => 'attachmentInput'])); ?>

            </div>
        </div>
    </div>
    <?php if(isset($setting['is_enabled']) && $setting['is_enabled'] =='on'): ?>
    <div class="form-group col-md-6">
        <?php echo e(Form::label('synchronize_type', __('Synchroniz in Google Calendar ?'), ['class' => 'form-label'])); ?>

        <div class=" form-switch">
            <input type="checkbox" class="form-check-input mt-2" name="synchronize_type" id="switch-shadow"
                value="google_calender">
            <label class="form-check-label" for="switch-shadow"></label>
        </div>
    </div>
    <?php endif; ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<script>
    function attachment() {
        var leaveType = document.getElementById('leave_type_id').value;
        var attachmentInput = document.getElementById('attachmentInput');
        
        console.log(leaveType);
        
        if (leaveType == 4 || leaveType == 'Stick Leave') {
            document.getElementById('attachment').style.display = "block";
            attachmentInput.setAttribute('required', true);
        } else {
            document.getElementById('attachment').style.display = "none";
            attachmentInput.removeAttribute('required');
        }
    }

    // Add an event listener to the "leave_type_id" select element
    document.getElementById('leave_type_id').addEventListener('change', attachment);

    attachment();
</script>


<?php echo e(Form::close()); ?>

<?php /**PATH /home3/devopcom/hrm.devop360.com/resources/views/leave/create.blade.php ENDPATH**/ ?>