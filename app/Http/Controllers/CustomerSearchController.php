<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class CustomerSearchController extends Controller
{
    public function searchCustomer(Request $request)
    {
        if ($request->ajax()) {
            $s_id = $request->get('id');
            $id = (base64_decode($s_id) * 12098) / 123456789;

            $profile = Profile::find($id);

            $customer = '<div class="modal fade" id="display-customer">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button class="close" data-dismiss="modal">&times;</button>
                            <div class="profile-header">
                                <div class="avatar float-left mr-3" style="width:100px;height:100px;border: 1px solid black;border-radius: 5px;overflow: hidden;">
                                    <img src="'. asset('images/dps/' . $profile->avatar) .'" width="100%" alt="Image not found">
                                </div>
                                <div class="float-left">
                                    <h3 class="mb-1 fw-700">'. $profile->name .'</h3>
                                    <h5 class="fw-700"> S/O ' . $profile->father_name .'</h5>
                                    <h5 class="fw-700"><i class="fas fa-address-card"></i> '.$profile->cnic .'</h5>
                                    <h5 class="fw-700"><i class="fas fa-phone"></i> '. $profile->phone_number .'</h5>
                                </div>
                                <br class="clear">
                            </div>
                            <hr>
                            <div>
                                <div class="row mb-3">
                                    <p class="col-md-6 mb-0"><strong>Property:</strong> '. $profile->property . ' Acres</p>
                                    <p class="col-md-6 mb-0"><strong>Role:</strong> '. $profile->role->name .'</p>
                                    <p class="col-12 mb-0"><strong>Address:</strong> '. $profile->address .'</p>
                                </div>
                                <div>
                                    <a href="'. route('profile.edit', base64_encode(($profile->id * 123456789) / 12098)) .'" class="btn btn-success float-right"><i class="fas fa-edit"></i> Edit Customer</a>
                                    <a href="'. route('profile.show', base64_encode(($profile->id * 123456789) / 12098)) .'" class="btn btn-outline-danger float-right mr-2"><i class="fas fa-user"></i> View Detail</a>
                                    <button class="btn btn-danger float-right mr-2" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                                    <br class="clear">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';

            $data = ['profile'=>$customer];
            return json_encode($data);
        }
    }
}
