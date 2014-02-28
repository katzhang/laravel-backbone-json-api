<?php
//use our new namespace
namespace V1;
 
//import classes that are not in this new namespace
use BaseController;
 
class PostsController extends BaseController {

    /**
     * Posts Repository
     *
     * @var Posts
     */
    protected $posts;

    public function __construct(Posts $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = Posts::all();

        if (empty($posts))
        {
            return Response::json(array('error' => 'posts_not_found'), 404);
        }

        return Response::json($posts, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return Response::json(array('error' => 'not_implemented'), 501);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Posts::$rules);

        if ($validation->passes())
        {
            $posts = $this->posts->create($input);

            return Response::json($posts, 201);
        }

        return Response::json($validation, 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $posts = Posts::where('id', $id)->first();

        if (empty($posts))
        {
            return Response::json(array('error' => 'posts_not_found'), 404);
        }

        return Response::json($posts, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return Response::json(array('error' => 'not_implemented'), 501);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, Posts::$rules);

        if ($validation->passes())
        {
            $posts = $this->posts->find($id);

            if (empty($posts))
            {
                return Response::json(array('error' => 'posts_not_found'), 404);
            }

            $posts->update($input);

            return Response::json($posts, 200);
        }

        return Response::json($validation, 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $posts = Posts::where('id', $id)->first();

        if (empty($posts))
        {
            return Response::json(array('error' => 'posts_not_found'), 404);
        }

        $posts->delete();

        return Response::json(array('success'), 200);
    }

}
