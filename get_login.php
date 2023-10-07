<?php
require_once 'lib/db.php';
require_once 'lib/jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header('Content-type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
	
	$sql = "SELECT
                *
            FROM
                tbl_user
            WHERE
                email = '$email' 
                AND password = SHA1('$password') 
            LIMIT 1";
	$result = dbQuery($sql);
	if(dbNumRows($result) < 1) {
		echo json_encode(array('pesannya' => 'Invalid user', 'status' => 'Error'));
	} else {
		$row = dbFetchAssoc($result);
		$email = $row['email'];
		$headers = array('alg'=>'HS256','typ'=>'JWT');
		$payload = array('email'=>$email, 'exp'=>(time() + 60));
		$jwt = generate_jwt($headers, $payload);
		echo json_encode(array('token' => $jwt,
            'id' => $row['id'],
            'nama' => $row['nama'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'alamat' => $row['alamat'],
            'email' => $row['email'],
            'tipe_user' => $row['tipe_user'],
        ));
	}
} else {
	echo json_encode(array('pesannya' => 'Invalid request', 'status' => 'Error'));
}

//End of file