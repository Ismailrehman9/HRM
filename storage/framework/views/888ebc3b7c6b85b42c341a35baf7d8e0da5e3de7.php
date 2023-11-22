<?php
    $setting = App\Models\Utility::settings();
?>

<?php echo e(Form::open(['url' => 'holiday', 'method' => 'post'])); ?>

<div class="modal-body">
    <div class="row">
    <div class="form-group col-md-12">
            <?php echo e(Form::label('occasion', __('Occasion'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::text('occasion', null, ['class' => 'form-control','placeholder'=>'Enter Occasion'])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::date('start_date', null, ['class' => 'form-control ','autocomplete'=>'off'])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::date('end_date', null, ['class' => 'form-control ','autocomplete'=>'off'])); ?>

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

<?php /**PATH /home3/devopcom/hrm.devop360.com/resources/views/holiday/create.blade.php ENDPATH**/ ?>