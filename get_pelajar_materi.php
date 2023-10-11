<?php
require_once 'lib/db.php';
require_once 'lib/jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header('Content-type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $sql = "
                SELECT
                    tbl_materi.id AS id_materi,
                    tbl_materi.id_user_input AS id_user_input_materi,
                    tbl_materi.id_mata_pelajaran AS id_mata_pelajaran,
                    tbl_materi.materi AS materi,
                    tbl_mata_pelajaran.mata_pelajaran AS mata_pelajaran 
                FROM
                    tbl_materi 
                LEFT JOIN tbl_mata_pelajaran ON tbl_materi.id_mata_pelajaran = tbl_mata_pelajaran.id
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