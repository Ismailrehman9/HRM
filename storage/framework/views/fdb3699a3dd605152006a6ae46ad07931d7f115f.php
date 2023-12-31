

<?php echo e(Form::open(['route' => ['timesheet.store']])); ?>

<div class="modal-body">
    <div class="row">

        <?php if(\Auth::user()->type != 'employee'): ?>
            <div class="form-group col-md-12">
                <?php echo e(Form::label('employee_id', __('Employee'), ['class' => 'col-form-label'])); ?>

                <?php echo Form::select('employee_id', $employees, null, ['class' => 'form-control  select2' , 'id'=>'choices-multiple', 'required' => 'required' ,'placeholder'=>'Select employee']); ?>

            </div>
        <?php endif; ?>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('date', __('Date'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::text('date', '', ['class' => 'form-control d_week', 'autocomplete' => 'off', 'required' => 'required' ,'placeholder'=>'Select date'])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('hours', __('Hours'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::number('hours', '', ['class' => 'form-control','autocomplete' => 'off' ,'required' => 'required', 'step' => '0.01' ,'placeholder'=>'Enter hours'])); ?>

        </div>
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('remark', __('Remark'), ['class' => 'col-form-label'])); ?>

            <?php echo Form::textarea('remark', null, ['class' => 'form-control', 'rows' => '2' ,'placeholder'=>'Enter remark']); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home3/devopcom/hrm.devop360.com/resources/views/timeSheet/create.blade.php ENDPATH**/ ?>