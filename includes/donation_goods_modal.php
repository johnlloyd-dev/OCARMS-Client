<!-- Modal -->
<div class="modal fade" id="goodsModal<?=$get3['donation_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <li class="list-group-item">Donation Date: <strong class="text-primary"><?=$get3['donation_date'];?></strong> </li>
                        <li class="list-group-item">Goods Classification: <strong class="text-primary"><?=$get3['goods_classification'];?></strong> </li>
                        <li class="list-group-item">Goods Description: <strong class="text-primary"><?=$get3['goods_description'];?></strong> </li>
                        <li class="list-group-item">Pickup Location: <strong class="text-primary"><?=$get3['pickup_location'];?></strong> </li>
                        <li class="list-group-item">Status: <strong class="text-primary"><?=$get3['donation_status'];?></strong> </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>