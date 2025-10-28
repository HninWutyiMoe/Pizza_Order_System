<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class RouteController extends Controller
{
    // Products........................................................
    public function productList(){
        $products = Product::get();
        $user = User:: get();
        $data = [
              'product' => $products ,
              'user' => $user
        ];
        // $example = [
        //     'product' => [
        //         'example' => $products
        //     ],
        //     'user' => [
        //         'example' => $user
        //     ]
        // ];
        // return $data ['product'] [example] [1]->name;
        return $data ['product'] [0]->name;
        return response()->json($data,200);
    }

// Category..............................................................
    public function categoryList(){
        $category = Category::get();
        return response()->json($category,200);
    }

    // OrderList..............................................................
    public function orderList(){
        $orderlist = OrderList::get();
        return response()->json($orderlist,200);
    }

    // Contact..............................................................
    public function contactList(){
            $contact = Contact::get();
            return response()->json($contact,200);
        }

    // CreateCategory..................................................................
    public function createCategory(Request $request){
        // dd($request->all());
        // dd($request->name);
        // dd($request->header('headerData'));
        $data = [
            'name' => $request->name ,
            'created_at' => Carbon::now() ,
            'updated_at' => Carbon::now()
        ];
        $response = Category::create($data);
        return response()->json($response,200);
    }
    // deleteCategory...............................................................
    public function deleteCategory(Request $request){
        $data = Category::where('id',$request->category_id)->first();

        //return isset($data); //isset = exit or null
        //!empty($data)
        if( isset($data) ){

            Category::where('id',$request->category_id)->delete();
            return response()->json(['status' => 'true' , 'message' => "delete success"] , 200);
        }
        return response()->json(['status' => 'false' , 'message' => "There is no category for this id"] , 200);
    }

    // Detail...............................................................
    public function categoryDetail(Request $request){
        // return $request->all();
        $data = Category::where('id',$request->category_id)->first();

        if( isset($data) ){
            return response()->json(['status' => 'true' , 'category' => $data] , 200);
        }
        return response()->json(['status' => 'false' , 'message' => "There is no category for this id"] , 500);
    }
    // categoryUpdate
    public function categoryUpdate(Request $request){
        // return $request->all();
        $categoryId = $request->category_id;

        $dbSource = Category::where('id',$categoryId)->first();
        if(isset($dbSource)){
            $data = $this->getCategoryData($request);
            $response = Category::where('id',$categoryId)->update($data);
            return response()->json(['status' => 'true' ,'message' => 'category updated success','category' => $response] , 200);
        }
        return response()->json(['status' => 'false' , 'message' => "There is no category for this id"] , 500);
    }

    // getCategoryData..............................................................
    private function getCategoryData($request){
        return [
            'name' => $request->name ,
            'created_at' => Carbon::now() ,
            'updated_at' => Carbon::now()
        ];
    }

    // createContact...............................................................
    public function createContact(Request $request){
        $data = $this->getContactData($request);

        $response = Contact::create($data);
        return response()->json($response,200);
    }
    // deleteContact...........................................................
    public function deleteContact($id){
        $data = Contact::where('id',$id)->first();

        if( isset($data) ){

            Contact::where('id',$id)->delete();
            return response()->json(['status' => 'true' , 'message' => "delete success" , 'deleteData' => $data] , 200);
        }
        return response()->json(['status' => 'false' , 'message' => "There is no contact for this id"] , 200);
    }
    // contactDetail..................................................
    public function contactDetail($id){
        $data = Contact::where('id',$id)->first();

        if( isset($data) ){
            return response()->json(['status' => 'true' , 'contact' => $data] , 200);
        }
        return response()->json(['status' => 'false' , 'message' => "There is no contact for this id"] , 500);
    }

    // Get ContactData...............................................
    private function getContactData($request){
        return [
            'name' => $request->name ,
            'email' => $request->email ,
            'message' => $request->message ,
            'created_at' => Carbon::now() ,
            'updated_at' => Carbon::now()
        ];
    }
}
