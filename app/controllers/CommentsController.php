<?php

class CommentsController extends BaseController {

    /**
     * Comments Repository
     *
     * @var Comments
     */
    protected $comments;

    public function __construct(Comments $comments)
    {
        $this->comments = $comments;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $comments = Comments::all();

        if (empty($comments))
        {
            return Response::json(array('error' => 'comments_not_found'), 404);
        }

        return Response::json($comments, 200);
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
        $validation = Validator::make($input, Comments::$rules);

        if ($validation->passes())
        {
            $comments = $this->comments->create($input);

            return Response::json($comments, 201);
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
        $comments = Comments::where('id', $id)->first();

        if (empty($comments))
        {
            return Response::json(array('error' => 'comments_not_found'), 404);
        }

        return Response::json($comments, 200);
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
        $validation = Validator::make($input, Comments::$rules);

        if ($validation->passes())
        {
            $comments = $this->comments->find($id);

            if (empty($comments))
            {
                return Response::json(array('error' => 'comments_not_found'), 404);
            }

            $comments->update($input);

            return Response::json($comments, 200);
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
        $comments = Comments::where('id', $id)->first();

        if (empty($comments))
        {
            return Response::json(array('error' => 'comments_not_found'), 404);
        }

        $comments->delete();

        return Response::json(array('success'), 200);
    }

}
