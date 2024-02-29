<?php
class LICHSUDOC
{
    private $MaLS;
    private $MaND;
    private $MaBV;
    private $ThoiGianDoc;

    
    public function getMaLS()
    {
        return $this->MaLS;
    }
    public function setMaLS($value)
    {
        $this->MaLS = $value;
    }
    public function getMaND()
    {
        return $this->MaND;
    }
    public function setMaND($value)
    {
        $this->MaND = $value;
    }
    public function getMaBV()
    {
        return $this->MaBV;
    }
    public function setMaBV($value)
    {
        $this->MaBV = $value;
    }
    public function getThoiGianDoc()
    {
        return $this->ThoiGianDoc;
    }
    public function setThoiGianDoc($value)
    {
        $this->ThoiGianDoc = $value;
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
    public function laydanhsachlichsudoc()
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM lichsudoc";
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
    public function themlichsudoc($lichsudoc)
    {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO lichsudoc(MaND, MaBV, ThoiGianDoc) 
VALUES(:MaND, :MaBV, :ThoiGianDoc)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':MaND', $lichsudoc->MaND);
            $cmd->bindValue(':MaBV', $lichsudoc->MaBV);
            $cmd->bindValue(':ThoiGianDoc', $lichsudoc->ThoiGianDoc);
            $cmd->execute();
            $MaLS = $db->lastInsertMaLS();
            return $MaLS;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Cập nhật thông tin ng dùng: họ tên, số đt, email, ảnh đại diện 
    // (SV nên truyền tham số là 1 đối tượng kiểu người dùng, không nên truyền nhiều tham số rời rạc như thế này)
    public function capnhatlichsudoc($MaLS,$MaND, $MaBV, $ThoiGianDoc)
    {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE lichsudoc set MaND=:MaND, MaBV=:MaBV, ThoiGianDoc  where MaLS=MaLS";
            $cmd = $db->prepare($sql);
            $cmd->bindValue('MaLS', $MaLS);
            $cmd->bindValue(':MaND', $MaND);
            $cmd->bindValue(':MaBV', $MaBV);
            $cmd->bindValue(':ThoiGianDoc', $ThoiGianDoc);
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
    // public function doiMaBV($MaND, $MaBV)
    // {
    //     $db = DATABASE::connect();
    //     try {
    //         $sql = "UPDATE baiviet set MaBV=:MaBV where MaND=:MaND";
    //         $cmd = $db->prepare($sql);
    //         $cmd->bindValue(':MaND', $MaND);
    //         $cmd->bindValue(':MaBV', $MaBV);
    //         $ketqua = $cmd->execute();
    //         return $ketqua;
    //     } catch (PDOException $e) {
    //         $error_message = $e->getMessage();
    //         echo "<p>Lỗi truy vấn: $error_message</p>";
    //         exit();
    //     }
    // }
}
