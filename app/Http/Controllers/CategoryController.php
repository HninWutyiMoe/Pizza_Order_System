<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Category list page
    public function list(){
        // $categories = Category::orderBy('id','desc')->get();
        // $categories = Category::orderBy('id','desc')->paginate(5);

        $categories = Category::when(request('key'), function($query){
                                $query->where('name','like','%'.request('key').'%');
                                })
                                ->orderBy('id','desc')
                                ->paginate(5);

        $categories->appends(request()->all());
        // dd($categories);
        return view('admin.category.list',compact('categories'));
    }

    // Category create page
    public function createPage() {
        return view('admin.category.create');
    }
    // CreatingCategory
    public function create(Request $request) {
       $this->categoryValidation($request);
       $data = $this->requestCategoryData($request);
       Category::create($data);
       return redirect()->route('category#list')->with(['createSuccess'=>'Category created...']);
    }

    // delete category
    public function delete($id) {
        // dd($id);
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Delete Success']);
    }

    // edit Category
    public function edit($id) {
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }
    //Updating after Edit
    public function update(Request $request) {
    //    dd($id,$request->all());
       $this->categoryValidation($request);
    //    data ko array format change
       $data = $this->requestCategoryData($request);
       Category::where('id',$request->categoryId)->update($data);
       return redirect()->route('category#list');
    }

    // Validation check
    private function categoryValidation($request) {
        // $request = text in form ko Validate
        Validator::make($request->all(),[
            'categoryName' => 'required | unique:categories,name,'.$request->categoryId
        ])->validate();
    }

    // Request data | arrange in array
    private function requestCategoryData($request) {
        // name in db | form request name
        return [
            'name'=> $request->categoryName
        ];
    }
}

