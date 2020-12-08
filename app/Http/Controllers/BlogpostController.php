<?php

namespace App\Http\Controllers;

use App\Models\Blogpost;
use Illuminate\Http\Request;

class BlogpostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Blogpost::orderByDesc("updated_at")->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "author_id" => ["integer", "nullable"], // TODO set auto to Auth::id
            "title" => ["required", "string"],
            "content" => ["required", "string"],
        ]);

        if (
            Blogpost::create([
                "author_id" => $request->author_id,
                "title" => $request->title,
                "content" => $request->content,
            ])
        ) {
            return response()->json(
                [
                    "success" => "Nouveau post de blog créé avec succès",
                ],
                200
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blogpost  $blogpost
     * @return \Illuminate\Http\Response
     */
    public function show(Blogpost $blogpost)
    {
        return $blogpost;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blogpost  $blogpost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blogpost $blogpost)
    {
        $request->validate([
            "author_id" => ["integer", "nullable"], // TODO set auto to Auth::id
            "title" => ["required", "string"],
            "content" => ["required", "string"],
        ]);

        if (
            $blogpost->update([
                "author_id" => $request->author_id,
                "title" => $request->title,
                "content" => $request->content,
            ])
        ) {
            return response()->json(
                [
                    "success" => "Post de blog modifié avec succès",
                ],
                200
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blogpost  $blogpost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blogpost $blogpost)
    {
        $blogpost->delete();
        return response()->json(
            [
                "success" => "Post de blog supprimé avec succès",
            ],
            200
        );
        // return redirect()->route(ROUTE.TO.BLOGPOSTS.INDEX)->with('success', "XXX has been deleted");    // TODO
    }
}
