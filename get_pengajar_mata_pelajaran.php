<?php
require_once 'lib/db.php';
require_once 'lib/jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header('Content-type: application/json');

$iduser = isset($_POST['iduser']) ? $_POST['iduser'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($iduser) {
        try {
            $sql = "
                    SELECT
                        * 
                    FROM
                        tbl_mata_pelajaran 
                    WHERE
                        id_user_input = $iduser
                ";
            $results = dbQuery($sql);
            $rows = array();
            while ($row = dbFetchAssoc($results)) {
                $rows[] = $row;
            }
            echo json_encode($rows);
        } catch (Exception $e) {
            echo json_encode(array('pesannya' => 'Some Error Occured', 'status' => 'Error'));
        }
    } else {
        echo json_encode(array('pesannya' => 'Invalid parameter', 'status' => 'Error'));
    }
} else {
    echo json_encode(array('pesannya' => 'Invalid request', 'status' => 'Error'));
}

//End of file