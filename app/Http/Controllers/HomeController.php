<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class HomeController extends Controller{
public function index(){
    // /*هيك يطلعوا تحت بعض الحروف مفروض*/
    // $array=['احمد التلمس','120221574','تصميم وبرمجة تطبيقات الموبايل'];
    // to return json array and see it on browser
   
    // //this here is another way so other people can use it 
    // return response()->json(['data'=>$array]);
    // $array=['A','B','C','D','E','F'];
    // return view('index');
// $posts = Post::all(); 

//$posts = Post::where('id','!=',2)->get(); or (where,all,find or get)

//(with) is to return relation
$posts = Post::with('user')->orderBy('id','ASC')->paginate(10);
// $posts = Post::with('user')->where('created_at','>','2025-05-15')->paginate(10);
//this is search with id
    return response()->json($posts);
}
public function create(){
dd('create');
}
public function store(Request $request){
//   $path=route('url', $url);

// $post->photo=$path;
dd($request->get('title'));


// $request->validate([
// 'title'=>'required|max:5',
// 'description'=>'required',
// 'photo' => 'required|image|mimed:jpeg,png,jpg|max:2048',
// ]);


// //add image

// $post = new Post();

// //  $post->photo=$imageName;

 

   $image=$request->file('photo');
  $imageName = time().'.'.$image->getClientOriginalExtension();
  $url = $image->storeAs('images',$imageName,'public');
  $path = Storage::url($url);

  $post->photo=$imageName;
 $post->title=$request->title;
   $post->description=$request->description;
 $post->user_id=$request->user_id;
//  $post->photo=$path;

//  //this is add post
  $post->save();
 return response()->json($post);
}
public function show(string $id){
 $post = Post::find($id);
     return response()->json($post);
}
public function edit(string $id){
}
public function update(Request $request, string $id)
{
    $post = Post::find($id);

    // تحقق إذا كان المنشور موجود
    if (!$post) {
        return response()->json(['message' => 'Post not found'], 404);
    }

    // تحقق من صحة البيانات
    $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'photo' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // إذا تم رفع صورة جديدة
    if ($request->hasFile('photo')) {
        $image = $request->file('photo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $url = $image->storeAs('images', $imageName, 'public');
        $path = Storage::url($url);
        $post->photo = $path;
    }

    // تحديث باقي البيانات
    $post->title = $request->title;
    $post->description = $request->description;
    $post->save();

    return response()->json($post);
}
public function destroy(string $id){
    $post=Post::find($id);
    if($post){
        $post->delete();
    }
}

public function userPosts($id){
//find posts with user id = 1 
$user=User::with('posts')->find($id);
return response()->json($user);
}
}