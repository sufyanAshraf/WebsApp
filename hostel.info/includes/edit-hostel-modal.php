<!-- edit hostel Modal -->
<div class="modal fade" id="myModalEditHostel" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit your hostel data</h5>
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            
            <!-- Start edit hostel form -->
                <div class="container-fluid">
                    <h1 class="text-center my-4"> Fill this out </h1>
                    <form name = "editHostel" action = "<?php echo $domain.$root_folder."server/hostel-admin-control.php"; ?>" method = "GET" enctype = "multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group mb-1 mb-md-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                    </div>
                                    <input class="form-control" type="text" name="edit_hostel_name" placeholder="Hostel name" required>
                                </div>
                                <div class="input-group mb-1 mb-md-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-city"></i></div>
                                    </div>
                                    <select class="form-control" id="City" name="edit_hostel_city" required>
                                        <option value="" disabled selected>Select your City</option>
                                        <option value="Lahore">Lahore</option>
                                        <option value="Islamabad">Islamabad</option>
                                        <option value="Karachi">Karachi</option>
                                        <option value="Faisalabad">Faisalabad</option>
                                        <option value="Peshawar">Peshawar</option>
                                        <option value="Quetta">Quetta</option>
                                    </select>
                                </div>
                                <div class="input-group mb-1 mb-md-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-map-marked-alt"></i></div>
                                    </div>
                                    <input class="form-control" type="text" onkeyup="if(validateHostelName(this.value)) {this.style.borderColor='green'} else {this.style.borderColor='red'}" name="edit_hostel_address" placeholder ="Address" required>
                                </div>
                                <div class="input-group mb-1 mb-md-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-door-open"></i></div>
                                    </div>
                                    <input class="form-control" type="number" name="edit_hostel_rooms" placeholder="Rooms Available" required>
                                </div>

                                <textarea name="edit_hostel_extras" placeholder="Additional Facilities" class="col-12" rows="5"></textarea>
                                <input type="hidden" id="hostel_hidden_id" name="edit_hostel_id" value="">
                                <button id="editHostel" type="submit" name="editHostel" class="btn btn-block btn-outline-dark mb-1 mb-md-2"> Edit Hostel </button>
                                
                            </div>
                        </div> 
                    </form>
                </div>
                <!-- END edit hostel form -->
            </div>
        </div>
    </div>
</div>
    <!-- End Modal -->

    <!-- edit pending hostel Modal -->
<div class="modal fade" id="myModalEditPendingHostel" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit your hostel data</h5>
            <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            
            <!-- Start edit hostel form -->
                <div class="container-fluid">
                    <h1 class="text-center my-4"> Fill this out </h1>
                    <form name = "editHostelPending" action = "<?php echo $domain.$root_folder."server/hostel-admin-control.php" ?>" method = "GET" enctype = "multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group mb-1 mb-md-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                    </div>
                                    <input class="form-control" onkeyup="if(validateHostelName(this.value)) {this.style.borderColor='green'} else {this.style.borderColor='red'}" type="text" name="edit_hostel_name" placeholder="Hostel name" required>
                                </div>
                                <div class="input-group mb-1 mb-md-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-city"></i></div>
                                    </div>
                                    <select class="form-control" id="City" name="edit_hostel_city" required>
                                        <option value="" disabled selected>Select your City</option>
                                        <option value="Lahore">Lahore</option>
                                        <option value="Islamabad">Islamabad</option>
                                        <option value="Karachi">Karachi</option>
                                        <option value="Faisalabad">Faisalabad</option>
                                        <option value="Peshawar">Peshawar</option>
                                        <option value="Quetta">Quetta</option>
                                    </select>
                                </div>
                                <div class="input-group mb-1 mb-md-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-map-marked-alt"></i></div>
                                    </div>
                                    <input class="form-control" type="text" name="edit_hostel_address" placeholder ="Address" required>
                                </div>
                                <div class="input-group mb-1 mb-md-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-door-open"></i></div>
                                    </div>
                                    <input class="form-control" type="number" name="edit_hostel_rooms" placeholder="Rooms Available" required>
                                </div>

                                <textarea name="edit_hostel_extras" placeholder="Additional Facilities" class="col-12" rows="5"></textarea>
                                <input type="hidden"  id="pending_hostel_hidden_id" name="edit_hostel_id" value="">
                                <button id="editHostel" type="submit" name="editHostelPending" class="btn btn-block btn-outline-dark mb-1 mb-md-2"> Edit Hostel </button>
                                
                            </div>
                        </div> 
                    </form>
                </div>
                <!-- END edit hostel form -->
            </div>
        </div>
    </div>
</div>