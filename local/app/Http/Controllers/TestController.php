<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\HomeStay;
use App\Models\BedRoom;

class TestController extends Controller
{
	public function postCreateUser(Request $request){
		$user = new User;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->phone = $request->phone;
		$user->nation = $request->nation;
		$user->save();
	}

	public function addBedRoom($id,Request $request){
        $bedroom = new BedRoom;
        $bedroom->bedroom_name = $request->bedroom_name;
        $bedroom->bedroom_bed = $request->bedroom_bed;
        //image
        if ( $request->hasFile('bedroom_image') ) {
			$image = saveImage($request->bedroom_image,400,'image'); //helper function
			$bedroom->bedroom_image = $image;
		}
        $bedroom->bedroom_slot = $request->bedroom_slot;
        $bedroom->bedroom_bath = $request->bedroom_bath;
        $bedroom->bedroom_description = $request->bedroom_description;
        $bedroom->bedroom_price_night = $request->bedroom_price_night;
        $bedroom->bedroom_facility = $request->bedroom_facility;

        $bedroom->bedroom_homestay_id = $request->bedroom_homestay_id;
        $bedroom->save();
	}

	public function addBedRoomPicture($id,Request $request){
		$bedroom = BedRoom::find($id);
		$bedroom->bedroom_price_night = $request->bedroom_price_night;
		$bedroom->bedroom_price_week = $request->bedroom_price_week;
		$bedroom->bedroom_price_month = $request->bedroom_price_month;
		$bedroom->bedroom_price_night_indi = $request->bedroom_price_night_indi;
		$bedroom->bedroom_price_week_indi = $request->bedroom_price_week_indi;
		$bedroom->bedroom_price_month_indi = $request->bedroom_price_month_indi;
		$bedroom->save();
	}

	public function editBedRoomPrice($id,Request $request){
		$bedroom = BedRoom::find($id);
		$bedroom->bedroom_price_night = $request->bedroom_price_night;
		$bedroom->save();
	}

	public function addHomeStay($id,Request $request){
		$homestay = HomeStay::find($id);
		$homestay->homestay_name = $request->homestay_name;
		$homestay->homestay_about = $request->homestay_about;

        //facility
		$strFacility = implode(',', $request->homestay_facility);
		$homestay->homestay_facility = $strFacility;

		$homestay->homestay_location = $request->homestay_location;

		$homestay->homestay_rule = $request->homestay_rule;
		$homestay->homestay_kitchen = $request->homestay_kitchen;
		$homestay->homestay_meal = $request->homestay_meal;
		$homestay->homestay_user_id = $request->homestay_user_id;
		$homestay->save();
	}

	public function addHomeStayImage(Request $request){
		//image
		if ( $request->hasFile('homestay_image') ) {
			$homestay = HomeStay::find($id);
			$image = saveImage($request->homestay_image,400,'image'); //helper function
			$homestay->homestay_image += ','.$image;
			$homestay->save();
		}
	}

	public function addComment(Request $request){
		$comment = new Comment;
		$comment->comment_rate = $request->comment_rate;
		$comment->comment_content = $request->comment_content;
		$comment->comment_homestay_id = $request->comment_homestay_id;
	}

	public function search(Request $request){
		$homestay = HomeStay::where()
							->where()
							->get();
	}
}
