<!-- Modal -->
<div class="modal fade" id="moneyModal<?=$get['donation_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Donation Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Donation Date: <strong class="text-primary"><?=$get['donation_date'];?></strong> </li>
                        <li class="list-group-item">Fundraise Name: <strong class="text-primary"><?=$get2['fundraise_title'];?></strong> </li>
                        <li class="list-group-item">Donation Amount: <strong class="text-primary"><?=$get['donation_amount'];?></strong> </li>
                        <li class="list-group-item">Payment Method: <strong class="text-primary"><?=$get['donation_method'];?></strong> </li>
                        <li class="list-group-item">Status: <strong class="text-primary"><?=$get['donation_status'];?></strong> </li>
                        <li class="list-group-item">Donation Type: <strong class="text-primary"><?=$get['donation_type'];?></strong> </li>
                        <li class="list-group-item">Remarks: <strong class="text-primary"><?=$get['donation_remarks'];?></strong> </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>