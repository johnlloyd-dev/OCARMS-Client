<!-- Donation Modal -->
<div class="modal fade" id="addnew<?php echo $row['fundraise_id'];?>" data-backdrop="static" role="dialog">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;
               </span>
            </button>
         </div>
         <div class="modal-body">
            <div class="container-fluid">
               <div class="border mt-3 rounded">
                  <form method="POST" action="includes/monetary_campaign/connections.php">
                     <input type="hidden" name="client_id" value="<?=$user['client_id'];?>">
                     <div class="p-3 mb-2 bg-warning rounded-top text-dark-blue text-center">Yes I want to donate to
                        <br><strong><q><?php echo $row['fundraise_title'];?></q></strong></div>
                     <div class="p-2 mt-3">
                        <div class="row justify-content-center">
                           <div class="col-6">
                              <select name="select_amount" id="select_amount" class="form-control font-italic border-warning text-center">
                                 <option selected value="100">100</option>
                                 <option value="200">200</option>
                                 <option value="500">500</option>
                                 <option value="1000">1000</option>
                              </select>
                           </div>
                        </div>
                        <div style="height:10px;">
                        </div>
                        <div class="separator"><label>Or Enter Your Own Amount</label></div>
                        <div class="row justify-content-center">
                           <div class="col-6 text-center">
                              <input type="text" name="enter_amount" id="enter_amount" class="form-control border-warning text-center">
                              <p>Peso(s)</p>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">
                           <i class="fas fa-times-circle">
                           </i> Cancel
                        </button>
                        <?php
                           if(isset($_SESSION['login_id'])){
                              $event_id = $row['fundraise_id'];
                              echo "<button type='submit' name='fundraise_id' value='$event_id' class='btn btn-dark btn-sm'><i class='fas fa-hand-holding-heart'></i> Donate Today</button>";
                           }else{
                              echo "<a href='user_credentials_register.php?l=1' class='btn btn-dark btn-sm'><i class='fas fa-hand-holding-heart'></i> Donate Today</a>";
                           }
                        ?>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
