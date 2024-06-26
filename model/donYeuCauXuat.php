<?php

    include_once("../model/ketnoi.php");
     class DonYeuCauXuat{
        function layDonYeuCauXuatDaDuyet(){
            
            $p= new KetNoiModel();
            $p->ketNoi($conn);
            $stmt = $conn->prepare("CALL layDonYeuCauXuatDaDuyet()");
            $stmt->execute();
            $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!$menuItems){
                return false;
            }else{
                $p->dongKetNoi($conn);
                return $menuItems;
            }
        }
       function layChiTietDonYeuCau($maDon){
            $p = new KetNoiModel();
            $p->ketNoi($conn);
            $stmt = $conn->prepare("CALL layDonYeuCauTheoMaDon(:maDon)");
            $stmt->bindParam(':maDon', $maDon, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: false;
        }
        function layDanhSachSanPham($maSanPham){
            
            $p = new KetNoiModel();
            $p->ketNoi($conn);
            $stmt = $conn->prepare("SELECT ctsp.MaChiTietSanPham,sp.MaSanPham, sp.TenSanPham, ctsp.soluongton - ctsp.soluongchoxuat as soluongton, ctsp.DonVi, ctsp.NgaySanXuat, ctsp.NgayHetHan,ctsp.MaKho FROM chitietsanpham as ctsp join sanpham as sp on sp.MaSanPham = ctsp.MaSanPham where sp.masanpham = :sanPham and ctsp.tinhTrang = 0 and ctsp.SoLuongTon > 0");
            $stmt->bindParam(':sanPham', $maSanPham, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: false;
        }
    }
?>
