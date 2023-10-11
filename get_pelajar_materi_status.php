<?php
require_once 'lib/db.php';
require_once 'lib/jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header('Content-type: application/json');

$id_materi = isset($_POST['id_materi']) ? $_POST['id_materi'] : '';
$id_user = isset($_POST['id_user']) ? $_POST['id_user'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($id_user && $id_materi) {
        try {
            $sql = "
                    SELECT
                        COUNT(*) AS status_materi 
                    FROM
                        tbl_status_materi 
                    WHERE id_materi = $id_materi AND id_user = $id_user
                ";
            $results = dbQuery($sql);
            $rows = array();
            while ($row = dbFetchAssoc($results)) {
                $rows = $row;
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