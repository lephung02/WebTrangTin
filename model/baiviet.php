<?php
class BAIVIET
{
    private $MaBV;
    private $TieuDe;
    private $TomTat;
    private $NoiDung;
    private $urlHinhAnh;
    private $NgayDang;
    private $SoLanXem;
    private $TuKhoa;
    private $TrangThaiBV;
    private $MaLT;

    public function getMaBV()
    {
        return $this->MaBV;
    }
    public function setMaBV($value)
    {
        $this->MaBV = $value;
    }
    public function getTieuDe()
    {
        return $this->TieuDe;
    }
    public function setTieuDe($value)
    {
        $this->TieuDe = $value;
    }
    public function getTomTat()
    {
        return $this->TomTat;
    }
    public function setTomTat($value)
    {
        $this->TomTat = $value;
    }
    public function getNoiDung()
    {
        return $this->NoiDung;
    }
    public function setNoiDung($value)
    {
        $this->NoiDung = $value;
    }
    public function geturlHinhAnh()
    {
        return $this->urlHinhAnh;
    }
    public function seturlHinhAnh($value)
    {
        $this->urlHinhAnh = $value;
    }
    public function getNgayDang()
    {
        return $this->NgayDang;
    }
    public function setNgayDang($value)
    {
        $this->NgayDang = $value;
    }
    public function getSoLanXem()
    {
        return $this->SoLanXem;
    }
    public function setSoLanXem($value)
    {
        $this->SoLanXem = $value;
    }
    public function getTuKhoa()
    {
        return $this->TuKhoa;
    }
    public function setTuKhoa($value)
    {
        $this->TuKhoa = $value;
    }
    
    public function getTrangThaiBV()
    {
        return $this->TrangThaiBV;
    }
    public function setTrangThaiBV($value)
    {
        $this->TrangThaiBV = $value;
    }
    public function getMaLT()
    {
        return $this->MaLT;
    }
    public function setMaLT($value)
    {
        $this->MaLT = $value;
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
    public function laydanhsachbaiviet()
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM baiviet";
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
    public function thembaiviet($baiviet)
    {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO baiviet(TieuDe, TomTat, NoiDung, urlHinhAnh, NgayDang, SoLanXem, TuKhoa, TrangThaiBV, MaLT) 
VALUES(:TieuDe, :TomTat, :NoiDung, :urlHinhAnh, :NgayDang, :SoLanXem, :TuKhoa, :TrangThaiBV, :MaLT)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':TieuDe', $baiviet->TieuDe);
            $cmd->bindValue(':TomTat', $baiviet->TomTat);
            $cmd->bindValue(':NoiDung',$baiviet->NoiDung);
            $cmd->bindValue(':urlHinhAnh', $baiviet->urlHinhAnh);
            $cmd->bindValue(':NgayDang', $baiviet->NgayDang);
            $cmd->bindValue(':SoLanXem', $baiviet->SoLanXem);
            $cmd->bindValue(':TuKhoa', $baiviet->TuKhoa);
            $cmd->bindValue(':NgayDK', $baiviet->NgayDK);
            $cmd->bindValue(':TrangThaiBV', $baiviet->TrangThaiBV);
            $cmd->bindValue(':MaLT', $baiviet->MaLT);
            $cmd->execute();
            $MaBV = $db->lastInsertMaBV();
            return $MaBV;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Cập nhật thông tin ng dùng: họ tên, số đt, email, ảnh đại diện 
    // (SV nên truyền tham số là 1 đối tượng kiểu người dùng, không nên truyền nhiều tham số rời rạc như thế này)
    public function capnhatbaiviet($MaBV,$TieuDe, $TomTat , $NoiDung , $urlHinhAnh , $NgayDang, $SoLanXem, $TuKhoa, $TrangThaiBV, $MaLT)
    {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE baiviet set TieuDe=:TieuDe, TomTat=:TomTat, NoiDung=:NoiDung, urlHinhAnh=:urlHinhAnh, NgayDang=:NgayDang, SoLanXem=:SoLanXem, TuKhoa=:TuKhoa, NgayDK=:NgayDK, TrangThaiBV=:TrangThaiBV, MaLT=:MaLT where MaBV=MaBV";
            $cmd = $db->prepare($sql);
            $cmd->bindValue('MaBV', $MaBV);
            $cmd->bindValue(':TieuDe', $TieuDe);
            $cmd->bindValue(':TomTat', $TomTat);
            $cmd->bindValue(':NoiDung', $NoiDung);
            $cmd->bindValue(':urlHinhAnh', $urlHinhAnh);
            $cmd->bindValue(':NgayDang', $NgayDang);
            $cmd->bindValue(':SoLanXem', $SoLanXem);
            $cmd->bindValue(':TuKhoa', $TuKhoa);
            $cmd->bindValue(':TrangThaiBV', $TrangThaiBV);
            $cmd->bindValue(':MaLT', $MaLT);
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
