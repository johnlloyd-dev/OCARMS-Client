<!-- Donation Modal -->
<div class="modal fade" id="donate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <div class="main-content">
                            <div class="container">
                                <div class="row justify-content-center mb-3 mt-5">
                                    <div class="col-lg-6 drop">
                                        <h6 class="text-center">Here's what is your</h6>
                                        <h5 class="text-center">Goods Donation</h5>
                                        <img class="img-profile rounded-circle" src="<?php echo $image_src; ?>"
                                            alt="<?php echo $user['client_name']; ?>">
                                    </div>
                                </div>

                                <div class="row mt-5 justify-content-center">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <h6>Goods Classification</h6>
                                                            <p class="text-success" id="goods_c"></p>
                                                            <h6>Pickup Location</h6>
                                                            <p class="text-success" id="pickup_l"></p>
                                                            <h6>Goods Description</h6>
                                                            <p class="text-success" id="goods_d"></p>
                                                            <h6>Goods Image</h6>
                                                            <img id="imagePreview2" style="object-fit: cover;" width="200rem" height="190rem"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-5 justify-content-center">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="text-center m-2">Make this an anonymous donation?
                                                    charity?</h5>
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-6 check-box">
                                                        <input id="chck" class="input-radio" type="checkbox">
                                                        <label for="chck" class="check-trail">
                                                            <span class="check-handler"></span>
                                                        </label>
                                                        <h6 class="text-center">Click above button to select.</h6>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-center">
                                                    <div id="cloned" class="col-lg-10">
                                                        <div id="content">
                                                            <div class="form-group mt-4">
                                                                <label for="fname">First Name:</label>
                                                                <input type="text" class="form-control" id="fname"
                                                                    name="account_fname"
                                                                    value="<?=$user['client_fname'];?>" required>
                                                            </div>
                                                            <div class="form-group mt-4 mb-0">
                                                                <label for="lname">Last Name:</label>
                                                                <input type="text" class="form-control" id="lname"
                                                                    name="account_lname"
                                                                    value="<?=$user['client_lname'];?>" required>
                                                            </div>
                                                            <i class="f-size text-danger">Note: Any changes done with
                                                                your name above will also change your account name.</i>
                                                            <hr>
                                                            <div class="form-group">
                                                                <label for="name">Contact Email:</label>
                                                                <input type="email" class="form-control" id="email"
                                                                    value="<?=$user['client_email_address'];?>" readonly
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="gender1">Gender:</label>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="gender" id="gender1" value="Male"
                                                                        <?php if($user['client_gender'] == "Male"){echo "checked";} ?>
                                                                        required />
                                                                    <label class="form-check-label" for="gender1">
                                                                        Male
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="gender" id="gender2" value="Female"
                                                                        <?php if($user['client_gender'] == "Female"){echo "checked";} ?>>
                                                                    <label class="form-check-label" for="gender2">
                                                                        Female
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-5 justify-content-center">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="text-center m-2">Date of Birth</h5>
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-10">
                                                        <div class="form-group mt-4">
                                                                <label for="contact_number">Contact Number:</label>
                                                                <input type="text" class="form-control"
                                                                    id="contact_number" name="contact_number"
                                                                    value="<?=$user['client_contact_number'];?>"
                                                                    required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">You must be at least 13 years old to make
                                                                a donation on OCARMS.</label>
                                                            <input type="date" class="form-control" name="birth_date"
                                                                id="name" value="<?=$user['client_birth_date'];?>"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3 justify-content-center">
                                    <div class="col-lg-6 text-center">
                                        <button type="submit" id="donate" class='btn btn-warning text-dark-blue mt-3'><i
                                                class='fas fa-hand-holding-usd'></i> Donate Now</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
