<?php
    $setting = App\Models\Utility::settings();
?>
<?php echo e(Form::open(['url' => 'meeting', 'method' => 'post'])); ?>

<div class="modal-body">

    <div class="row">


        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('branch_id', __('Branch'), ['class' => 'form-label'])); ?>

                <div class="form-icon-user">
                    <select class="form-control " name="branch_id" placeholder="Select Branch" id="branch_id">
                        <option value=""><?php echo e(__('Select Branch')); ?></option>
                        <option value="0"><?php echo e(__('All Branch')); ?></option>
                        <?php $__currentLoopData = $branch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('department_id', __('Department'), ['class' => 'form-label'])); ?>

                <div class="form-icon-user">
                    <div class="department_div">
                        <select class="form-control select2 department_id" name="department_id[]" id="choices-multiple"
                            placeholder="Select Department" multiple>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('employee_id', __('Employee'), ['class' => 'form-label'])); ?>

                <div class="form-icon-user">
                    <div class="employee_div">
                        <select class="form-control  employee_id" name="employee_id[]" id="choices-multiple"
                            placeholder="Select Employee" required>
                        </select>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('title', __('Meeting Title'), ['class' => 'form-label'])); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::text('title', null, ['class' => 'form-control ', 'required' => 'required', 'placeholder' => __('Enter Meeting Title')])); ?>

                </div>
            </div>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('date', __('Meeting Date'), ['class' => 'form-label'])); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::text('date', null, ['class' => 'form-control d_week', 'required' => 'required'])); ?>

                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('time', __('Meeting Time'), ['class' => 'form-label'])); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::time('time', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                </div>
            </div>
        </div>


        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <?php echo e(Form::label('note', __('Meeting Note'), ['class' => 'form-label'])); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::textarea('note', null, ['class' => 'form-control', 'rows' => '3'])); ?>

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
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home3/devopcom/hrm.devop360.com/resources/views/meeting/create.blade.php ENDPATH**/ ?>