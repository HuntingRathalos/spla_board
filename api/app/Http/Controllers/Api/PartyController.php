<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PartyResource;
use Illuminate\Http\Request;
use App\Models\Party;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isEmpty;

class PartyController extends Controller
{
    // 自分の募集を返すAPi（indexと一緒、フロントで出し分ける）
    // 自分が参加している募集を返すApi（リレーションで確認して、データがあったらそれを返す）
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        \Log::debug(\DB::enableQueryLog());
        // \Log::debug($request->query("keyword"));
        \Log::debug($request->query("sort"));
        \Log::debug($request->query("keyword"));
        \Log::debug($request->path());
        // $parties = Party::all();
        $parties = Party::searchKeyword($request->keyword)->sortOrder($request->sort)->get();
        // $parties = Party::searchKeyword($request->keyword)->get();

        \Log::debug(\DB::getQueryLog());

        // \Log::debug(print_r($parties, true));

        if (!$parties->isEmpty()) {
            $parties = $parties->load('users');
            return PartyResource::collection($parties);
        }
        return response()->json("", Response::HTTP_OK);
    }

    public function getJoinParty()
    {
        $user = Auth::user();
        if (!isEmpty($user->parties)) {
            return PartyResource::collection($user->parties);
        }
        return response()->json("", Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $party =  Party::create([
            "owner_id" => Auth::id(),
            "genre_id" => $request->genre_id,
            "body" => $request->body,
            "start_at" => $request->start_at,
            "finished_at" => $request->finished_at,
        ]);

        return new PartyResource($party);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $party = Party::findOrFail($id);
        return new PartyResource($party);
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
        $party = Party::findOrFail($id);
        $party->fill($request->all())->save();
        $party = Party::findOrFail($id);

        return new PartyResource($party);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $party = Party::destroy($id);
        // return new PartyResource($party);
        return response()->json("", Response::HTTP_NO_CONTENT);
    }
}
