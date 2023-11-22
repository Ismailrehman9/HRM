@extends('layouts.admin')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
@section('page-title')
   {{ __('Manage Ticket') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Manage Ticket') }}</li>
@endsection

@section('action-button')
    @can('Create Ticket')
        <a href="#" data-url="{{ route('ticket.create') }}" data-ajax-popup="true"
            data-title="{{ __('Create New Ticket') }}" data-size="lg" data-bs-toggle="tooltip" title=""
            class="btn btn-sm btn-primary" data-bs-original-title="{{ __('Create') }}">
            <i class="ti ti-plus"></i>
        </a>
    @endcan
@endsection


@section('content')
    <div class="col-xxl-8">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="card ticket-card">
                    <div class="card-body">
                        <div class="theme-avtar bg-info">
                            <i class="ti ti-ticket"></i>
                        </div>
                        <p class="text-muted text-sm mt-4 mb-2"></p>
                        <h6 class="mb-3">{{ __('Total Ticket') }}</h6>
                        <h3 class="mb-0">{{ $countTicket }} </h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="card ticket-card">
                    <div class="card-body">
                        <div class="theme-avtar bg-primary">
                            <i class="ti ti-ticket"></i>
                        </div>
                        <p class="text-muted text-sm mt-4 mb-2"></p>
                        <h6 class="mb-3">{{ __('Open Ticket') }}</h6>
                        <h3 class="mb-0">{{ $countOpenTicket }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="card ticket-card">
                    <div class="card-body">
                        <div class="theme-avtar bg-warning">
                            <i class="ti ti-ticket"></i>
                        </div>
                        <p class="text-muted text-sm mt-4 mb-2"></p>
                        <h6 class="mb-3">{{ __('Hold Ticket') }}</h6>
                        <h3 class="mb-0">{{ $countonholdTicket }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="card ticket-card">
                    <div class="card-body">
                        <div class="theme-avtar bg-danger">
                            <i class="ti ti-ticket"></i>
                        </div>
                        <p class="text-muted text-sm mt-4 mb-2"></p>
                        <h6 class="mb-3">{{ __('Close Ticket') }}</h6>
                        <h3 class="mb-0">{{ $countCloseTicket }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4">
        <div class="card">
            <div class="card-header">
                <div class="float-end">

                </div>
                <h5>{{ __('Ticket By Status') }}</h5>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div id="projects-chart"></div>
                    </div>
                    <div class="col-6">
                        <div class="row mt-3">
                            <div class="col-6">
                                <span class="d-flex align-items-center mb-2">
                                    <i class="f-10 lh-1 fas fa-circle text-danger"></i>
                                    <span class="ms-2 text-sm">{{ __('Close') }} </span>
                                </span>
                            </div>
                            <div class="col-6">
                                <span class="d-flex align-items-center mb-2">
                                    <i class="f-10 lh-1 fas fa-circle text-warning"></i>
                                    <span class="ms-2 text-sm">{{ __('Hold') }}</span>
                                </span>
                            </div>
                            <div class="col-6">
                                <span class="d-flex align-items-center mb-2">
                                    <i class="f-10 lh-1 fas fa-circle text-info"></i>
                                    <span class="ms-2 text-sm">{{ __('Total') }}</span>
                                </span>
                            </div>
                            <div class="col-6">
                                <span class="d-flex align-items-center mb-2">
                                    <i class="f-10 lh-1 fas fa-circle text-primary"></i>
                                    <span class="ms-2 text-sm">{{ __('Open') }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">
                {{-- <h5></h5> --}}
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th>{{ __('New') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Ticket Code') }}</th>
                                @role('company')
                                    <th>{{ __('Employee') }}</th>
                                @endrole
                                <th>{{ __('Priority') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Created By') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th width="200px">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td>
                                        @if (\Auth::user()->type == 'employee')
                                            @if ($ticket->ticketUnread() > 0)
                                                <i title="New Message" class="fas fa-circle circle text-success"></i>
                                            @endif
                                        @else
                                            @if ($ticket->ticketUnread() > 0)
                                                <i title="New Message" class="fas fa-circle circle text-success"></i>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $ticket->title }}</td>
                                    <td>{{ $ticket->ticket_code }}</td>
                                    @role('company')
                                        <td>{{ !empty(\Auth::user()->getUser($ticket->employee_id)) ? \Auth::user()->getUser($ticket->employee_id)->name : '' }}
                                        </td>
                                    @endrole
                                    <td>
                                        @if ($ticket->priority == 'medium')
                                            <div class="badge bg-info p-2 px-3 rounded status-badde3">{{ __('Medium') }}</div>
                                        @elseif($ticket->priority == 'low')
                                            <div class="badge bg-warning p-2 px-3 rounded status-badde3">{{ __('Low') }}</div>
                                        @elseif($ticket->priority == 'high')
                                            <div class="badge bg-success p-2 px-3 rounded status-badde3">{{ __('High') }}</div>
                                        @elseif($ticket->priority == 'critical')
                                            <div class="badge bg-danger p-2 px-3 rounded status-badde3">{{ __('Critical') }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $ticket->statuss }}
                                    </td>
                                    <td>{{ \Auth::user()->dateFormat($ticket->end_date) }}</td>
                                    <td>{{ !empty($ticket->createdBy) ? $ticket->createdBy->name : '' }}</td>
                                    <td>
                                        <p style="white-space: nowrap;
                                            width: 200px;
                                            overflow: hidden;
                                            text-overflow: ellipsis;">{{ $ticket->description }}</p>
                                    </td>
                                    <td class="Action">
                                        <span>
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="{{ URL::to('ticket/' . $ticket->id . '/reply') }}"
                                                    class="mx-3 btn btn-sm  align-items-center" data-bs-toggle="tooltip"
                                                    title="" data-title="{{ __('Replay') }}"
                                                    data-bs-original-title="Reply">
                                                    <i class="ti ti-arrow-back-up text-white"></i>
                                                </a>
                                            </div>

                                            @if (\Auth::user()->type != 'employee')
                                            <button type="button" class="mx-3 btn btn-sm  align-items-center btn-edit" data-toggle="modal" data-target="#exampleModalLong" data-ticket-id="{{ $ticket->id }}" data-ticket-status="{{ $ticket->status }}" onclick="myFunction('{{ $ticket->id }}')">
                                                Edit
                                              </button>
                                              @endif

                                            {{-- <div class="action-btn bg-primary ms-2">
                                                <a href="#" data-url="{{ route('ticket.edit', $ticket->id) }}" data-ajax-popup="true"
                                                data-title="{{ __('Edit Ticket') }}" data-size="lg" data-bs-toggle="tooltip" title=""
                                                class="btn btn-sm btn-primary" data-bs-original-title="{{ __('Edit') }}">
                                                <i class="ti ti-plus"></i>
                                                </a>
                                            </div> --}}

                                            {{-- @can('Editt Ticket') --}}
                                                {{-- <a href="#" data-url="{{ route('ticket.editt/' . $ticket->id) }}" data-ajax-popup="true"
                                                 data-title="{{ __('Edit Ticket') }}" data-size="lg" data-bs-toggle="tooltip" title=""
                                                 class="btn btn-sm btn-primary" data-bs-original-title="{{ __('Edit') }}">
                                                 <i class="ti ti-plus"></i>
                                                </a> --}}
                                                {{-- <a href="#" data-url="{{ route('ticket.editt', ['id' => $ticket->id]) }}" data-ajax-popup="true"
                                                    data-title="{{ __('Edit Ticket') }}" data-size="lg" data-bs-toggle="tooltip" title=""
                                                    class="btn btn-sm btn-primary" data-bs-original-title="{{ __('Edit') }}"> --}}
                                                    <!-- Your link content here -->
                                                 {{-- </a> --}}
                                                 
                                            {{-- @endcan --}}

                                            @if (\Auth::user()->type == 'company' || $ticket->ticket_created == \Auth::user()->id)
                                                @can('Delete Ticket')
                                                    <div class="action-btn bg-danger ms-2">
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['ticket.destroy', $ticket->id], 'id' => 'delete-form-' . $ticket->id]) !!}
                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                            data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                            aria-label="Delete"><i class="ti ti-trash text-white "></i></a>
                                                        </form>
                                                    </div>
                                                @endcan
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <p id='ticket_id'></p> --}}
                    <form id="editTicketForm" action="{{ route('update.status') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input name="tick_id" id="tick_id" hidden>
                            <label for="statusSelect">Status:</label>
                            <select class="form-control" id="statusSelect" name="status">
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="closed">Closed</option>
                            </select>
                        </div>

                        {{-- {{ $gmanagers }} --}}
                        <?php
                        //  echo $gmanagers;
                        ?>
                        {{-- <div class="form-group">
                            <label for="sendToSelect">Send To:</label>
                            <select class="form-control" id="sendToSelect" name="send_to">
                                <option value="team1">Team 1</option>
                                <option value="team2">Team 2</option>
                                <option value="team3">Team 3</option>
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label for="sendToSelect">Send To:</label>
                            <select class="form-control" id="sendToSelect" name="send_to">
                                @foreach ($gmanagers as $gmanager)
                                    <option value="{{ $gmanager->id }}">{{ $gmanager->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
                </div>

                </form>
                
            </div>
        </div>
    </div>
    
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
    <script>
        (function() {
            var options = {
                chart: {
                    height: 140,
                    type: 'donut',
                },
                dataLabels: {
                    enabled: false,
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                        }
                    }
                },
                series: {{ $ticket_arr }},
                colors: ["#3ec9d6", '#6fd943', '#fd7e14', '#ff3a6e'],
                labels: ["Total", "Open", "Hold", "Close"],
                legend: {
                    show: false
                }
            };
            var chart = new ApexCharts(document.querySelector("#projects-chart"), options);
            chart.render();
        })();
    </script>

<script>
        $(document).ready(function() {
        // Listen for the "Edit" button click
        $('.btn-edit').on('click', function() {
            // Get the ticket ID from the data attribute
            const ticketId = $(this).data('ticket-id');
            const ticketStatus = $(this).data('ticket-status');

            var p = document.getElementById("ticket_id");
            p.textContent = ticketId;
            // Use the ticketId to perform actions in your modal
            // For example, you can use it to populate form fields in the modal
            // or make an AJAX request to fetch data related to the ticket.

            console.log('Edit button clicked for ticket ID:', ticketId);
        });
    });

    function myFunction(id){
        var set_id = document.getElementById("tick_id");
        set_id.value = id;
    }

    // function myFunction(id){
    //     // alert(id);
    //     $.ajax({
    //            type:'POST',
    //            url:'{{ route('get.status') }}',
    //            data: id,
    //            _token: csrf,
    //            success:function(data) {
    //               $("#msg").html(data.statuss);
    //            }
    //         });
    // }
</script>
@endpush
