<?php
require_once 'lib/db.php';
require_once 'lib/jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header('Content-type: application/json');

$id_user_input = isset($_POST['id_user_input']) ? $_POST['id_user_input'] : '';
$id_mata_pelajaran = isset($_POST['id_mata_pelajaran']) ? $_POST['id_mata_pelajaran'] : '';
$materi = isset($_POST['materi']) ? $_POST['materi'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($id_user_input && $id_mata_pelajaran && $materi){
        try {
            $sql = "INSERT INTO tbl_materi (    
                id_user_input,
                id_mata_pelajaran,
                materi
            )
            VALUES
                (
                    $id_user_input,
                    $id_mata_pelajaran,
                    '$materi'
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
        echo json_encode(array('pesannya' => 'Invalid parameter', 'status' => 'Error'));
    }
} else {
    echo json_encode(array('pesannya' => 'Invalid request', 'status' => 'Error'));
}

//End of file