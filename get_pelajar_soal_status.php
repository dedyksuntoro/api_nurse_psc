<?php
require_once 'lib/db.php';
require_once 'lib/jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header('Content-type: application/json');

$id_user = isset($_POST['id_user']) ? $_POST['id_user'] : '';
$id_mata_pelajaran = isset($_POST['id_mata_pelajaran']) ? $_POST['id_mata_pelajaran'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($id_user) {
        try {
            $sql = "
                    SELECT
                        COUNT(*) AS status_soal
                    FROM
                        `tbl_soal`
                        JOIN tbl_mata_pelajaran ON tbl_soal.id_mata_pelajaran = tbl_mata_pelajaran.id
                        JOIN tbl_status_soal ON tbl_soal.id = tbl_status_soal.id_soal 
                    WHERE id_user = $id_user AND id_mata_pelajaran = $id_mata_pelajaran
                    GROUP BY mata_pelajaran
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