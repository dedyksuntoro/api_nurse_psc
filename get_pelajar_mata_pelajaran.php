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
                    tbl_mata_pelajaran.id AS id,
                    tbl_mata_pelajaran.id_user_input AS id_user_input,
                    tbl_mata_pelajaran.mata_pelajaran AS mata_pelajaran,
                    tbl_status_materi.status_materi AS status_materi
                FROM
                    tbl_mata_pelajaran
                LEFT JOIN tbl_materi ON tbl_mata_pelajaran.id = tbl_materi.id_mata_pelajaran
                LEFT JOIN tbl_status_materi ON tbl_materi.id = tbl_status_materi.id_materi
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