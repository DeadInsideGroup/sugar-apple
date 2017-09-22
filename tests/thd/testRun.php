<?php

require __DIR__."/../../autoload.php";

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @see Handler\MainHandler
 */

$fake_webhook = '{
    "update_id": 44178399,
    "message": {
        "message_id": 22775,
        "from": {
            "id": 243692601,
            "is_bot": false,
            "first_name": "Ammar",
            "last_name": "F",
            "username": "ammarfaizi2",
            "language_code": "en-US"
        },
        "chat": {
            "id": -1001128531173,
            "title": "Dead Inside",
            "type": "supergroup"
        },
        "date": 1506090116,
        "text": "~sh echo test"
    }
}';

$app = new Bot($fake_webhook);
$app->run();