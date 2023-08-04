<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// use App\Constants\Common;

class Party extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'owner_id',
        'genre_id',
        'body',
        'start_at',
        'finished_at',
    ];

    /**
     * リレーション - partiesテーブル
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    /**
     * リレーション - usersテーブル
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * リレーション - party_userテーブル(usersテーブルとpartiesテーブルの中間テーブル).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeSortOrder($query, $sortOrder)
    {
        // とりあえずcreated_atの昇順、降順でソート
        \Log::debug($sortOrder);
        if ($sortOrder === null || $sortOrder === \Constant::SORT_ORDER["created_at_asc"]) {
            return $query->orderBy("created_at", "asc");
        }

        if ($sortOrder === \Constant::SORT_ORDER["created_at_desc"]) {
            \Log::debug($sortOrder);

            return $query->orderBy("created_at", "desc");
        }
    }

    public function scopeSelectCategory($query, $genreId = "0")
    {
        // if (!$genreId !== "0") {
        //     return $query->where("genre_id", $genreId);
        // }

        switch($genreId) {
            case "0":
                return $query;
                break;
            case "1":
                return $query->where("genre_id", \Constant::BATTLR_GENRE["open_match"]);
                break;
            case "2":
                return $query->where("genre_id", \Constant::BATTLR_GENRE["league_match"]);
                break;
        }

        // return $query;
    }

    public function scopeSearchKeyword($query, $keyword = null)
    {
        if (!empty($keyword)) {
            $spaceConvert = mb_convert_kana($keyword, "s");

            $keywords = preg_split('/[\s]+/', $spaceConvert, -1, PREG_SPLIT_NO_EMPTY) ;

            foreach ($keywords as $word) {
                if (Party::where("body", "like", "%". $word ."%")->exists()) {
                    $query->where("body", "like", "%". $word ."%");
                }
            }
            return $query;
        }
        return $query;
    }
}
