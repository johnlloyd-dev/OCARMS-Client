<!-- Modal -->
<div class="modal fade" id="atcaModal<?=$get['vl_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Event Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Signup Date/Time: <strong class="text-primary"><?=date("F j, Y", strtotime($get['vl_signup_date'])); echo "/"; echo date("g:i A", strtotime($get['vl_signup_time']))?></strong> </li>
                        <li class="list-group-item">Event Name: <strong class="text-primary"><?=$get2['ve_name'];?></strong> </li>
                        <li class="list-group-item">Event Date: <strong class="text-primary"><?=date("F j, Y", strtotime($get2['ve_date']));?></strong> </li>
                        <li class="list-group-item">Event Time: <strong class="text-primary"><?=date("g:i A", strtotime($get2['ve_time']));?></strong> </li>
                        <li class="list-group-item">Event Location: <strong class="text-primary"><?=$get2['ve_location'];?></strong> </li>
                        <li class="list-group-item">Hours: <strong class="text-primary"><?=$get['vl_total_hours'];?></strong> </li>
                        <li class="list-group-item">Application Status: <strong class="text-primary"><?=$get['vl_status'];?></strong> </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>