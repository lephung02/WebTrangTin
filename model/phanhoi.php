<?php
class PHANHOI
{
    private $MaPH;
    private $MaND;
    private $MaLPH;
    
    public function getMaPH()
    {
        return $this->MaPH;
    }
    public function setMaPH($value)
    {
        $this->MaPH = $value;
    }
    public function getMaND()
    {
        return $this->MaND;
    }
    public function setMaND($value)
    {
        $this->MaND = $value;
    }
    public function getMaLPH()
    {
        return $this->MaLPH;
    }
    public function setMaLPH($value)
    {
        $this->MaLPH = $value;
    }
    // khai báo các thuộc tính (SV tự viết)


    // lấy thông tin người dùng có $email
    // public function laythongtinbaiviet($email)
    // {
    //     $db = DATABASE::connect();
    //     try {
    //         $sql = "SELECT * FROM baiviet WHERE Email=:Email";
    //         $cmd = $db->prepare($sql);
    //         $cmd->bindValue(":Email", $Email);
    //         $cmd->execute();
    //         $ketqua = $cmd->fetch();
    //         $cmd->closeCursor();
    //         return $ketqua;
    //     } catch (PDOException $e) {
    //         $error_message = $e->getMessage();
    //         echo "<p>Lỗi truy vấn: $error_message</p>";
    //         exit();
    //     }
    // }

    // lấy tất cả ng dùng
    public function laydanhsachphanhoi()
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM phanhoi";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $ketqua = $cmd->fetchAll();
            return $ketqua;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Thêm ng dùng mới, trả về khóa của dòng mới thêm
    // (SV nên truyền tham số là 1 đối tượng kiểu người dùng, không nên truyền nhiều tham số rời rạc như thế này)
    public function themphanhoi($phanhoi)
    {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO phanhoi(MaND, MaLPH) 
VALUES(:MaND, :MaLPH)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':MaND', $phanhoi->MaND);
            $cmd->bindValue(':MaLPH', $phanhoi->MaLPH);
            $cmd->execute();
            $MaPH = $db->lastInsertMaPH();
            return $MaPH;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Cập nhật thông tin ng dùng: họ tên, số đt, email, ảnh đại diện 
    // (SV nên truyền tham số là 1 đối tượng kiểu người dùng, không nên truyền nhiều tham số rời rạc như thế này)
    public function capnhatphanhoi($MaPH,$MaND, $MaLPH)
    {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE phanhoi set MaND=:MaND, MaLPH=:MaLPH  where MaPH=MaPH";
            $cmd = $db->prepare($sql);
            $cmd->bindValue('MaPH', $MaPH);
            $cmd->bindValue(':MaND', $MaND);
            $cmd->bindValue(':MaLPH', $MaLPH);
            $ketqua = $cmd->execute();
            return $ketqua;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Đổi quyền (loại người dùng: 1 quản trị, 2 nhân viên. Không cần nâng cấp quyền đối với loại người dùng 3 khách hàng)
    // public function doiloaibaiviet($Email, $QuyenND)
    // {
    //     $db = DATABASE::connect();
    //     try {
    //         $sql = "UPDATE baiviet set QuyenND=:QuyenND where Email=:Email";
    //         $cmd = $db->prepare($sql);
    //         $cmd->bindValue(':Email', $Email);
    //         $cmd->bindValue(':QuyenND', $QuyenND);
    //         $ketqua = $cmd->execute();
    //         return $ketqua;
    //     } catch (PDOException $e) {
    //         $error_message = $e->getMessage();
    //         echo "<p>Lỗi truy vấn: $error_message</p>";
    //         exit();
    //     }
    // }
    // // Đổi trạng thái (0 khóa, 1 kích hoạt)
    // public function doiMaLPH($MaND, $MaLPH)
    // {
    //     $db = DATABASE::connect();
    //     try {
    //         $sql = "UPDATE baiviet set MaLPH=:MaLPH where MaND=:MaND";
    //         $cmd = $db->prepare($sql);
    //         $cmd->bindValue(':MaND', $MaND);
    //         $cmd->bindValue(':MaLPH', $MaLPH);
    //         $ketqua = $cmd->execute();
    //         return $ketqua;
    //     } catch (PDOException $e) {
    //         $error_message = $e->getMessage();
    //         echo "<p>Lỗi truy vấn: $error_message</p>";
    //         exit();
    //     }
    // }
}
