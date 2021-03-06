<?php

/*!
 * ifsoft.co.uk engine v1.0
 *
 * http://ifsoft.com.ua, http://ifsoft.co.uk
 * qascript@ifsoft.co.uk
 *
 * Copyright 2012-2015 Demyanchuk Dmitry (https://vk.com/dmitry.demyanchuk)
 */

if (!empty($_POST)) {

    $accountId = isset($_POST['accountId']) ? $_POST['accountId'] : 0;
    $accessToken = isset($_POST['accessToken']) ? $_POST['accessToken'] : '';

    $commentId = isset($_POST['commentId']) ? $_POST['commentId'] : 0;

    $accountId = helper::clearInt($accountId);

    $commentId = helper::clearInt($commentId);

    $result = array("error" => true,
                    "error_code" => ERROR_UNKNOWN);

    $auth = new auth($dbo);

    if (!$auth->authorize($accountId, $accessToken)) {

        api::printError(ERROR_ACCESS_TOKEN, "Error authorization.");
    }

    $video = new video($dbo);
    $video->setRequestFrom($accountId);

    $commentInfo = $video->commentInfo($commentId);

    if ($commentInfo['fromUserId'] == $accountId) {

        $video->commentRemove($commentId);

    } else {

        $itemInfo = $video->info($commentInfo['videoId']);

        if ($itemInfo['fromUserId'] == $accountId) {

            $video->commentRemove($commentId);
        }
    }

    unset($video);

    echo json_encode($result);
    exit;
}
