<?php
require_once "class/goc.php";
class tin extends goc {
    function TinMoi($sotin) {
        $sql = "SELECT  idTin, TieuDe, Ngay, TomTat, urlHinh, loaitin.Ten as TenLT FROM tin, loaitin
                WHERE tin.idLT = loaitin.idLT AND tin.AnHien = 0
                ORDER BY idTin DESC LIMIT 0, $sotin";

        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
        return $kq;
    }

    function TinNoiBat($sotin) {
        $sql = "SELECT idTin, TieuDe, Ngay, TomTat, urlHinh, loaitin.Ten as TenLT
                FROM tin, loaitin 
                WHERE tin.idLT = loaitin.idLT AND tin.AnHien=0 AND TinNoiBat=1
                ORDER BY idTin DESC LIMIT 0, $sotin";

        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
        return $kq;
    }

    function TinXemNhieu($sotin) {
        $sql = "SELECT idTin, TieuDe, Ngay, TomTat, urlHinh, loaitin.Ten as TenLT
                FROM tin, loaitin
                WHERE tin.idLT=loaitin.idLT AND tin.AnHien=0
                ORDER BY SoLanXem DESC LIMIT 0, $sotin";

        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
        return $kq;
    }

    function TinNgauNhien($sotin) {
        $sql = "SELECT idTin, TieuDe, Ngay, TomTat, urlHinh, loaitin.Ten as TenLT
                FROM tin, loaitin
                WHERE tin.idLT=loaitin.idLT AND tin.AnHien=0
                ORDER BY RAND() DESC LIMIT 0, $sotin";

        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
        return $kq;
    }

    function ListTheLoai() {
        $sql = "SELECT idTL, TenTL FROM theloai
                WHERE AnHien=0 ORDER BY ThuTu";

        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
        return $kq;
    }

    function ListLoaiTinTrong1TheLoai($idTL) {
        $sql = "SELECT idLT, Ten FROM loaitin
                WHERE AnHien=0 AND idTL=$idTL ORDER BY ThuTu";

        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
        return $kq;
    }

    function ChiTietTin($idTin) {
        settype($idTin, "int");
        $sql = "SELECT idTin, TieuDe, TomTat, Ngay, urlHinh, NoiDung, SoLanXem, tin.idLT, Ten, tin.idTL, TenTL
                FROM tin, loaitin, theloai
                WHERE tin.idLT=loaitin.idLT AND loaitin.idTL=theloai.idTL AND idTin=$idTin";

        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
        return $kq;
    }

    function CapNhatSoLanXemTin($idTin) {
        settype($idTin, "int");
        $sql = "UPDATE tin SET SoLanXem=SoLanXem+1 WHERE idTin=$idTin";
        $this->db->query($sql);
    }

    function TinCuCungLoai ($idTin, $sotin = 5) {
        $sql = "SELECT idTin, TieuDe, TomTat, urlHinh, Ngay, SoLanXem FROM tin
                WHERE AnHien=0 AND idTin<$idTin AND idLT = (SELECT idLT FROM tin WHERE idTin=$idTin)
                ORDER BY idTin DESC LIMIT 0, $sotin";

        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
        return $kq;
    }

    function TinTrongLoai($idLT, $pageNum, $pageSize, &$totalRows) {
        $startRow = ($pageNum-1)*$pageSize;
        $sql = "SELECT idTin, TieuDe, TomTat, urlHinh, Ngay, SoLanXem FROM tin
                WHERE AnHien=0 AND idLT=$idLT
                ORDER BY idTin DESC LIMIT $startRow, $pageSize"; //chỉ lấy vài record

        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
        //đếm số record, 2 câu lệnh sql phải giống nhau phần FROM và WHERE
        $sql = "SELECT count(*) FROM tin WHERE AnHien=0 AND idLT=$idLT";
        $rs = $this->db->query($sql);
        $row_rs = $rs->fetch_row();
        $totalRows = $row_rs[0];
        if(!$kq) die($this->db->error);
        return $kq;
    }

    function ChiTietLoaiTin($idLT) {
        settype($idLT, "int");
        $sql = "SELECT idLT, Ten, loaitin.idTL, TenTL FROM loaitin, theloai
                WHERE loaitin.idTL=theloai.idTL AND idLT= $idLT";

        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);
        return $kq;
    }

    function pageList($baseURL, $totalRows, $pageNum=1, $pageSize=5, $offset=3) {
        if($totalRows<=0) return "";
        $totalPages = ceil($totalRows/$pageSize);
        if($totalPages<=1) return "";
        $from = $pageNum - $offset;
        $to = $pageNum + $offset;
        if ($from <= 0) {
            $from = 1;
            $to = $offset*2;
        }
        if($to > $totalPages) {
            $to = $totalPages;
        }
        $links = "<ul class='newstuff_pagnav'>";
        for($j = $from; $j <= $to; $j++) {
            if($j == $pageNum)
                $links = $links."<li><a href='$baseURL&pageNum=$j' class='active_page'>$j</a></li>";
            else
                $links = $links."<li><a href='$baseURL&pageNum=$j'>$j</a></li>";
        }
        $links = $links."</ul>";
        return $links;
    }

    function TimKiem($tukhoa, &$totalRows, $pageNum=1, $pageSize=5) {
        $startRows = ($pageNum-1)*$pageSize;
        $tukhoa = $this->db->escape_string(trim(strip_tags($tukhoa)));
        $sql = "SELECT idTin, TieuDe, TomTat, urlHinh, Ngay, SoLanXem, Ten, TenTL FROM tin, loaitin, theloai
                WHERE tin.AnHien = 0 AND tin.idLT = loaitin.idLT AND tin.idTL=theloai.idTL AND (TieuDe RegExp '$tukhoa' or TomTat RegExp '$tukhoa')
                ORDER BY idTin DESC LIMIT $startRows, $pageSize";

        $kq = $this->db->query($sql);
        if(!$kq) die($this->db->error);

        $sql = "SELECT count(*) FROM tin, loaitin, theloai
                WHERE tin.AnHien = 0 AND tin.idLT = loaitin.idLT AND tin.idTL=theloai.idTL AND (TieuDe RegExp '$tukhoa' or TomTat RegExp '$tukhoa')";

        $rs = $this->db->query($sql);
        if(!$rs) die($this->db->error);
        $row_rs = $rs->fetch_row();
        $totalRows = $row_rs[0];
        return $kq;
    }

    function getTitle($p='') {
        if($p=='') return "Tin tức online";
        elseif ($p=='search') return "Tìm kiếm thông tin";
        elseif ($p=='register') return "Đăng kí thành viên";
        elseif ($p=='detail') {
            $id = $_GET['idTin'];
            settype($id, "int");
            $kq = $this->db->query("select TieuDe from tin where idTin=$id");
            if(!$kq) die($this->db->error);
            if($kq->num_rows <= 0) return "Tin tức tổng hợp";
            $row_kq = $kq->fetch_row();
            return $row_kq[0];
        }
    }

}
?>