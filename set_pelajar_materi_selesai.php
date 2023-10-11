<?php
require_once 'lib/db.php';
require_once 'lib/jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header('Content-type: application/json');

$id_materi = isset($_POST['id_materi']) ? $_POST['id_materi'] : '';
$id_user = isset($_POST['id_user']) ? $_POST['id_user'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($id_materi && $id_user){
        try {
            $sql = "INSERT INTO tbl_status_materi (    
                id_materi,
                id_user,
                status_materi
            )
            VALUES
                (
                    $id_materi,
                    $id_user,
                    'Selesai'
                )";
            $results = dbQuery($sql);
            if ($results) {
                echo json_encode(array('pesannya' => 'Materi Terselesaikan', 'status' => 'Success'));
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