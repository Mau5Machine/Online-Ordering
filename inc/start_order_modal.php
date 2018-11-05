<div class="modal fade" id="modalStartOrder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Pickup Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="pickup-details-form" method="post">
                <div class="modal-body mx-3">
                    <div class="md-form my-5 row">
                        <i class="fa fa-user fa-2x col-2" aria-hidden="true"></i>
                        <input type="text" id="startName" class="form-control col-10 float-right" placeholder="Full Name Here"
                            name="order_user">
                    </div>

                    <div class="md-form my-5 row">
                        <i class="fa fa-envelope fa-2x col-2" aria-hidden="true"></i>
                        <input type="email" id="startEmail" class="form-control col-10 float-right" placeholder="Email Address Here"
                            name="order_email">
                    </div>

                    <div class="md-form my-5 row">
                        <i class="fa fa-phone fa-2x col-2" aria-hidden="true"></i>
                        <input type="tel" id="startPhone" class="form-control col-10 float-right" placeholder="Phone Number Here"
                            name="order_phone">
                    </div>

                    <div class="md-form my-5 row">
                        <i class="fa fa-calendar fa-2x col-2" aria-hidden="true"></i>
                        <input type="text" id="startDate" class="form-control col-10 float-right" placeholder="Please Select a  Pickup Date"
                            name="order_date">
                        <button type="button" class="btn btn-sm btn-success mt-3" data-toggle="popover" title="48 Hour Notice"
                            data-placement="bottom" data-content="Our Catering Department needs AT LEAST a 48 hour notice to prepare the orders"
                            id="popover-notice"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Important
                            Details</button>
                    </div>

                    <div class="md-form my-5 row">
                        <i class="fa fa-clock fa-2x col-2" aria-hidden="true"></i>
                        <select name="order_time" class="form-control col-10 float-right">
                            <option value="">Select A Time</option>
                            <option value="8:00AM">8:00 AM</option>
                            <option value="8:30AM">8:30 AM</option>
                            <option value="9:00AM">9:00 AM</option>
                            <option value="9:30AM">9:30 AM</option>
                            <option value="10:00AM">10:00 AM</option>
                            <option value="10:30AM">10:30 AM</option>
                            <option value="11:00AM">11:00 AM</option>
                            <option value="11:30AM">11:30 AM</option>
                            <option value="12:00PM">12:00 PM</option>
                            <option value="12:30PM">12:30 PM</option>
                            <option value="1:00PM">1:00 PM</option>
                            <option value="1:30PM">1:30 PM</option>
                            <option value="2:00PM">2:00 PM</option>
                            <option value="2:30PM">2:30 PM</option>
                            <option value="3:00PM">3:00 PM</option>
                            <option value="3:30PM">3:30 PM</option>
                            <option value="4:00PM">4:00 PM</option>
                            <option value="4:30PM">4:30 PM</option>
                            <option value="5:00PM">5:00 PM</option>
                            <option value="5:30PM">5:30 PM</option>
                            <option value="6:00PM">6:00 PM</option>
                            <option value="6:30PM">6:30 PM</option>
                            <option value="7:00PM">7:00 PM</option>
                            <option value="7:30PM">7:30 PM</option>
                            <option value="8:00PM">8:00 PM</option>
                            <option value="8:30PM">8:30 PM</option>
                            <option value="9:00PM">9:00 PM</option>
                        </select>
                        <div class="pickup-times mt-4">
                            <span class="ml-4"><i class="fa fa-exclamation-circle mb-3" aria-hidden="true"></i>
                                Available
                                Pickup Times</span>
                            <p><strong>Monday - Friday:</strong> <span class="times">8:00AM to 9:00PM</span></p>
                            <p><strong>Saturday:</strong> <span class="times">8:00AM to 10:00PM</span></p>
                            <p><strong>Sunday:</strong> <span class="times">8:00AM to 8:00PM</span></p>

                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary" id="start-btn">Start Order <i class="material-icons">
                            restaurant_menu
                        </i></button>
                </div>
            </form>
        </div>
    </div>
</div>