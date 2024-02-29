<?php
class LOAITIN
{
    private $MaLT;
    private $TenLT;
    private $TrangThaiLT;
    private $MaTL;
    
    public function getMaLT()
    {
        return $this->MaLT;
    }
    public function setMaLT($value)
    {
        $this->MaLT = $value;
    }
    public function getTenLT()
    {
        return $this->TenLT;
    }
    public function setTenLT($value)
    {
        $this->TenLT = $value;
    }
    public function getTrangThaiLT()
    {
        return $this->TrangThaiLT;
    }
    public function setTrangThaiLT($value)
    {
        $this->TrangThaiLT = $value;
    }
    public function getMaTL()
    {
        return $this->MaTL;
    }
    public function setMaTL($value)
    {
        $this->MaTL = $value;
    }
    // khai báo các thuộc tính (SV tự viết)

    // lấy tất cả ng dùng
    public function laydanhsachloaitin()
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM loaitin";
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
    public function themloaitin($loaitin)
    {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO loaitin(TenLT, TrangThaiLT, MaTL) 
VALUES(:TenLT, :TrangThaiLT, :MaTL)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':TenLT', $loaitin->TenLT);
            $cmd->bindValue(':TrangThaiLT', $loaitin->TrangThaiLT);
            $cmd->bindValue(':MaTL', $loaitin->MaTL);
            $cmd->execute();
            $MaLT = $db->lastInsertMaLT();
            return $MaLT;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Cập nhật thông tin ng dùng: họ tên, số đt, email, ảnh đại diện 
    // (SV nên truyền tham số là 1 đối tượng kiểu người dùng, không nên truyền nhiều tham số rời rạc như thế này)
    public function capnhatloaitin($MaLT,$TenLT, $TrangThaiLT)
    {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE loaitin set TenLT=:TenLT, TrangThaiLT=:TrangThaiLT,   where MaLT=MaLT";
            $cmd = $db->prepare($sql);
            $cmd->bindValue('MaLT', $MaLT);
            $cmd->bindValue(':TenLT', $TenLT);
            $cmd->bindValue(':TrangThaiLT', $TrangThaiLT);
            $cmd->bindValue(':MaTL', $MaTL);
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
    // public function doitrangthai($TenLT, $TrangThai)
    // {
    //     $db = DATABASE::connect();
    //     try {
    //         $sql = "UPDATE baiviet set TrangThai=:TrangThai where TenLT=:TenLT";
    //         $cmd = $db->prepare($sql);
    //         $cmd->bindValue(':TenLT', $TenLT);
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
