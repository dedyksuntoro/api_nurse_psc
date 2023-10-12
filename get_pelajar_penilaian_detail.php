<?php
require_once 'lib/db.php';
require_once 'lib/jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header('Content-type: application/json');

$iduser = isset($_POST['id_user']) ? $_POST['id_user'] : '';
$idMataPelajaran = isset($_POST['id_mata_pelajaran']) ? $_POST['id_mata_pelajaran'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $sql = "
                SELECT
                    id_user,
                    id_mata_pelajaran,
                    soal,
                    jawaban,
                    nilai 
                FROM
                    tbl_status_soal
                    JOIN tbl_soal ON tbl_status_soal.id_soal = tbl_soal.id
                    JOIN tbl_mata_pelajaran ON tbl_soal.id_mata_pelajaran = tbl_mata_pelajaran.id
                WHERE
                    id_user = $iduser AND id_mata_pelajaran = $idMataPelajaran
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
    echo json_encode(array('pesannya' => 'Invalid request', 'status' => 'Error'));
}

//End of file