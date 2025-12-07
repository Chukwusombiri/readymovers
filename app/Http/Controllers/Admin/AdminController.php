<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\EmailSubscriber;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard')->with([
            'orders' => Order::all(),
            'categories' => Item::all(),
        ]);
    }

    public function orders(){
        return view('admin.orders');
    }

    public function editOrder($id){
        try {
            $order = Order::findOrFail($id);
            return view('admin.edit_order')->with('order',$order);
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    public function categories(){
        return view('admin.categories');
    }

    public function createCategory(){
        return view('admin.create_category');
    }

    public function editCategory($id){
        $item = Item::findOrFail($id);
        return view('admin.edit_category')->with('item',$item);
    }

    public function inquiries(){
        return view('admin.inquiries');
    }

    public function inquiryReply($email){
        $validator = Validator::make(['email'=>$email],[
            'email' => ['required','email:dns,rfc'],          
        ],[
            'email' => 'Recipient email address must be a valid email address',
            'required'=>'A recipient address is required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $sentRecipient = $email;
        return view('admin.inquiry_reply')->with('sentRecipient',$sentRecipient);
    }

    public function sendEmail($email=null){ 
        $sentRecipients = [];   
        if(session()->has('isBulk')){
            session()->forget('isBulk');
        }    
        if($email==null){
            $subscribers = EmailSubscriber::select('email')->get();
            foreach ($subscribers as $key => $value) {
                $sentRecipients[] = $value->email;
            }
            session()->put('isBulk',true);
        }else{
            $sentRecipients = json_decode($email,true);           
        }       
        return view('admin.send_email')->with('sentRecipients',$sentRecipients);
    }

    public function subscribers(){
        return view('admin.subscribers');
    }

    public function administrators(){
        return view('admin.administrators');
    }

    public function newAdministrator(){
        return view('admin.new_administrator');
    }

    public function editAdministrator($id){
        $admin = Admin::findOrFail($id);
        return view('admin.edit_administrator')->with('admin',$admin);
    }

    public function profile(){
        return view('admin.edit_administrator')->with('admin',auth('admin')->user());
    }

    public function passwordChange(){
        return view('admin.change_password');
    }
}