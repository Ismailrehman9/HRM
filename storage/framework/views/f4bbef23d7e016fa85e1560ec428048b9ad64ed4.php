<?php echo e(Form::open(['url' => 'travel', 'method' => 'post'])); ?>

<div class="modal-body">
<div class="row">
    <div class="form-group col-md-12">
        <?php echo e(Form::label('employee_id', __('Employee'), ['class' => 'col-form-label'])); ?>

        <?php echo e(Form::select('employee_id', $employees, null, ['class' => 'form-control select2', 'required' => 'required'])); ?>

    </div>
    <div class="form-group col-lg-6 col-md-6">
        <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'col-form-label'])); ?>

        <?php echo e(Form::text('start_date', null, ['class' => 'form-control d_week', 'autocomplete' => 'off' , 'required' => 'required'])); ?>

    </div>
    <div class="form-group col-lg-6 col-md-6">
        <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'col-form-label'])); ?>

        <?php echo e(Form::text('end_date', null, ['class' => 'form-control d_week', 'autocomplete' => 'off' , 'required' => 'required'])); ?>

    </div>
    <div class="form-group  col-md-6">
        <?php echo e(Form::label('purpose_of_visit', __('Purpose of Trip'), ['class' => 'col-form-label'])); ?>

        <?php echo e(Form::text('purpose_of_visit', null, ['class' => 'form-control' , 'required' => 'required'])); ?>

    </div>
     <div class="form-group col-md-6">
        <?php echo e(Form::label('place_of_visit', __('Country'), ['class' => 'col-form-label'])); ?>

        <?php echo e(Form::text('place_of_visit', null, ['class' => 'form-control' , 'required' => 'required'])); ?>

    </div>
    <div class="form-group col-md-12">
        <?php echo e(Form::label('description', __('Description'), ['class' => 'col-form-label'])); ?>

        <?php echo e(Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('Enter Description'),'rows'=>'3' , 'required' => 'required'])); ?>

    </div>
</div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary">
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH /home3/devopcom/hrm.devop360.com/resources/views/travel/create.blade.php ENDPATH**/ ?>