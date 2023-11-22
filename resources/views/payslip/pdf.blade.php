@php
// $logo = asset(Storage::url('uploads/logo/'));
$logo=\App\Models\Utility::get_file('uploads/logo/');

$company_logo = Utility::getValByName('company_logo');
@endphp

<style>
           .com{
    position: absolute;
}
.small{
    font-size: 20px;
    font-weight: bold;
    color: rgba(201, 122, 4, 0.733);
}

.Group{
    color: rgb(37, 37, 37);
   font-size: 25px;
}

.logo{
    position: absolute;
    width:250px;
    top: 13%;
    
    height: 250px;
}
</style>
<div class="modal-body">
    <div class="text-md-end mb-2">
        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
            data-bs-placement="bottom" title="{{ __('Download') }}" onclick="saveAsPDF()"><span
                class="fa fa-download"></span></a>
        <a title="Mail Send" href="{{ route('payslip.send', [$employee->id, $payslip->salary_month]) }}"
            class="btn btn-sm btn-warning"><span class="fa fa-paper-plane"></span></a>
    </div>
    <div class="invoice" id="printableArea">
   
     <div class="container ">
        <div class="row">
            <div class="col-lg-7 p-5">
                <div class="com">
                    <small class="small mx-4">CONFIDENTIAL</small>
                    <h1 class="fw-bold mx-auto">Salary Slip</h1>
                </div>  
            </div>
            <div class="col-lg-5"><img src="{{ $logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo.png') }}"
                                        width="170px;" alt=""></div>
            <hr class="fw-bold w-50 " style="color: rgba(201, 122, 4, 0.733);">

        </div>
        <div class="row">
            <div class="col-lg-9">
                <h1 class="fw-bold mx-4 Group"> Lawgical Group LLC</h1>
                <p class="text-secondary">8 th Foor, Bulding 2, Bay Squaire, Business Bay Dubai <br>
                    Tel: 04-5596332 Email: accounts@lawgicalgroup.com</p>
            </div>
            <div class="col-lg-3"> </div>
            <hr class="fw-bold  w-50 " style="color: rgba(201, 122, 4, 0.733);">  
        </div>
        <div class="row">
            <div class="col-lg-12 py-2"  style="background-color:  rgb(224, 225, 226);"><b class="mx-5">Employee Name</b> {{ $employee->name }}</div>
            <div class="col-lg-12 bg-light  py-2"><b class="mx-5">Designation</b> {{ $employee->designation['name'] }}</div>
            <div class="col-lg-12  py-2"  style="background-color:  rgb(224, 225, 226);"><b class="mx-5">Salary Month</b>{{$payslip->salary_month }}</div>
            <div class="col-lg-12 bg-light py-2"><b class="mx-5">Gross Salary</b>{{ \Auth::user()->priceFormat($payslip->basic_salary) }}</div>
        </div>
        <div class="row">
            <div class="col-md-6  mt-3 text-center py-2" style="background-color: rgba(201, 122, 4, 0.733);"><h2 class="fs-4 fw-bold">Earnings</h2></div>
            <div class="col-md-6  mt-3 text-center py-2" style="background-color: rgba(201, 122, 4, 0.733);"><h2 class="fs-4 fw-bold">Deductions</h2>
            @foreach ($payslipDetail['deduction']['deduction'] as $deduction)
                                            @php
                                                $employess = \App\Models\Employee::find($deduction->employee_id);
                                                $empdeduction = ($deduction->amount * $employess->salary) / 100;
                                            @endphp
                                            <tr>
                                                <td>{{ __('Saturation Deduction') }}</td>
                                                <td>{{ $deduction->title }}</td>
                                                <td>{{ ucfirst($deduction->type) }}</td>
                                                @if ($deduction->type != 'percentage')
                                                    <td class="text-right">
                                                        {{ \Auth::user()->priceFormat($deduction->amount) }}</td>
                                                @else
                                                    <td class="text-right">{{ $deduction->amount }}%
                                                        ({{ \Auth::user()->priceFormat($empdeduction) }})</td>
                                                @endif

                                            </tr>
                                        @endforeach
    </div>

            <div class="col-md-4 py-2" style="background-color:  rgb(228, 230, 233);"><b>Basic Salary</b></div>
            <div class="col-md-2 bg-light py-2 text-end"><b class="mx-3">{{ \Auth::user()->priceFormat($payslip->basic_salary) }}</b></div>
            <div class="col-md-4 py-2"  style="background-color:  rgb(228, 230, 233);"><b>Unpaid Leave</b></div>
            <div class="col-md-2 bg-light py-2 text-end"><b class="mx-3 text-danger">-</b></div>

            <div class="col-md-4 bg-light  py-2"><b>House Rent Allowance</b> 
    </div>
            <div class="col-md-2  py-2 text-end" style="background-color:  rgb(228, 230, 233);"><b class="mx-3">@foreach ($payslipDetail['earning']['allowance'] as $allowance)
                                            @php
                                                $employess = \App\Models\Employee::find($allowance->employee_id);
                                                $empdallow = ($allowance->amount * $employess->salary) / 100;
                                            @endphp
                                            <tr>
                                                <td>{{ __('Allowance') }}</td>
                                                <td>{{ $allowance->title }}</td>
                                                <td>{{ ucfirst($allowance->type) }}</td>
                                                @if ($allowance->type != 'percentage')
                                                    <td class="text-right">
                                                        {{ \Auth::user()->priceFormat($allowance->amount) }}</td>
                                                @else
                                                    <td class="text-right">{{ $allowance->amount }}%
                                                        ({{ \Auth::user()->priceFormat($empdallow) }})</td>
                                                @endif
                                            </tr>
                                        @endforeach</b></div>
            <div class="col-md-4 bg-light py-2"><b>Salary Advance</b></div>
            <div class="col-md-2  py-2 text-end" style="background-color:  rgb(228, 230, 233);"><b class="mx-3 text-danger">-</b></div>


            <div class="col-md-4  py-2" style="background-color:  rgb(228, 230, 233);"><b>Transportation Allowance</b></div>
            <div class="col-md-2 bg-light py-2 text-end"><b class="mx-3">-</b></div>
            <div class="col-md-4 py-2" style="background-color:  rgb(228, 230, 233);"><b>Loans</b></div>
            <div class="col-md-2 bg-light py-2 text-end"><b class="mx-3 text-danger">
                @foreach ($payslipDetail['deduction']['loan'] as $loan)
                                            <tr>
                                                <td>{{ __('Loan') }}</td>
                                                <td>{{ $loan->title }}</td>
                                                <td class="text-right">
                                                    {{ \Auth::user()->priceFormat($loan->amount) }}</td>
                                            </tr>
                                        @endforeach
    </b></div>

            <div class="col-md-4 bg-light py-2"><b>Food Allowance</b></div>
            <div class="col-md-2 py-2 text-end"  style="background-color:  rgb(228, 230, 233);"><b class="mx-3">-</b></div>
            <div class="col-md-4 bg-light py-2"><b>Mobile Recovery</b></div>
            <div class="col-md-2  py-2 text-end" style="background-color:  rgb(228, 230, 233);"><b class="mx-3 text-danger">-</b></div>

            <div class="col-md-4  py-2"  style="background-color:  rgb(228, 230, 233);"><b>Others Allowance</b></div>
            <div class="col-md-2 bg-light py-2 text-end"><b class="mx-3">@foreach ($payslipDetail['earning']['allowance'] as $allowance)
                                            <tr>
                                                <td>{{ __('Allowance') }}</td>
                                                <td>{{ $allowance->title }}</td>
                                                <td class="text-right">
                                                    {{ \Auth::user()->priceFormat($allowance->amount) }}</td>
                                            </tr>
                                        @endforeach
                                        @foreach ($payslipDetail['earning']['commission'] as $commission)
                                            <tr>
                                                <td>{{ __('Commission') }}</td>
                                                <td>{{ $commission->title }}</td>
                                                <td class="text-right">
                                                    {{ \Auth::user()->priceFormat($commission->amount) }}</td>
                                            </tr>
                                        @endforeach
                                        @foreach ($payslipDetail['earning']['otherPayment'] as $otherPayment)
                                            <tr>
                                                <td>{{ __('Other Payment') }}</td>
                                                <td>{{ $otherPayment->title }}</td>
                                                <td class="text-right">
                                                    {{ \Auth::user()->priceFormat($otherPayment->amount) }}</td>
                                            </tr>
                                        @endforeach
                                        @foreach ($payslipDetail['earning']['overTime'] as $overTime)
                                            <tr>
                                                <td>{{ __('OverTime') }}</td>
                                                <td>{{ $overTime->title }}</td>
                                                <td class="text-right">
                                                    {{ \Auth::user()->priceFormat($overTime->amount) }}</td>
                                            </tr>
                                        @endforeach</b></div>
            <div class="col-md-4 py-2"  style="background-color:  rgb(228, 230, 233);"><b>Tardiness Deductions</b></div>
            <div class="col-md-2 bg-light py-2 text-end"><b class="mx-3 text-danger">-</b></div>

            <div class="col-md-4 bg-light py-2"><b>Annual Tickets</b></div>
            <div class="col-md-2 py-2 text-end" style="background-color:  rgb(228, 230, 233);"><b class="mx-3">-</b></div>
            <div class="col-md-4 bg-light py-2"><b>Others</b></div>
            <div class="col-md-2  py-2 text-end" style="background-color:  rgb(228, 230, 233);"></div>

           
            <div class="col-md-4 py-2"  style="background-color:  rgb(206, 208, 209);"><h2 class="fw-bold fs-4">Total Earning</h2></div>
            <div class="col-md-2 py-2 text-end"   style="background-color: rgb(206, 208, 209);"><b > {{ \Auth::user()->priceFormat($payslipDetail['totalEarning']+$payslip->basic_salary) }}</b></div>
            <div class="col-md-4 py-2"  style="background-color: rgb(206, 208, 209);"><h2 class="fw-bold fs-4">Total Deductions</h2></div>
            <div class="col-md-2  py-2 text-end"   style="background-color:  rgb(206, 208, 209);"><b class=" text-danger"> {{ \Auth::user()->priceFormat($payslipDetail['totalDeduction']) }}</b></div>
        </div>

        <div class="row">
            <div class="col-md-10 mt-3 py-2 text-end" style="background-color: rgba(201, 122, 4, 0.733);"><h2  class="fw-bold fs-4">Net Salary</h2></div>
            <div class="col-md-2 mt-3 py-2" style="background-color:  rgb(192, 194, 196);">{{ \Auth::user()->priceFormat($payslip->net_payble) }}</div>
            <div class="col-md-12 py-4" style="background-color:  rgb(224, 225, 226);"></div>
        </div>
        
        <div class="row">
            <div class="col-md-3  mt-3" style="background-color:  rgb(224, 225, 226);"><p class="mx-5 mt-2">Mode of payment:</p></div>
            <div class="col-md-9  mt-3" style="background-color:  rgb(238, 238, 240);"><p class="text-center mt-2">Bank Transfer</p></div>
            <div class="col-md-3  " style="background-color:  rgb(238, 238, 240);"><p class="mx-5 mt-2">Disbursement date:</p></div>
            <div class="col-md-9  " style="background-color:  rgb(224, 225, 226);"><p class="text-center mt-2"> {{ \Auth::user()->dateFormat($payslip->created_at) }}</p></div>
        </div>

    </div>
    <div class="text-center">
        <p>This is a computer genrated document and does not require any signature or stamp</p>
    </div>
</div>

<script type="text/javascript" src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
<script>
    function saveAsPDF() {
        var element = document.getElementById('printableArea');
        var opt = {
            margin: 0.3,
            filename: '{{ $employee->name }}',
            image: {
                type: 'jpeg',
                quality: 1
            },
            html2canvas: {
                scale: 4,
                dpi: 72,
                letterRendering: true
            },
            jsPDF: {
                unit: 'in',
                format: 'A4'
            }
        };
        html2pdf().set(opt).from(element).save();
    }
</script>
