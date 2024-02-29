<?php
class BINHLUAN
{
    private $MaBL;
    private $NoiDung;
    private $Ngay;
    private $MaBV;
    private $MaND;
    
    
    public function getMaBL()
    {
        return $this->MaBL;
    }
    public function setMaBL($value)
    {
        $this->MaBL = $value;
    }
    public function getNoiDung()
    {
        return $this->NoiDung;
    }
    public function setNoiDung($value)
    {
        $this->NoiDung = $value;
    }
    public function getNgay()
    {
        return $this->Ngay;
    }
    public function setNgay($value)
    {
        $this->Ngay = $value;
    }
    public function getMaBV()
    {
        return $this->MaBV;
    }
    public function setMaBV($value)
    {
        $this->MaBV = $value;
    }
    public function getMaND()
    {
        return $this->MaND;
    }
    public function setMaND($value)
    {
        $this->MaND = $value;
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
    public function laydanhsachbinhluan()
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM binhluan";
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
    public function thembinhluan($binhluan)
    {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO binhluan(NoiDung, Ngay, MaBV, MaND) 
VALUES(:NoiDung, :Ngay, :MaBV, :MaND)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':NoiDung', $binhluan->NoiDung);
            $cmd->bindValue(':Ngay', $binhluan->Ngay);
            $cmd->bindValue(':MaBV', $binhluan->MaBV);
            $cmd->bindValue(':MaND', $binhluan->MaND);
            $cmd->execute();
            $MaBL = $db->lastInsertMaBL();
            return $MaBL;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Cập nhật thông tin ng dùng: họ tên, số đt, email, ảnh đại diện 
    // (SV nên truyền tham số là 1 đối tượng kiểu người dùng, không nên truyền nhiều tham số rời rạc như thế này)
    public function capnhatbinhluan($NoiDung, $Ngay, $MaBV, $MaND) 
    {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE binhluan set NoiDung=:NoiDung, Ngay=:Ngay, MaBV=:MaBV, MaND=:MaND  where MaBL=MaBL";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':MaBL', $MaBL);
            $cmd->bindValue(':MaND', $MaND);
            $cmd->bindValue(':Ngay', $Ngay);
            $cmd->bindValue(':MaBV', $MaBV);
            $cmd->bindValue(':MaND', $MaND);
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
    // public function doitrangthai($MaND, $TrangThai)
    // {
    //     $db = DATABASE::connect();
    //     try {
    //         $sql = "UPDATE baiviet set TrangThai=:TrangThai where MaND=:MaND";
    //         $cmd = $db->prepare($sql);
    //         $cmd->bindValue(':MaND', $MaND);
    //         $cmd->bindValue(':TrangThai', $TrangThai);
    //         $ketqua = $cmd->execute();
    //         return $ketqua;
    //     } catch (PDOException $e) {
    //         $error_message = $e->getMessage();
    //         echo "<p>Lỗi truy vấn: $error_message</p>";
    //         exit();
    //     }
    // }
}
