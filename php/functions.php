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

function tambah($data) {
    global $conn;

    $activitas = htmlspecialchars($data);

    // query insert data
    $query = " INSERT INTO activity
                VALUES
            ('', 'user123', '$activitas','n') 
    ";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
} 

function hapus($id) {
    global $conn;

    mysqli_query($conn, "DELETE FROM activity WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function checkActv($id) {
    $doneActvity = query(" SELECT * FROM activity WHERE has_actv_finished = 'y' ");
    foreach( $doneActvity as $doneActv) {
        if( $doneActv["id"] == $id ) {
            return 'class="done"';
        }
    }
}

function checkDisableLink($id){
    $doneActvity = query(" SELECT * FROM activity WHERE has_actv_finished = 'y' ");
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

function edit($new_actv){
    global $conn;

    $newActv = htmlspecialchars($new_actv);


    // query update
    $query = " UPDATE activity SET 
                activity_name='$newActv'
            WHERE id='69';
    ";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);

}












?>

