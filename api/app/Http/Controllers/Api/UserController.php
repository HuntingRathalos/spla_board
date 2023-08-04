<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Party;
use App\Http\Resources\PartyResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\JoinedPartyNotification;

class UserController extends Controller
{
    /**
     * ユーザーが参加する
     *
     * @param int $partyId
     * @return void
     */
    public function join(Request $request)
    {
        // partyを取得
        $party = Party::findOrFail($request->partyId);

        // 中間テーブル更新
        $party->users()->detach(Auth::id());
        $party->users()->attach(Auth::id());

        // フレコ登録
        $user =Auth::user();
        $user->update([
            "friend_code" => $request->friend_code
        ]);
        $partyOwner = $party->owner;

        // オーナーに通知（未実装）
        $partyOwner->notify(new JoinedPartyNotification($request->friend_code));
        // userはフロントでApiを叩くようにするのでここでは返さない
        // return UserResource($party);
    }
}
