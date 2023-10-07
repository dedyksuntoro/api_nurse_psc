<?php
require_once 'lib/db.php';
require_once 'lib/jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header('Content-type: application/json');

$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$jenis_kelamin = isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : '';
$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$tipe_user = isset($_POST['tipe_user']) ? $_POST['tipe_user'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($nama && $jenis_kelamin && $alamat && $email && $tipe_user){
        try {
            $sql = "INSERT INTO tbl_user (    
                nama,
                jenis_kelamin,
                alamat,
                email,
                tipe_user,
                password
            )
            VALUES
                (
                    '$nama',
                    '$jenis_kelamin',
                    '$alamat',
                    '$email',
                    '$tipe_user',
                    SHA1('$password')
                )";
            $results = dbQuery($sql);
            if ($results) {
                echo json_encode(array('pesannya' => 'Pendaftaran Berhasil', 'status' => 'Success'));
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