<!-- Donation Modal -->
<div class="modal fade" id="volunteer<?php echo $row['ve_id'];?>" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <form method="POST" action="includes/volunteer_activities/connections.php">
                            <input type="hidden" name="fr_title" class="form-control border-warning text-center"
                                value="<?php echo $row['ve_name'];?>">
                            <div class="p-3 mb-2 bg-warning rounded-top text-dark-blue text-center drop">
                                <img class="img-profile rounded-circle" src="<?php echo $image_src; ?>"
                                    alt="<?php echo $user['client_name']; ?>">
                                <h3 class="font-weight-bold">Hello, <?php echo $user['client_name'];?></h3>
                                <p>You are signing up as a Volunteer.</p>
                            </div>
                            <input type="hidden" name="client_name" value="<?=$user['client_name'];?>">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-12">
                                    <div class="p-2">
                                        <h6 class="text-center text-dark">Yes I want to sign up as
                                            <h5 class="text-center">Volunteer</h5>
                                        </h6>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="p-2">
                                        <h6 class="text-center text-dark">for
                                            <h5 class="text-center"><?=$row['ve_name'];?></h5>
                                        </h6>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="p-2">
                                        <h6 class="text-center text-dark">on
                                            <h5 class="text-center">
                                                <?=date('l jS \of F Y', strtotime($row['ve_date'])); ?></h5>
                                            <h5 class="text-center">
                                                <?=date('h:i A', strtotime($row['ve_time'])); ?></h5>
                                            <h5 class="text-center">at <?=$row['ve_location']; ?></h5>
                                        </h6>
                                    </div>
                                    <hr />
                                </div>
                                <div class="col-lg-12">
                                    <div class="pl-4 pr-4">
                                    <div class="card">
                                        <div class="card-header bg-dark-orange text-dark-blue">
                                            Points To Note
                                        </div>
                                        <div class="card-body text-dark-blue">
                                            <p class="text-justify">Your request will go through an approval process by
                                                our Volunteer Manager or Volunteer Leader.</p>
                                        </div>
                                    </div>
                                    </div>
                                    <hr />
                                </div>
                                <div class="col-lg-12">
                                    <div class="pl-4 pr-4">
                                        <h5>Personal Details</h5>
                                        <h6>We need the following details from you to sign up!<h6>
                                                <div class="form-group">
                                                    <label for="contact_number">Contact Number:</label>
                                                    <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?=$user['client_contact_number'];?>" required>
                                                    <input type="hidden" name="client_id" value="<?=$user['client_id'];?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Address:</label>
                                                    <input type="text" class="form-control" id="address" name="address" value="<?=$user['client_address'];?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="date">Date of Birth:</label>
                                                    <input type="date" class="form-control" id="date" name="b_date" value="<?=$user['client_birth_date'];?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="male">Gender:</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="male" value="Male" <?php if($user['client_gender']=="Male"){echo 'checked';} ?> required>
                                                        <label class="form-check-label" for="male">
                                                            Male
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?php if($user['client_gender']=="Female"){echo 'checked';} ?>>
                                                        <label class="form-check-label" for="female">
                                                            Female
                                                        </label>
                                                    </div>
                                                </div>
                                    </div>
                                    <hr />
                                </div>
                                <div class="col-lg-12">
                                    <div class="pl-4 pr-4">
                                        <div class="form-group">
                                            <h5>Other Information</h5>
                                            
                                            <textarea class="form-control" name="others" id="others" rows="3" placeholder="Is there anything else you'd like the organizer to know about you?" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck" required>
                                            <label class="form-check-label" for="gridCheck">
                                                I agree with the <a href="#">Terms & Conditions</a>
                                            </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">
                                    <i class="fas fa-times-circle">
                                    </i> Cancel
                                </button>
                                <button type="submit" name="event_id" value="<?=$row['ve_id'];?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-hands-helping">
                                    </i> Volunteer Today
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
