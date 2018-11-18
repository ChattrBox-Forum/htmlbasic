<?php

    /*!
     * ifsoft.co.uk engine v1.0
     *
     * http://ifsoft.com.ua, http://ifsoft.co.uk
     * raccoonsquare@gmail.com
     *
     * Copyright 2012-2019 Demyanchuk Dmitry (raccoonsquare@gmail.com)
     */

    $response = array("error" => true);

    if (!empty($_POST)) {

        $accountId = isset($_POST['accountId']) ? $_POST['accountId'] : '';
        $accessToken = isset($_POST['accessToken']) ? $_POST['accessToken'] : '';

        $auth = new auth($dbo);

        if (!$auth->authorize($accountId, $accessToken)) {

            api::printError(ERROR_ACCESS_TOKEN, "Error authorization.");
        }

        if (!empty($_FILES['uploaded_file']['tmp_name'])) {

            $imglib = new imglib($dbo);
            $response = $imglib->createPhoto($_FILES['uploaded_file']['tmp_name'], $_FILES['uploaded_file']['name']);
            unset($imglib);

            if ($response['error'] === false) {

                $account = new account($dbo, $accountId);
                $account->setPhoto($response);

                $post = new post($dbo);
                $post->setRequestFrom($accountId);
                $post->autoPost("", $response['normalPhotoUrl'], 1);
                unset($post);
            }
        }

        echo json_encode($response);
    }
