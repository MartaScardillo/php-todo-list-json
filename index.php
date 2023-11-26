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
                return $jsonDataDecode;
            }
            return [];
        }

    function saveDataJson($data)
        {
            global $json;
            $dataEncode = json_encode($data, JSON_PRETTY_PRINT);
            file_put_contents($json, $dataEncode);
        }

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        echo json_encode(getDataJson());
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $dataInput = file_get_contents('php://input');
        $data = json_decode($dataInput, true);
        saveDataJson($data);
    }
?>