<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    protected  $image_path = 'public/images/';
    public function index()
    {
        if (Auth::user()->is_doctor()) {
            return view('doctor.blog.index', [
                'blogs' => Blog::query()->where('user_id', Auth::id())->orderBy('id')->get(),
            ]);
        } elseif (Auth::user()->is_hospital()) {
            $doctors = User::query()->where('user_type', 'H')->where('hospital_id', Auth::user()->hospital_id)->get();
            foreach ($doctors as $doctor) {
                $blogs = Blog::query()->where('user_id', $doctor->id)->with('user')->orderByDesc('id')->get();
                $doctor = $doctor;
            }
            return view('hospital.blog.index', compact('blogs', 'doctor'));
        } elseif (Auth::user()->is_admin()) {
            return view('admin.blog.index', [
                'blogs' => Blog::query()->orderByDesc('id')->get(),
            ]);
        } else {
            abort(401);
        }
    }

    public function create()
    {
        
        if (Auth::user()->is_admin()) {
            return view('admin.blog.create');
        } elseif (Auth::user()->is_doctor() || Auth::user()->is_hospital()) {
           
            return view('doctor.blog.create');
        } else {
            abort(401);
        }
    }
    // Store Blog
    public function store(Request $request)
    {
        if (Auth::user()->is_admin() || Auth::user()->is_doctor() || Auth::user()->is_hospital()) {

            $attributes = $request->validate([
                'blog_title' => 'required',
                // 'slug' => ['required', Rule::unique('blogs', 'slug')],
                // 'doctor_id' => 'required',
                'blog_body' => 'required',
                'blog_image' => 'image',
            ]);
            if ($attributes['blog_image'] ?? false) {
                if ($file = $request->file('blog_image')) {
                    $filename = time() . '-' . $file->getClientOriginalName();
                    // Storage::disk('local')->put($this->image_path . $filename, $file->getContent());
                    $file->move(public_path('images'), $filename);
                }
                $attributes['blog_image'] = $filename;
            }
            $title = $request->input('blog_title');
            $attributes['slug'] = Str::slug($title); // Generate initial slug
            $attributes['user_id'] = \Auth()->user()->id;

            // Check for existing slugs and append a number to make it unique
            $counter = 1;
            while (Blog::where('slug', $attributes['slug'])->exists()) {
                $attributes['slug'] = Str::slug($title) . '-' . $counter;
                $counter++;
            }
            Blog::create($attributes);

            return redirect()
                ->route('blogs')
                ->with('flash', ['type', 'success', 'message' => 'Blog Created Successfully']);
        } else {
            abort(401);
        }
    }
    public function edit(Blog $blog)
    {
        if (Auth::user()->is_doctor() && Auth::user()->id == $blog->user_id) {
            return view('doctor.blog.edit', [
                'blog' => $blog,
            ]);
        } elseif (Auth::user()->is_hospital() && Auth::user()->id == $blog->user_id) {
            return view('hospital.blog.edit', [
                'blog' => $blog,
            ]);
        } elseif (Auth::user()->is_admin()) {
            return view('admin.blog.edit', [
                'blog' => $blog,
            ]);
        } else {
            abort(401);
        }
    }
    public function update(Blog $blog)
    {
        if (Auth::user()->is_admin() || Auth::user()->is_hospital() || Auth::user()->is_doctor()) {

            if ($blog = $blog) {
                $attributes = request()->validate([
                    'blog_title' => 'required',
                    'blog_body' => 'required',
                    'blog_image' => 'image'
                ]);
                if ($attributes['blog_image'] ?? false) {
                    if ($file = request()->file('blog_image')) {
                        $filename = time() . '-' . $file->getClientOriginalName();
                        // Storage::disk('local')->put($this->image_path . $filename, $file->getContent());
                        $file->move(public_path('images'), $filename);
                    }
                    $attributes['blog_image'] = $filename;
                }
                $blog->update($attributes);
            }

            return redirect()
                ->route('blogs')
                ->with('flash', ['type', 'success', 'message' => 'Blog Update Successfully']);
        } else {
            abort(401);
        }
    }
    public function show(Blog $blog)
    {
        if (Auth::user()->is_doctor() && Auth::user()->id == $blog->user_id) {
            return view('doctor.blog.show', ['blog' => $blog]);
        } elseif (Auth::user()->is_hospital() && Auth::user()->id == $blog->user_id) {
            return view('hospital.blog.show', [
                'blog' => $blog,
                'doctor' => User::query()->where('id', $blog->user_id)->get(),
            ]);
        } elseif (Auth::user()->is_admin()) {
            return view('admin.blog.show', [
                'blog' => $blog,
                'doctor' => User::query()->where('id', $blog->user_id)->get(),
            ]);
        } else {
            abort(401);
        }
    }
    public function destroy(Blog $blog)
    {
        if(Auth::user()->is_admin() || Auth::user()->is_hospital() || Auth::user()->is_doctor()){

            $blog->delete();
            return redirect()
            ->route('blogs')
            ->with('flash', ['type', 'success', 'message' => 'Blog Deleted Successfully']);
        }else{
            abort(401);
        }
    }
}
