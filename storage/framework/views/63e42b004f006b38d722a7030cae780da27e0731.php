<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php $__env->startSection('page-title'); ?>
   <?php echo e(__('Manage Ticket')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Manage Ticket')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Ticket')): ?>
        <a href="#" data-url="<?php echo e(route('ticket.create')); ?>" data-ajax-popup="true"
            data-title="<?php echo e(__('Create New Ticket')); ?>" data-size="lg" data-bs-toggle="tooltip" title=""
            class="btn btn-sm btn-primary" data-bs-original-title="<?php echo e(__('Create')); ?>">
            <i class="ti ti-plus"></i>
        </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="col-xxl-8">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="card ticket-card">
                    <div class="card-body">
                        <div class="theme-avtar bg-info">
                            <i class="ti ti-ticket"></i>
                        </div>
                        <p class="text-muted text-sm mt-4 mb-2"></p>
                        <h6 class="mb-3"><?php echo e(__('Total Ticket')); ?></h6>
                        <h3 class="mb-0"><?php echo e($countTicket); ?> </h3>
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
                        <h6 class="mb-3"><?php echo e(__('Open Ticket')); ?></h6>
                        <h3 class="mb-0"><?php echo e($countOpenTicket); ?></h3>
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
                        <h6 class="mb-3"><?php echo e(__('Hold Ticket')); ?></h6>
                        <h3 class="mb-0"><?php echo e($countonholdTicket); ?></h3>
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
                        <h6 class="mb-3"><?php echo e(__('Close Ticket')); ?></h6>
                        <h3 class="mb-0"><?php echo e($countCloseTicket); ?></h3>
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
                <h5><?php echo e(__('Ticket By Status')); ?></h5>
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
                                    <span class="ms-2 text-sm"><?php echo e(__('Close')); ?> </span>
                                </span>
                            </div>
                            <div class="col-6">
                                <span class="d-flex align-items-center mb-2">
                                    <i class="f-10 lh-1 fas fa-circle text-warning"></i>
                                    <span class="ms-2 text-sm"><?php echo e(__('Hold')); ?></span>
                                </span>
                            </div>
                            <div class="col-6">
                                <span class="d-flex align-items-center mb-2">
                                    <i class="f-10 lh-1 fas fa-circle text-info"></i>
                                    <span class="ms-2 text-sm"><?php echo e(__('Total')); ?></span>
                                </span>
                            </div>
                            <div class="col-6">
                                <span class="d-flex align-items-center mb-2">
                                    <i class="f-10 lh-1 fas fa-circle text-primary"></i>
                                    <span class="ms-2 text-sm"><?php echo e(__('Open')); ?></span>
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
                
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th><?php echo e(__('New')); ?></th>
                                <th><?php echo e(__('Title')); ?></th>
                                <th><?php echo e(__('Ticket Code')); ?></th>
                                <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'company')): ?>
                                    <th><?php echo e(__('Employee')); ?></th>
                                <?php endif; ?>
                                <th><?php echo e(__('Priority')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Created By')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <th width="200px"><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php if(\Auth::user()->type == 'employee'): ?>
                                            <?php if($ticket->ticketUnread() > 0): ?>
                                                <i title="New Message" class="fas fa-circle circle text-success"></i>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if($ticket->ticketUnread() > 0): ?>
                                                <i title="New Message" class="fas fa-circle circle text-success"></i>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($ticket->title); ?></td>
                                    <td><?php echo e($ticket->ticket_code); ?></td>
                                    <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'company')): ?>
                                        <td><?php echo e(!empty(\Auth::user()->getUser($ticket->employee_id)) ? \Auth::user()->getUser($ticket->employee_id)->name : ''); ?>

                                        </td>
                                    <?php endif; ?>
                                    <td>
                                        <?php if($ticket->priority == 'medium'): ?>
                                            <div class="badge bg-info p-2 px-3 rounded status-badde3"><?php echo e(__('Medium')); ?></div>
                                        <?php elseif($ticket->priority == 'low'): ?>
                                            <div class="badge bg-warning p-2 px-3 rounded status-badde3"><?php echo e(__('Low')); ?></div>
                                        <?php elseif($ticket->priority == 'high'): ?>
                                            <div class="badge bg-success p-2 px-3 rounded status-badde3"><?php echo e(__('High')); ?></div>
                                        <?php elseif($ticket->priority == 'critical'): ?>
                                            <div class="badge bg-danger p-2 px-3 rounded status-badde3"><?php echo e(__('Critical')); ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo e($ticket->statuss); ?>

                                    </td>
                                    <td><?php echo e(\Auth::user()->dateFormat($ticket->end_date)); ?></td>
                                    <td><?php echo e(!empty($ticket->createdBy) ? $ticket->createdBy->name : ''); ?></td>
                                    <td>
                                        <p style="white-space: nowrap;
                                            width: 200px;
                                            overflow: hidden;
                                            text-overflow: ellipsis;"><?php echo e($ticket->description); ?></p>
                                    </td>
                                    <td class="Action">
                                        <span>
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="<?php echo e(URL::to('ticket/' . $ticket->id . '/reply')); ?>"
                                                    class="mx-3 btn btn-sm  align-items-center" data-bs-toggle="tooltip"
                                                    title="" data-title="<?php echo e(__('Replay')); ?>"
                                                    data-bs-original-title="Reply">
                                                    <i class="ti ti-arrow-back-up text-white"></i>
                                                </a>
                                            </div>

                                            <?php if(\Auth::user()->type != 'employee'): ?>
                                            <button type="button" class="mx-3 btn btn-sm  align-items-center btn-edit" data-toggle="modal" data-target="#exampleModalLong" data-ticket-id="<?php echo e($ticket->id); ?>" data-ticket-status="<?php echo e($ticket->status); ?>" onclick="myFunction('<?php echo e($ticket->id); ?>')">
                                                Edit
                                              </button>
                                              <?php endif; ?>

                                            

                                            
                                                
                                                
                                                    <!-- Your link content here -->
                                                 
                                                 
                                            

                                            <?php if(\Auth::user()->type == 'company' || $ticket->ticket_created == \Auth::user()->id): ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Ticket')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['ticket.destroy', $ticket->id], 'id' => 'delete-form-' . $ticket->id]); ?>

                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                            data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                            aria-label="Delete"><i class="ti ti-trash text-white "></i></a>
                                                        </form>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    
                    <form id="editTicketForm" action="<?php echo e(route('update.status')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <input name="tick_id" id="tick_id" hidden>
                            <label for="statusSelect">Status:</label>
                            <select class="form-control" id="statusSelect" name="status">
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="closed">Closed</option>
                            </select>
                        </div>

                        
                        <?php
                        //  echo $gmanagers;
                        ?>
                        
                        <div class="form-group">
                            <label for="sendToSelect">Send To:</label>
                            <select class="form-control" id="sendToSelect" name="send_to">
                                <?php $__currentLoopData = $gmanagers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gmanager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($gmanager->id); ?>"><?php echo e($gmanager->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>
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
                series: <?php echo e($ticket_arr); ?>,
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
    //            url:'<?php echo e(route('get.status')); ?>',
    //            data: id,
    //            _token: csrf,
    //            success:function(data) {
    //               $("#msg").html(data.statuss);
    //            }
    //         });
    // }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/devopcom/hrm.devop360.com/resources/views/ticket/index.blade.php ENDPATH**/ ?>