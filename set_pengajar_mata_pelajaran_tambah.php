<?php
require_once 'lib/db.php';
require_once 'lib/jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header('Content-type: application/json');

$id_user_input = isset($_POST['id_user_input']) ? $_POST['id_user_input'] : '';
$mata_pelajaran = isset($_POST['mata_pelajaran']) ? $_POST['mata_pelajaran'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($mata_pelajaran && $id_user_input){
        try {
            $sql = "INSERT INTO tbl_mata_pelajaran (    
                id_user_input,
                mata_pelajaran
            )
            VALUES
                (
                    $id_user_input,
                    '$mata_pelajaran'
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