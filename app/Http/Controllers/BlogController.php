<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {

        $query = Blog::with('user');
        if (request()->search) {
            $searchTerm = '%' . request('search') . '%';
            $query->where('blog_title_en', 'like', $searchTerm)
            ->orWhere('blog_title_ar', 'like', $searchTerm);
        }
        $blogs = $query->latest()->paginate(5);
        $latestBlogs = Blog::with('user')->inRandomOrder()->latest()->take(10)->get();


        return view('patient.blog.index', compact('blogs', 'latestBlogs'));
    }
    public function blogBySlug($slug)
    {
        $blog = Blog::with('user')->where('slug', $slug)->first();
        $latestBlogs = Blog::with('user')->inRandomOrder()->latest()->take(10)->get();
        return view('patient.blog.show', compact('blog', 'latestBlogs'));
    }
}
