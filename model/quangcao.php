<?php
class QUANGCAO
{
    private $MaQC;
    private $MoTaQC;
    private $URL;
    private $UrlHinhAnh;

    
    public function getMaQC()
    {
        return $this->MaQC;
    }
    public function setMaQC($value)
    {
        $this->MaQC = $value;
    }
    public function getMoTaQC()
    {
        return $this->MoTaQC;
    }
    public function setMoTaQC($value)
    {
        $this->MoTaQC = $value;
    }
    public function getURL()
    {
        return $this->URL;
    }
    public function setURL($value)
    {
        $this->URL = $value;
    }
    public function getUrlHinhAnh()
    {
        return $this->UrlHinhAnh;
    }
    public function setUrlHinhAnh($value)
    {
        $this->UrlHinhAnh = $value;
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
    public function laydanhsachquangcao()
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM quangcao";
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
    public function themquangcao($quangcao)
    {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO quangcao(MoTaQC, URL, UrlHinhAnh) 
VALUES(:MoTaQC, :URL, :UrlHinhAnh)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':MoTaQC', $quangcao->MoTaQC);
            $cmd->bindValue(':URL', $quangcao->URL);
            $cmd->bindValue(':UrlHinhAnh', $quangcao->UrlHinhAnh);
            $cmd->execute();
            $MaQC = $db->lastInsertMaQC();
            return $MaQC;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Cập nhật thông tin ng dùng: họ tên, số đt, email, ảnh đại diện 
    // (SV nên truyền tham số là 1 đối tượng kiểu người dùng, không nên truyền nhiều tham số rời rạc như thế này)
    public function capnhatquangcao($MaQC,$MoTaQC, $URL, $UrlHinhAnh)
    {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE quangcao set MoTaQC=:MoTaQC, URL=:URL, UrlHinhAnh  where MaQC=MaQC";
            $cmd = $db->prepare($sql);
            $cmd->bindValue('MaQC', $MaQC);
            $cmd->bindValue(':MoTaQC', $MoTaQC);
            $cmd->bindValue(':URL', $URL);
            $cmd->bindValue(':UrlHinhAnh', $UrlHinhAnh);
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
    // public function doiURL($MoTaQC, $URL)
    // {
    //     $db = DATABASE::connect();
    //     try {
    //         $sql = "UPDATE baiviet set URL=:URL where MoTaQC=:MoTaQC";
    //         $cmd = $db->prepare($sql);
    //         $cmd->bindValue(':MoTaQC', $MoTaQC);
    //         $cmd->bindValue(':URL', $URL);
    //         $ketqua = $cmd->execute();
    //         return $ketqua;
    //     } catch (PDOException $e) {
    //         $error_message = $e->getMessage();
    //         echo "<p>Lỗi truy vấn: $error_message</p>";
    //         exit();
    //     }
    // }
}
