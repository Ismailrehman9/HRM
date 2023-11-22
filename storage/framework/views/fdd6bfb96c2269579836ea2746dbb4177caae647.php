<?php echo e(Form::model($leave, ['route' => ['leave.update', $leave->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('employee_id', __('Employee'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::select('employee_id', $employees, null, ['class' => 'form-control select2', 'placeholder' => __('Select Employee'), 'disabled' => 'disabled'])); ?>

            </div>
        </div>
    </div>
   <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('leave_type_id', __('Leave Type'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::select('leave_type_id', $leavetypes, null, ['class' => 'form-control select', 'placeholder' => __('Select Leave Type'), 'disabled' => \Auth::user()->type === 'employee'])); ?>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::text('start_date', null, ['class' => 'form-control d_week','autocomplete'=>'off'])); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::text('end_date', null, ['class' => 'form-control d_week','autocomplete'=>'off'])); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('leave_reason', __('Leave Reason'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::textarea('leave_reason', null, ['class' => 'form-control', 'placeholder' => __('Leave Reason'),'rows'=>'3'])); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('remark', __('Remark'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::textarea('remark', null, ['class' => 'form-control', 'placeholder' => __('Leave Remark'),'rows'=>'3'])); ?>

            </div>
        </div>
    </div>
    <div class="row" id="attachment" <?php if(!empty($leave->attachment)): ?> style="display: block" <?php else: ?> style="display: none" <?php endif; ?>>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('attachment', __('Attachment'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::file('attachment', ['class' => 'form-control'])); ?>

            </div>
        </div>
    </div>
    <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'Company')): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('status', __('Status'), ['class' => 'col-form-label'])); ?>

                    <select name="status" id="" class="form-control select2" >
                        <option value=""><?php echo e(__('Select Status')); ?></option>
                        <option value="pending" <?php if($leave->status == 'Pending'): ?> selected="" <?php endif; ?>><?php echo e(__('Pending')); ?>

                        </option>
                        <option value="approval" <?php if($leave->status == 'Approval'): ?> selected="" <?php endif; ?>><?php echo e(__('Approval')); ?>

                        </option>
                        <option value="reject" <?php if($leave->status == 'Reject'): ?> selected="" <?php endif; ?>><?php echo e(__('Reject')); ?>

                        </option>
                    </select>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">

</div>
<script>
       function attachment() {
        var leaveType = document.getElementById('leave_type_id').value;
        console.log(leaveType);
        if (leaveType == 4 || leaveType == 'Stick Leave') {
            document.getElementById('attachment').style.display = "block";
        } else {
            document.getElementById('attachment').style.display = "none";
        }
    }

    // Add an event listener to the "leave_type_id" select element
    document.getElementById('leave_type_id').addEventListener('change', attachment);

    
</script>
<?php echo e(Form::close()); ?>

<?php /**PATH /home3/devopcom/hrm.devop360.com/resources/views/leave/edit.blade.php ENDPATH**/ ?>