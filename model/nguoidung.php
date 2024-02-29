<?php
class NGUOIDUNG
{
    private $MaND;
    private $HoTen;
    private $TenDN;
    private $MatKhau;
    private $Email;
    private $NgaySinh;
    private $GioiTinh;
    private $QuyenND;
    private $NgayDK;
    private $TrangThai;

    public function getMaND()
    {
        return $this->MaND;
    }
    public function setMaND($value)
    {
        $this->MaND = $value;
    }
    public function getHoTen()
    {
        return $this->HoTen;
    }
    public function setHoTen($value)
    {
        $this->HoTen = $value;
    }
    public function getTenDN()
    {
        return $this->TenDN;
    }
    public function setTenDN($value)
    {
        $this->TenDN = $value;
    }
    public function getMatKhau()
    {
        return $this->MatKhau;
    }
    public function setMatKhau($value)
    {
        $this->soMatKhau = $value;
    }
    public function getEmail()
    {
        return $this->Email;
    }
    public function setEmail($value)
    {
        $this->Email = $value;
    }
    public function getNgaySinh()
    {
        return $this->NgaySinh;
    }
    public function setNgaySinh($value)
    {
        $this->NgaySinh = $value;
    }
    public function getGioiTinh()
    {
        return $this->GioiTinh;
    }
    public function setGioiTinh($value)
    {
        $this->GioiTinh = $value;
    }
    public function getQuyenND()
    {
        return $this->QuyenND;
    }
    public function setQuyenND($value)
    {
        $this->QuyenND = $value;
    }
    public function getNgayDK()
    {
        return $this->NgayDK;
    }
    public function setNgayDK($value)
    {
        $this->NgayDK = $value;
    }
    public function getTrangThai()
    {
        return $this->TrangThai;
    }
    public function setTrangThai($value)
    {
        $this->TrangThai = $value;
    }
    // khai báo các thuộc tính (SV tự viết)

    public function kiemtranguoidunghople($email, $matkhau)
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM nguoidung WHERE Email=:Email AND MatKhau=:MatKhau AND TrangThai=1";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":Email", $Email);
            $cmd->bindValue(":MatKhau", md5($MatKhau));
            $cmd->execute();
            $valMaND = ($cmd->rowCount() == 1);
            $cmd->closeCursor();
            return $valMaND;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // lấy thông tin người dùng có $email
    public function laythongtinnguoidung($email)
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM nguoidung WHERE Email=:Email";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":Email", $Email);
            $cmd->execute();
            $ketqua = $cmd->fetch();
            $cmd->closeCursor();
            return $ketqua;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // lấy tất cả ng dùng
    public function laydanhsachnguoidung()
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM nguoidung";
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
    public function themnguoidung($nguoidung)
    {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO nguoidung(HoTen, TenDN, MatKhau, Email, NgaySinh, GioiTinh, QuyenND, NgayDK, TrangThai) 
VALUES(:HoTen, :TenDN, :MatKhau, :Email, :NgaySinh, :GioiTinh, :QuyenND, :NgayDK, :TrangThai)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':HoTen', $nguoidung->HoTen);
            $cmd->bindValue(':TenDN', $nguoidung->TenDN);
            $cmd->bindValue(':MatKhau', md5($nguoidung->MatKhau));
            $cmd->bindValue(':Email', $nguoidung->Email);
            $cmd->bindValue(':NgaySinh', $nguoidung->NgaySinh);
            $cmd->bindValue(':GioiTinh', $nguoidung->GioiTinh);
            $cmd->bindValue(':QuyenND', $nguoidung->QuyenND);
            $cmd->bindValue(':NgayDK', $nguoidung->NgayDK);
            $cmd->bindValue(':TrangThai', $nguoidung->TrangThai);
            $cmd->execute();
            $MaND = $db->lastInsertMaND();
            return $MaND;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Cập nhật thông tin ng dùng: họ tên, số đt, email, ảnh đại diện 
    // (SV nên truyền tham số là 1 đối tượng kiểu người dùng, không nên truyền nhiều tham số rời rạc như thế này)
    public function capnhatnguoidung($MaND, $HoTen , $TenDN , $MatKhau , $Email, $Ngaysinh, $GioiTinh, $QuyenND, $NgayDK, $TrangThai)
    {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE nguoidung set HoTen=:HoTen, TenDN=:TenDN, MatKhau=:MatKhau, Email=:Email, NgaySinh=:NgaySinh, GioiTinh=:GioiTinh, QuyenND=:QuyenND, NgayDK=:NgayDK, TrangThai=:TrangThai where MaND=MaND";
            $cmd = $db->prepare($sql);
            $cmd->bindValue('MaND', $MaND);
            $cmd->bindValue(':HoTen', $HoTen);
            $cmd->bindValue(':TenDN', $TenDN);
            $cmd->bindValue(':MatKhau', $MatKhau);
            $cmd->bindValue(':Email', $Email);
            $cmd->bindValue(':NgaySinh', $NgaySinh);
            $cmd->bindValue(':GioiTinh', $GioiTinh);
            $cmd->bindValue(':QuyenND', $QuyenND);
            $cmd->bindValue(':NgayDK', $NgayDK);
            $cmd->bindValue(':TrangThai', $TrangThai);
            $ketqua = $cmd->execute();
            return $ketqua;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Đổi mật khẩu
    public function doiMatKhau($Email, $MatKhau)
    {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE nguoidung set MatKhau=:MatKhau where Email=:Email";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':Email', $Email);
            $cmd->bindValue(':MatKhau', md5($MatKhau));
            $ketqua = $cmd->execute();
            return $ketqua;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Đổi quyền (loại người dùng: 1 quản trị, 2 nhân viên. Không cần nâng cấp quyền đối với loại người dùng 3 khách hàng)
    public function doiloainguoidung($Email, $QuyenND)
    {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE nguoidung set QuyenND=:QuyenND where Email=:Email";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':Email', $Email);
            $cmd->bindValue(':QuyenND', $QuyenND);
            $ketqua = $cmd->execute();
            return $ketqua;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Đổi trạng thái (0 khóa, 1 kích hoạt)
    public function doitrangthai($MaND, $TrangThai)
    {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE nguoidung set TrangThai=:TrangThai where MaND=:MaND";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':MaND', $MaND);
            $cmd->bindValue(':TrangThai', $TrangThai);
            $ketqua = $cmd->execute();
            return $ketqua;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}
