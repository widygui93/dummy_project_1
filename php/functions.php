<?php 
date_default_timezone_set("Asia/Jakarta");

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "dummy_project_1");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    
    while ( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function tentukan_waktu() {

    $jamFormat24 = date("H");

    if($jamFormat24 >= 0 && $jamFormat24 <= 11) {
        return "Morning";
    } elseif ( $jamFormat24 >= 12 && $jamFormat24 <= 18 ) {
        return "Afternoon";
    } else {
        return "Night";
    }
}

function tambah($data_actv, $data_usr) {
    global $conn;

    $activitas = htmlspecialchars($data_actv);
    $user = htmlspecialchars($data_usr);

    // query insert data
    $query = " INSERT INTO activity
                VALUES
            ('', '$user', '$activitas','n') 
    ";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
} 

function hapus($id) {
    global $conn;

    mysqli_query($conn, "DELETE FROM activity WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function checkActv($id, $user_name) {
    $doneActvity = query(" SELECT * FROM activity WHERE has_actv_finished = 'y' AND user_name = '$user_name' ");
    foreach( $doneActvity as $doneActv) {
        if( $doneActv["id"] == $id ) {
            return 'class="done"';
        }
    }
}

function checkDisableLink($id, $user_name){
    $doneActvity = query(" SELECT * FROM activity WHERE has_actv_finished = 'y' AND user_name = '$user_name ");
    foreach( $doneActvity as $doneActv) {
        if( $doneActv["id"] == $id ) {
            return 'disableLink';
        }
    }
}

function markActv($id){
    global $conn;

    mysqli_query($conn, "UPDATE activity SET has_actv_finished = 'y' WHERE id = $id" );
}

function edit($new_actv, $id_actv){
    global $conn;

    $newActv = htmlspecialchars($new_actv);


    // query update
    $query = " UPDATE activity SET 
                activity_name='$newActv'
            WHERE id='$id_actv';
    ";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);

}

function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username' ");

    if( mysqli_fetch_assoc($result) ){
        echo "
            <script>
                alert('username sudah terdaftar');
            </script>
        ";

        return false;
    }


    // cek konfirmasi password
    if ( $password !== $password2 ) {
        echo "
            <script>
                alert('konfirmasi password tidak sesuai');
            </script>
        ";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);
    
}










?>

