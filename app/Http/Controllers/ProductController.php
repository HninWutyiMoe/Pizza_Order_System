<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product list
    public function list(){
        // $pizzas = Product::orderBy('created_at','desc')->paginate(5);
        $pizzas = Product::select('products.*','categories.name as category_name')
                           ->when(request('key'), function ($query) {
                                $query->where('products.name', 'like', '%' . request('key') . '%');
                                })
                           ->leftJoin('categories','products.category_id','categories.id')
                           ->orderBy('products.created_at', 'desc')
                           ->paginate(4);
        // dd($pizzas->toArray());
        $pizzas->appends(request()->all());
        return view('admin.product.pizzaList', compact('pizzas'));
    }

    // createPage
    public function create(){
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create', compact('categories'));
    }
    // creating
    public function productCreate(Request $request){
        //  dd($request->all());
        $this->productValidate($request ,"create");
        $data = $this->requestProduct($request);

        if ($request->hasFile('pizzaImage')) {
            $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        Product::create($data);
        return redirect()->route('product#list')->with(['createSuccess'=>'Created Success...']);
    }

    // Delete
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess'=>'Product delete Success...']);
    }
    // View Detail
    public function detail($id){
       $pizza = Product::select('products.*','categories.name as category_name')
                        ->leftJoin('categories','products.category_id','categories.id')
                        ->where('products.id',$id)->first();
        return  view('admin.product.detail',compact('pizza'));
    }
    // Edit Pizza
    public function edit($id){
        $pizza = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.product.edit' , compact('pizza' , 'category'));
    }
    // Update Pizza
    public function update(Request $request){
        $this->productValidate($request, "update");
        $data = $this->requestProduct($request);

        if($request->hasFile('pizzaImage')) {
            $oldImgName = Product::where('id',$request->pizzaId)->first();
            $oldImgName = $oldImgName->image;
            // dd($oldImgName);

            if($oldImgName != null){
                Storage::delete('public/'.$oldImgName);
            }

            $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list')->with(['updateSuccess'=>'Update Success...']);
    }

    // Validation
    private function productValidate($request,$action)
    {
        $validationRules = [
            'pizzaName' => 'required|min:5|unique:products,name,'.$request->pizzaId,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:10',
            // 'pizzaImage' => 'required|mimes:png,jpg,webp,svg,gif,jpeg|file',
            'pizzaPrice' => 'required',
            'waitingTime'=>'required'
        ];

        $validationRules['pizzaImage'] = $action == "create" ? "required|mimes:png,jpg,webp,svg,gif,jpeg|file" : "mimes:png,jpg,webp,svg,gif,jpeg|file";
        // dd($validationRules);
        Validator::make($request->all(),$validationRules)->validate();
    }

    // Request data
    private function requestProduct($request)
    {
        return [

            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'description' => $request->pizzaDescription,
            //'image'=>$request->pizzaImage,
            'waiting_time' => $request->waitingTime,
            'price' => $request->pizzaPrice
        ];
    }
}
