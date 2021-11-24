<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Repositories\PostRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Flash;
use Response;

class PostController extends Controller
{
    /** @var  PostRepository */
    private $postRepository;
    private $categoryRepository;

    public function __construct(PostRepository $postRepo, CategoryRepository $categoryRepo)
    {
        $this->postRepository = $postRepo;
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Post.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->role === 'author') {
            $posts = $this->postRepository->where('user_id', Auth::user()->id)->withTrashed()->get();
        } else {
            $posts = $this->postRepository->withTrashed()->get();
        }
         
        return view('posts.index')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new Post.
     *
     * @return Response
     */
    public function create()
    {   
        $categories = $this->categoryRepository->pluck('name', 'id');
        $users = User::pluck('name', 'id');
        return view('posts.create', [
            'categories'    => $categories,
            'users'         => $users
        ]);
    }

    /**
     * Store a newly created Post in storage.
     *
     * @param CreatePostRequest $request
     *
     * @return Response
     */
    public function store(CreatePostRequest $request)
    {
        $input = $request->all();

        $post = $this->postRepository->create($input);

        Flash::success('Post saved successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified Post.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified Post.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->postRepository->find($id);
        $categories = $this->categoryRepository->pluck('name', 'id');
        $users = User::pluck('name', 'id');

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        return view('posts.edit')
        ->with('post', $post)
        ->with('categories', $categories)
        ->with('users', $users);
    }

    /**
     * Update the specified Post in storage.
     *
     * @param int $id
     * @param UpdatePostRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostRequest $request)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        $post = $this->postRepository->update($request->all(), $id);

        Flash::success('Post updated successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified Post from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        //$this->postRepository->delete($id);
        if($post->delete()) {
            DB::table('posts')->where('id', $post->id)->update(['status' => 'Trash']);
        }

        Flash::success('Post deleted successfully.');

        return redirect(route('posts.index'));
    }
}
