<?php echo e(Form::model($jobOnBoard, ['route' => ['job.on.board.update', $jobOnBoard->id], 'method' => 'post'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo Form::label('joining_date', __('Joining Date'), ['class' => 'col-form-label']); ?>

            <?php echo Form::text('joining_date', null, ['class' => 'form-control d_week','autocomplete'=>'off']); ?>

        </div>
       
        <div class="form-group col-md-6">
            <?php echo Form::label('days_of_week', __('Days Of Week'), ['class' => 'col-form-label']); ?>

            <?php echo Form::text('days_of_week', null, ['class' => 'form-control ','autocomplete'=>'off']); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo Form::label('salary', __('Salary'), ['class' => 'col-form-label']); ?>

            <?php echo Form::text('salary', null, ['class' => 'form-control ','autocomplete'=>'off']); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('salary_type', __('Salary Type'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::select('salary_type', $salary_type, null, ['class' => 'form-control select'])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('salary_duration', __('Salary Type'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::select('salary_duration', $salary_duration, null, ['class' => 'form-control select'])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('jop_type', __('Job Type'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::select('job_type', $job_type, null, ['class' => 'form-control select'])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('status', __('Status'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::select('status', $status, null, ['class' => 'form-control select'])); ?>

        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn btn-primary">
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH /home3/devopcom/hrm.devop360.com/resources/views/jobApplication/onboardEdit.blade.php ENDPATH**/ ?>