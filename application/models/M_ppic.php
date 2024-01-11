<?php

class M_ppic extends CI_Model
{

  public function insert1($tabel,$data)
  {
    $this->db->insert($tabel,$data);
  }

  public function select1($tabel)
  {
    $query = $this->db->get($tabel);
    return $query->result();
  }

  public function get_record_stok1(){

    $this->db->select("*");
    $this->db->from("tb_stok_barang");
    $this->db->order_by("kode_barang", "asc");
    $query = $this->db->get();
    return $query->result();
  }

  public function get_record_masuk1(){

    $this->db->select("*");
    $this->db->from("tb_actual_delivery");
    $this->db->order_by("tanggal_masuk", "desc");
    $query = $this->db->get();
    return $query->result();
  }

  public function get_record_keluar1(){

    $this->db->select("*");
    $this->db->from("tb_barang_keluar");
    $this->db->order_by("tanggal_keluar", "desc");
    $query = $this->db->get();
    return $query->result();
  }

  public function cek_jumlah1($tabel,$kode_barang)
  {
    return  $this->db->select('*')
               ->from($tabel)
               ->where('kode_barang',$kode_barang)
               ->get();

  }

  public function get_data_array1($tabel,$kode_barang)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where($kode_barang)
                      ->get();
    return $query->result_array();
  }

  public function get_data1($tabel,$kode_barang)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where($kode_barang)
                      ->get();
    return $query->result();
  }

  public function update1($tabel,$data,$where)
  {
    $this->db->where($where);
    $this->db->update($tabel,$data);
  }

  public function delete1($tabel,$where)
  {
    $this->db->where($where);
    $this->db->delete($tabel);
  }

  public function mengurangi1($tabel,$kode_barang,$jumlah)
  {
    $this->db->set("jumlah","jumlah - $jumlah");
    $this->db->where('kode_barang',$kode_barang);
    $this->db->update($tabel);
  }

  public function update_password1($tabel,$where,$data)
  {
    $this->db->where($where);
    $this->db->update($tabel,$data);
  }

  public function get_data_gambar1($tabel,$username)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where('username_user',$username)
                      ->get();
    return $query->result();
  }

  public function sum1($tabel,$field)
  {
    $query = $this->db->select_sum($field)
                      ->from($tabel)
                      ->get();
    return $query->result();
  }

  public function numrows1($tabel)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->get();
    return $query->num_rows();
  }

  public function kecuali1($tabel,$username)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where_not_in('username',$username)
                      ->get();

    return $query->result();
  }
  


}



 ?>
