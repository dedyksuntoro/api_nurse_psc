<?php
require_once 'lib/db.php';
require_once 'lib/jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header('Content-type: application/json');

$id_mata_pelajaran = isset($_POST['id_mata_pelajaran']) ? $_POST['id_mata_pelajaran'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($id_mata_pelajaran) {
        try {
            $sql = "
                    SELECT
                        tbl_soal.id AS id_soal,
                        tbl_soal.id_user_input AS id_user_input_soal,
                        tbl_soal.id_mata_pelajaran AS id_mata_pelajaran,
                        tbl_soal.soal AS soal,
                        tbl_soal.jawaban_a AS jawaban_a,
                        tbl_soal.jawaban_b AS jawaban_b,
                        tbl_soal.jawaban_c AS jawaban_c,
                        tbl_soal.jawaban_d AS jawaban_d,
                        tbl_soal.jawaban_e AS jawaban_e,
                        tbl_soal.jawaban_benar AS jawaban_benar,
                        tbl_soal.nilai_benar AS nilai_benar,
                        tbl_mata_pelajaran.mata_pelajaran AS mata_pelajaran 
                    FROM
                        tbl_soal 
                    LEFT JOIN tbl_mata_pelajaran ON tbl_soal.id_mata_pelajaran = tbl_mata_pelajaran.id
                    WHERE
                        tbl_soal.id_mata_pelajaran = $id_mata_pelajaran
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