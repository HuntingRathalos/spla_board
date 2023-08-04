<?php

namespace App\Constants;

class Common
{
    public const ORDER_ASCENDINGS = "1";
    public const ORDER_DESCENDINGS = "2";

    public const SORT_ORDER = [
        "created_at_asc" => self::ORDER_ASCENDINGS,
        "created_at_desc" => self::ORDER_DESCENDINGS,
    ];

    public const OPEN_MATCH = "3";
    public const LEAGUE_MATCH = "4";

    public const BATTLR_GENRE = [
        "open_match" =>self::OPEN_MATCH,
        "league_match" =>self::LEAGUE_MATCH,
    ];
}
