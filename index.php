<?php

    header("Access-Control-Allow-Origin: http://localhost");
    header("Access-Control-Allow-Headers: X-Requested-With");

    $json = "todo.json";
    function getDataJson()
        {
            global $json;
            if (file_exists($json)) {
                $jsonData = file_get_contents($json);
                $jsonDataDecode = json_decode($jsonData, true);
                if ($jsonDataDecode === null) {
                    return 0;
                }
                return $jsonDataDecode;
            }
            return 0;
        }

    function saveDataJson($data)
        {
            global $json;
            $dataEncode = json_encode($data, JSON_PRETTY_PRINT);
            file_put_contents($json, $dataEncode);
        }

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $jsonData = getDataJson();
        if ($jsonData) {
            echo json_encode($jsonData);
        } else {
            echo json_encode([]);
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $dataInput = file_get_contents('php://input');
        $data = json_decode($dataInput, true);
        if ($data !== null) {
            saveDataJson($data);
        } else {
            error_log('Error');
        }
    }
?>