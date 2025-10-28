<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //User Home
    public function home()
    {
        $pizza = Product::orderBy('created_at', 'desc')->get();

        $category = Category::get();

        $cart = Cart::where('user_id', Auth::user()->id)->get();         // cart btn -> list

        $order = Order::where('user_id', Auth::user()->id)->get();        // history btn->list

        return view('user.main.home', compact('pizza', 'category', 'cart', 'order'));
    }

    // filter pizza
    public function filter($categoryId)
    {
        //  dd($categoryId);
        $pizza = Product::where('category_id', $categoryId)->orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();         // cart btn -> list
        $order = Order::where('user_id', Auth::user()->id)->get();        // history btn->list
        return view('user.main.home', compact('pizza', 'category', 'cart', 'order'));
    }

    // Pizza Details
    public function pizzaDetails($pizzaId)
    {
        $pizza = Product::where('id', $pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details', compact('pizza', 'pizzaList'));
    }

    // user#history
    public function history()
    {
        $order = Order::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate('5');
        return view('user.main.history', compact('order'));
    }

    // UserList
    public function userList()
    {
        $users = User::when(request('key'), function ($query) {
            $query->orwhere('users.name', 'like', '%' . request('key') . '%')
                ->orWhere('users.email', 'like', '%' . request('key') . '%');
        })
            ->where('role', 'user')
            ->paginate(5);
        return view('admin.user.list', compact('users'));
    }

    // userChangeRole
    public function userChangeRole(Request $request)
    {
        // logger($request->all());
        $updateSource = ['role' => $request->role]; //array[ ] format

        User::where('id', $request->userId)->update($updateSource);
    }
    // User delete...................................................................
    public function accDelete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'You deleted this user account...']);
    }
    // ViewAccount
    public function view($id)
    {
        $account = User::where('id', $id)->first();
        return view('admin.user.viewAcc', compact('account'));
    }

    // UserMail
    public function mailList()
    {
        $mails = Contact::orderBy('created_at', 'desc')->get();
        return view('admin.user.mail', compact('mails'));
    }

    // cartList
    public function cartList()
    {
        $cartList = Cart::select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price', 'products.image as product_image')
            ->leftJoin('products', 'products.id', 'carts.product_id')
            ->where('user_id', Auth::user()->id)
            ->get();

        $totalPrice = 0;
        foreach ($cartList as $cart) {
            $totalPrice += $cart->pizza_price * $cart->qty;
        }
        return view('user.main.cart', compact('cartList', 'totalPrice'));
    }

    // changePassword
    public function changePassword()
    {
        return view('user.account.pwChange');
    }

    // Changing Password
    public function change(Request $request)
    {

        $this->passwordValidation($request);

        $currentUserId = Auth::user()->id;

        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password; //hash vale

        if (Hash::check($request->oldPassword, $dbHashValue)) {
            $data =  ['password' => Hash::make($request->newPassword)];

            User::where('id', Auth::user()->id)->update($data);

            return redirect()->route('category#list')->with(['changeSuccess' => 'Password Changed Success...']);
        }
        return back()->with(['notMatch' => 'The Old Password not Match.Try Again!']);
    }

    // Change Profile
    public function changeProfile()
    {
        return view('user.account.accountDetail');
    }
    // Update Profie
    public function update($id, Request $request)
    {
        $this->accountValidation($request);
        $data = $this->getUserData($request);

        //  for image

        if ($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;
            // dd($dbImage);

            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            // dd($fileName);
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        User::where('id', $id)->update($data);
        // return redirect()->route('user#home')->with(['updateSuccess' => 'Admin account updated...']);
        return back()->with(['updateSuccess' => 'Admin account updated...']);
    }

    // Password Validation
    private function passwordValidation($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword'
        ])->validate();
    }

    // accountValidation
    private function accountValidation($request)
    {
        Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'image' => 'image|mimes:png,jpg,jpeg,svg,gif,webp|file|max:2048',
                'gender' => 'required',
                'address' => 'required'
            ]
        )->validate();
    }
    // request user data
    private function getUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }
}
