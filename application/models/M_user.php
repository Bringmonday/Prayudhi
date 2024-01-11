<?php

class M_admin extends CI_Model
{

  public function insert($tabel,$data)
  {
    $this->db->insert($tabel,$data);
  }

  public function select($tabel)
  {
    $query = $this->db->get($tabel);
    return $query->result();
  }

  public function get_record_stok(){

    $this->db->select("*");
    $this->db->from("tb_part");
    $this->db->order_by("id_part", "asc");
    $query = $this->db->get();
    return $query->result();
  }

  public function get_record_stok_po(){

    $this->db->select("*");
    $this->db->from("tb_po");
    $this->db->order_by("id_po", "asc");
    $query = $this->db->get();
    return $query->result();
  }

  public function get_record_masuk(){

    $this->db->select("*");
    $this->db->from("tb_po");
    $this->db->order_by("tanggal_masuk", "desc");
    $query = $this->db->get();
    return $query->result();
  }

  public function get_record_masuk_part(){

    $this->db->select("*");
    $this->db->from("tb_part");
    $this->db->order_by("tanggal_masuk", "desc");
    $query = $this->db->get();
    return $query->result();
  }

  public function get_record_keluar(){

    $this->db->select("*");
    $this->db->from("tb_barang_keluar");
    $this->db->order_by("tanggal_keluar", "desc");
    $query = $this->db->get();
    return $query->result();
  }

  public function cek_jumlah($tabel,$kode_barang)
  {
    return  $this->db->select('*')
               ->from($tabel)
               ->where('kode_barang',$kode_barang)
               ->get();

  }

  public function get_data_array($tabel,$kode_barang)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where($kode_barang)
                      ->get();
    return $query->result_array();
  }

  public function get_data($tabel,$id_part)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where($id_part)
                      ->get();
    return $query->result();
  }

  public function update($tabel,$data,$where)
  {
    $this->db->where($where);
    $this->db->update($tabel,$data);
  }

  public function delete($tabel,$where)
  {
    $this->db->where($where);
    $this->db->delete($tabel);
  }

  public function mengurangi($tabel,$kode_barang,$jumlah)
  {
    $this->db->set("jumlah","jumlah - $jumlah");
    $this->db->where('kode_barang',$kode_barang);
    $this->db->update($tabel);
  }

  public function update_password($tabel,$where,$data)
  {
    $this->db->where($where);
    $this->db->update($tabel,$data);
  }

  public function get_data_gambar($tabel,$username)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where('username_user',$username)
                      ->get();
    return $query->result();
  }

  public function sum($tabel,$field)
  {
    $query = $this->db->select_sum($field)
                      ->from($tabel)
                      ->get();
    return $query->result();
  }

  public function numrows($tabel)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->get();
    return $query->num_rows();
  }

  public function kecuali($tabel,$username)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where_not_in('username',$username)
                      ->get();

    return $query->result();
  }
  


}



 ?>
