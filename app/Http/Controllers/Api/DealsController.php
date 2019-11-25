<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Deals;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use App\Http\Controllers\Controller;
class DealsController extends Controller
{
      //------------- [ Create new Deal ] ----------------
 
      public function createDeal(Request $request) {
        $img_name = "";
 
        // validate input
        $validator  =   Validator::make($request->all(),
            [
                'title'=>'required',
            ]
        );
        // if validation fails
        if($validator->fails()) {
            return response()->json(["validation errors" => $validator->errors()]);
        }
 
        // Retrieve User with acccess token
        $user = Auth::user();
 
        // Upload Featured Image   
        $validator      =   Validator::make($request->all(),
           ['featured_img'      =>   'required|mimes:jpeg,png,jpg,bmp|max:2048']);
  
        // if validation fails
        if($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        if($file   =   $request->file('featured_img')) {
            $img_name      =   time().time().'.'.$file->getClientOriginalExtension();
            $target_path    =   public_path('/uploads/');
                $file->move($target_path, $img_name);    
                // Creating slug 
                 $slug           =       str_replace(" ", "-", strtolower($request->title));
                 $slug           =       preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
                 $slug           =       preg_replace('/-+/', '-', $slug);
 
                // creating array of inputs
                $input              =       array(
                    'title'          =>          $request->title,
                    'slug'           =>          $slug,
                    'featured_img'   =>          $img_name,  
                    'user_id'        =>          $user->id
                );
 
                // save into database
                $post = Deals::create($input);
        }
        return response()->json(["success" => true, "data" => $post]);
    }
 
 
    // --------- [ Post Listing By User Token ] -------------
    public function postListing() {
 
        // Get user of access token
        $user           =       Auth::user();
         // Listing post through user id
        $posts          =       Deals::where("user_id", $user->id)->get();
         return response()->json(["success" => true, "data" => $posts]);
    }

    
        public function store(Request $request)
        {
            // dd($request->all());
           
            $deal = new Deals();
            $deal->company_name = $request->company_name;
            $deal->company_type = $request->input('company_type');
            $deal->industry = $request->input('industry');
            $deal->address = $request->input('address');
            $deal->phone = $request->input('phone');
            $deal->email = $request->input('email');
            $deal->amount_to_raise = $request->input('amount_to_raise');
            $deal->company_cover_photo = $request->input('company_cover_photo');
            $deal->company_details = $request->input('company_details');
            $deal->business_plan = $request->input('business_plan');
            $deal->memo_of_understanding = $request->input('memo_of_understanding');
            $deal->cert_of_registration = $request->input('cert_of_registration');
            $deal->financial_state = $request->input('financial_state');
            $deal->cash_flow = $request->input('cash_flow');
            $deal->contract_doc = $request->input('contract_doc');
            $deal->certified_audit_acc = $request->input('certified_audit_acc');
            $deal->company_name = $request->input('company_name');
    
    //    dd($deal);
            $deal->save();
            // return $this->sendResponse($deal->toArray(), 'Deal created successfully.');
            return response()->json($request->all(),200);
        }    
    
}
