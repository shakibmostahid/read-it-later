<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PacketRequest;
use App\Models\Pocket;
use Exception;

class PocketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pockets = Pocket::with('contents')->get();

        return view('pocket.index', ['pockets' => $pockets]);
    }

    /**
     * Store new pocket data
     *
     * @param PacketRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(PacketRequest $request)
    {
        try {
            $pocket = new Pocket();
            $pocket->createPocket($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Your packet has been created!'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->getMessage()
            ], 500);
        }
    }
}
