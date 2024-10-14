<!-- Donation Modal -->
<div class="modal fade" id="exist_modal<?php echo $row['fundraise_id'];?>" data-backdrop="static" role="dialog">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" id="close-2" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;
               </span>
            </button>
         </div>
         <div class="modal-body">
            <div class="container-fluid">
               <div class="border mt-3 rounded">
                  <form method="POST" action="includes/monetary_campaign/connections.php">
                     <input type="hidden" name="client_id" value="<?=$user['client_id'];?>">
                     <div class="p-3 mb-2 bg-warning rounded-top text-dark-blue text-center">You have previously added a donation of <b>$100</b>
                        <br><strong><q><?php echo $row['fundraise_title'];?></q>.</strong>
                        <p class="text-center">Would you like to combine the donation amounts?</p>
                    </div>
                     <div class="p-2 mt-3">
                        <div class="row justify-content-center">
                           <div class="col-lg-6 text-center">
                                <button type='submit' name='fundraise_id' id="btn_yes" value='' class='btn f-size btn-primary btn-sm rounded-pill p-3'></button>
                           </div>
                           <div class="col-lg-6 text-center">
                                <button type='submit' name='fundraise_id' id="btn-no" value='' class='btn f-size btn-dark btn-sm rounded-pill p-3'></button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
