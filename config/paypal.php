<?php
/**
 * Project Kyrie - An Arkan App service oriented to the health area.
 * Created by:
 *  > Mauricio Cruz Portilla <mauricio.portilla@hotmail.com>
 * 
 * This project was created in the hope that it will be useful for any
 * professionist from this area.
 * 
 * July 21st, 2020
 */

return [
    "sandbox_active" => (bool) env("PP_SANDBOX_ACTIVE", false),
    "sandbox_client_id" => env("PP_SANDBOX_CLIENT_ID", ""),
    "sandbox_secret" => env("PP_SANDBOX_SECRET", ""),
    "live_client_id" => env("PP_LIVE_CLIENT_ID", ""),
    "live_secret" => env("PP_LIVE_SECRET", "")
];
