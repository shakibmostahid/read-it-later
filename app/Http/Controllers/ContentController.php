<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContentRequest;
use App\Models\Content;
use App\Models\Pocket;
use App\Http\Resources\ContentResource;
use Exception;

class ContentController extends Controller
{
    /**
     * Returns all collection for a given valid pocket
     *
     * @return ContentResource 
     */
    public function index(Pocket $pocket)
    {
        return ContentResource::collection($pocket->contents);
    }

    /**
     * Store a new content for a given pocket
     *
     * @param \Illuminate\Http\Request $request
     * @param Pocket $pocket
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(ContentRequest $request, Pocket $pocket)
    {
        try {
            $content = new Content();
            $content->createPocketContent($request->all(), $pocket->id);

            return response()->json([
                'success' => true,
                'message' => 'Your content has been saved!'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Content $content)
    {
        try {
            $content->delete();

            return response()->json([
                'success' => true,
                'message' => 'The content has been deleted successfully!'
            ], 204);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->getMessage()
            ], 500);
        }
    }
}
