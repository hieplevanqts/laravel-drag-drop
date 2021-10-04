<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $data['list'] = Category::withDepth()->defaultOrder()->having('depth', '>', 0)->get()->toFlatTree();
        return view('index', $data);
    }

    public function updateTree(Request $request)
    {
        $data = $request->data;
        $root = Category::find(1);
        Category::rebuildSubtree($root, $data);
        return response()->json($data);
    }
}
