<?php
function createMahasiswa($conn,$nama, $alamat, $tmpLahir, $tglLahir, $imageName){

    $sql="INSERT INTO profile(nama,alamat,tmpLahir,tglLahir,imageName) VALUES('$nama','$alamat', '$tmpLahir', '$tglLahir', '$imageName')";
    if(mysqli_query($conn,$sql)) {
        return true;
    }
    mysqli_close($conn);
    return false;
}

function getMahasiswa($conn){
    $sql="SELECT * FROM profile";
    $result=mysqli_query($conn, $sql);
    $mahasiswa=array();
    while($row = mysqli_fetch_array($result)){
        $mahasiswa_temp=array();
        $mahasiswa_temp['id']=$row['id'];
        $mahasiswa_temp['nama']=$row['nama'];
        $mahasiswa_temp['alamat']=$row['alamat'];
        $mahasiswa_temp['tmpLahir']=$row['tmpLahir'];
        $mahasiswa_temp['tglLahir']=$row['tglLahir'];
        $mahasiswa_temp['imageName']=$row['imagename'];
        array_push($mahasiswa,$mahasiswa_temp);
    }
    mysqli_close($conn);
    return $mahasiswa;
}

function updateMahasiswa($conn,$id,$nama, $alamat, $tmpLahir, $tglLahir, $imageName){
    $sql_image = "SELECT * FROM profile WHERE id=$id";
    $result=mysqli_query($conn, $sql_image);
    $row = mysqli_fetch_array($result);
    unlink("../image/{$row['imagename']}");
    $sql="UPDATE profile SET nama='$nama', alamat='$alamat', tmpLahir='$tmpLahir', tglLahir='$tglLahir', imageName='$imageName' WHERE id=$id";
    if(mysqli_query($conn,$sql)) {
        return true;
    }
    mysqli_close($conn);
    return false;
}

function deleteMahasiswa($conn,$id){
    $sql_image = "SELECT * FROM profile WHERE id=$id";
    $result=mysqli_query($conn, $sql_image);
    $row = mysqli_fetch_array($result);
    unlink("../image/{$row['imagename']}");
    $sql = "DELETE FROM profile WHERE id=$id";
    if(mysqli_query($conn, $sql)) {
        return true;
    }
    mysqli_close($conn);
    return false;
}