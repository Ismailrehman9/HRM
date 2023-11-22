@php
    $setting = App\Models\Utility::settings();
@endphp
{{ Form::open(['url' => 'leave', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}

<div class="modal-body">
    @if (\Auth::user()->type != 'employee')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('employee_id', __('Employee'), ['class' => 'col-form-label']) }}
                    {{ Form::select('employee_id', $employees, null, ['class' => 'form-control select2', 'id' => 'employee_id', 'placeholder' => __('Select Employee')]) }}
                </div>
            </div>
        </div>
    @else
     <input type="hidden" name="employee_id" value="{{ \Auth::user()->id }}">
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('leave_type_id', __('Leave Type'), ['class' => 'col-form-label']) }}
                <select name="leave_type_id" id="leave_type_id" class="form-control select" onchange="attachment()">
                    @foreach ($leavetypes as $leave)
                        <!--@if (\Auth::user()->type == 'employee1')-->
                            @if ($leave->id == 4)
                                <option value="{{ $leave->id }}">{{ $leave->title }} (<p class="float-right pr-5">{{ $leave->days }}</p>)</option>
                        <!--    @endif-->
                        <!--@else-->
                            <option value="{{ $leave->id }}">{{ $leave->title }} (<p class="float-right pr-5">{{ $leave->days }}</p>)</option>
                        <!--@endif/-->
                    @endforeach
                </select>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('start_date', __('Start Date'), ['class' => 'col-form-label']) }}
                {{ Form::text('start_date', null, ['class' => 'form-control d_week', 'autocomplete' => 'off', 'placeholder' => 'Select start date']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('end_date', __('End Date'), ['class' => 'col-form-label']) }}
                {{ Form::text('end_date', null, ['class' => 'form-control d_week', 'autocomplete' => 'off', 'placeholder' => 'Select end date']) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('leave_reason', __('Leave Reason'), ['class' => 'col-form-label']) }}
                {{ Form::textarea('leave_reason', null, ['class' => 'form-control', 'placeholder' => __('Leave Reason'), 'rows' => '3']) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('remark', __('Remark'), ['class' => 'col-form-label']) }}
                {{ Form::textarea('remark', null, ['class' => 'form-control', 'placeholder' => __('Leave Remark'), 'rows' => '3']) }}
            </div>
        </div>
    </div>
   <div class="row" id="attachment" style="display:none">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('attachment', __('Attachment'), ['class' => 'col-form-label']) }}
                {{ Form::file('attachment', ['class' => 'form-control', 'id' => 'attachmentInput']) }}
            </div>
        </div>
    </div>
    @if(isset($setting['is_enabled']) && $setting['is_enabled'] =='on')
    <div class="form-group col-md-6">
        {{ Form::label('synchronize_type', __('Synchroniz in Google Calendar ?'), ['class' => 'form-label']) }}
        <div class=" form-switch">
            <input type="checkbox" class="form-check-input mt-2" name="synchronize_type" id="switch-shadow"
                value="google_calender">
            <label class="form-check-label" for="switch-shadow"></label>
        </div>
    </div>
    @endif
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
    <input type="submit" value="{{ __('Create') }}" class="btn  btn-primary">
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


{{ Form::close() }}
