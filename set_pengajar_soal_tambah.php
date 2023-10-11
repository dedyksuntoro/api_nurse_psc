<?php
require_once 'lib/db.php';
require_once 'lib/jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header('Content-type: application/json');

$id_user_input = isset($_POST['id_user_input']) ? $_POST['id_user_input'] : '';
$id_mata_pelajaran = isset($_POST['id_mata_pelajaran']) ? $_POST['id_mata_pelajaran'] : '';
$soal = isset($_POST['soal']) ? $_POST['soal'] : '';
$jawaban_a = isset($_POST['jawaban_a']) ? $_POST['jawaban_a'] : '';
$jawaban_b = isset($_POST['jawaban_b']) ? $_POST['jawaban_b'] : '';
$jawaban_c = isset($_POST['jawaban_c']) ? $_POST['jawaban_c'] : '';
$jawaban_d = isset($_POST['jawaban_d']) ? $_POST['jawaban_d'] : '';
$jawaban_e = isset($_POST['jawaban_e']) ? $_POST['jawaban_e'] : '';
$jawaban_benar = isset($_POST['jawaban_benar']) ? $_POST['jawaban_benar'] : '';
$nilai_benar = isset($_POST['nilai_benar']) ? $_POST['nilai_benar'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $sql = "INSERT INTO tbl_soal (
            id_user_input,
            id_mata_pelajaran,
            soal,
            jawaban_a,
            jawaban_b,
            jawaban_c,
            jawaban_d,
            jawaban_e,
            jawaban_benar,
            nilai_benar
        )
        VALUES
            (
                $id_user_input,
                $id_mata_pelajaran,
                '$soal',
                '$jawaban_a',
                '$jawaban_b',
                '$jawaban_c',
                '$jawaban_d',
                '$jawaban_e',
                '$jawaban_benar',
                $nilai_benar
            )";
        $results = dbQuery($sql);
        if ($results) {
            echo json_encode(array('pesannya' => 'Penambahan Data Berhasil', 'status' => 'Success'));
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