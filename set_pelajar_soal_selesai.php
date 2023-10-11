<?php
require_once 'lib/db.php';
require_once 'lib/jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header('Content-type: application/json');

$id_soal = isset($_POST['id_soal']) ? $_POST['id_soal'] : '';
$id_user = isset($_POST['id_user']) ? $_POST['id_user'] : '';
$jawaban = isset($_POST['jawaban']) ? $_POST['jawaban'] : '';
$nilai = isset($_POST['nilai']) ? $_POST['nilai'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $sql = "INSERT INTO tbl_status_soal (    
            id_soal,
            id_user,
            jawaban,
            nilai
        )
        VALUES
            (
                $id_soal,
                $id_user,
                '$jawaban',
                $nilai
            )";
        $results = dbQuery($sql);
        if ($results) {
            echo json_encode(array('pesannya' => 'Soal Terselesaikan', 'status' => 'Success'));
        } else {
            echo json_encode(array('pesannya' => 'Terjadi kesalahan, ulangi beberapa saat lagi!', 'status' => 'Error'));
        }
    } catch (Exception $th) {
        echo json_encode(array('pesannya' => 'Some Error Occured', 'status' => 'Error'));
    }
} else {
    echo json_encode(array('pesannya' => 'Invalid request', 'status' => 'Error'));
}

//End of file