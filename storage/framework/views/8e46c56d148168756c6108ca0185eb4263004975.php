<?php echo e(Form::open(['url' => 'contract_type', 'enctype' => 'multipart/form-data'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-12">
            <?php echo e(Form::label('name', __('Contract Type Name'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::text('name', '', ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>
    </div>
    <div class="row">
        <div class="form-group col-12">
            <?php echo e(Form::label('attachment', __('Attachment'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::file('attachment', ['class' => 'form-control'])); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <button type="submit" class="btn btn-primary"><?php echo e(__('Create')); ?></button>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home3/devopcom/hrm.devop360.com/resources/views/contract_type/create.blade.php ENDPATH**/ ?>