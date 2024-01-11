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

  public function select_bulan($tabel)
  {
    $query = $this->db->get($tabel);
    return $query->result();
  }
  
  public function select_no_po($tabel)
  {
    $query = $this->db->get($tabel);
    return $query->result();
  }

  public function select_customer($tabel)
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
  public function get_record_datastok(){

    $this->db->select("*");
    $this->db->from("tb_actual_datastok");
    $this->db->order_by("id_data_stok", "asc");
    $query = $this->db->get();
    return $query->result();
  }
  public function get_record_datadelv(){

    $this->db->select("*");
    $this->db->from("tb_actual_delivery");
    $this->db->order_by("id_pengiriman", "asc");
    $query = $this->db->get();
    return $query->result();
  }
  public function get_record_dataAkm(){

    $this->db->select("*");
    $this->db->from("tb_akumulasi");
    $this->db->order_by("nama_part", "asc");
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
  public function get_record_akumulasi(){

    $this->db->select("*");
    $this->db->from("tb_actual_delivery");
    $this->db->order_by("nomor_part");
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
  public function get_data_po($tabel,$id_po)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where($id_po)
                      ->get();
    return $query->result();
  }
  public function get_data_stok($tabel,$id_data_stok)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where($id_data_stok)
                      ->get();
    return $query->result();
  }
  public function get_data_delv($tabel,$id_pengiriman)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where($id_pengiriman)
                      ->get();
    return $query->result();
  }
  public function get_where($tabel,$nama_part)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where($nama_part)
                      ->get();
    return $query->result();
  }
  
  public function get_jumlah_po($nomor_po, $nama_part)
  {
      $this->db->select('jumlah');
      $this->db->from('tb_po');
      $this->db->where('nomor_po', $nomor_po);
      $this->db->where('nama_part', $nama_part);
      $query = $this->db->get();
      return $query->result();
  }
  

  public function update($tabel,$data,$where)
  {
    $this->db->where($where);
    $this->db->update($tabel,$data);
  }

  public function get_data_delv_by_id($id_pengiriman)
    {
        $this->db->where('id_pengiriman', $id_pengiriman);
        return $this->db->get('tb_actual_delivery')->row();
    }

    public function get_data_akumulasi_by_id($id_pengiriman)
    {
        $this->db->where('id_pengiriman', $id_pengiriman);
        return $this->db->get('tb_akumulasi')->row();
    }

  public function delete($tabel,$where)
  {
    $this->db->where($where);
    $this->db->delete($tabel);
  }

  public function delete_cust($tabel, $where)
  {
      $this->db->where($where);
      return $this->db->delete($tabel);
  }
  

  public function get_data_by_id($tabel, $where)
    {
        $this->db->where($where);
        $query = $this->db->get($tabel);

        return $query->row();
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
  
  public function sumColumnDataByField($sumColumn, $groupByField) {
    $this->db->select("$groupByField, SUM($sumColumn) as total");
    $this->db->group_by($groupByField);
    $query = $this->db->get('tb_actual_delivery');

    return $query->result();
  }

  public function get_list_data($tabel)
  {
      return $this->db->get($tabel)->result();
  }

  public function get_akumulasi()
  {
      $query = "SELECT nama_customer, bulan, nomor_po, nomor_part, nama_part, satuan, SUM(pengiriman) as totalDelivery FROM tb_akumulasi GROUP BY nama_customer, bulan, nomor_po, nomor_part, nama_part, satuan";
      return $this->db->query($query)->result();
  }

  public function update_akumulasi($data, $where)
    {
        $this->db->update('tb_akumulasi', $data, $where);
    }

    public function get_existing_stok($nomor_part, $nama_part)
    {
        $this->db->where('nomor_part', $nomor_part);
        $this->db->where('nama_part', $nama_part);
        return $this->db->get('tb_actual_datastok')->row(); // Menggunakan row() untuk mengembalikan satu baris hasil.
    }
    
    public function update_stok($nomor_part, $nama_part, $data_stok)
    {
        $this->db->where('nomor_part', $nomor_part);
        $this->db->where('nama_part', $nama_part);
        $this->db->set('data_stok', $data_stok);
        $this->db->update('tb_actual_datastok');
    }
    
    public function insert_stok($data_part, $data_stok)
    {
        $data = array(
            'data_part' => $data_part,
            'data_stok' => $data_stok
        );
    
        $this->db->insert('tb_actual_datastok', $data);
    }
    public function get_record_customer($customer) {
      // Membaca data dari tabel 'customer'
      $query = $this->db->get($customer);

      // Mengembalikan hasil query sebagai array
      return $query->result_array();
  }

  public function get_data_pengiriman($id_pengiriman)
  {
      // Ambil data pengiriman berdasarkan id_pengiriman
      return $this->db->get_where('tb_actual_delivery', array('id_pengiriman' => $id_pengiriman))->row();
  }

  public function get_data_stok_by_nomor_part($nomor_part)
  {
      // Ambil data stok berdasarkan nomor_part
      $this->db->where('nomor_part', $nomor_part);
      return $this->db->get('tb_actual_datastok')->row();
  }

  public function update_data_stok($nomor_part, $data_stok_baru)
  {
      // Update data stok berdasarkan nomor_part
      $this->db->where('nomor_part', $nomor_part);
      $this->db->update('tb_actual_datastok', array('data_stok' => $data_stok_baru));
  }
  public function get_total_pengiriman($nama_part, $nomor_part)
  {
    $this->db->select_sum('pengiriman');
    $this->db->where('nama_part', $nama_part);
    $this->db->where('nomor_part', $nomor_part);
    $query = $this->db->get('tb_actual_delivery');
    
    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->pengiriman;
    } else {
        return 0; // Jika tidak ada data pengiriman
    }
  }
  public function delete_customer($id_customer)
    {
        // Hapus customer berdasarkan ID
        $this->db->where('id_customer', $id_customer);
        $this->db->delete('customer');
    }
  public function get_delivery_by_criteria($nama_part, $nomor_part, $bulan)
  {
      // Ubah format bulan menjadi yyyy-mm (contoh: 2023-09)
      $bulan_formatted = date('Y-m', strtotime($bulan));

      // Buat query untuk mengambil pengiriman berdasarkan kriteria
      $this->db->select('*');
      $this->db->from('tb_actual_delivery');
      $this->db->where('nama_part', $nama_part);
      $this->db->where('nomor_part', $nomor_part);
      $this->db->like('tanggal_masuk', $bulan_formatted, 'after');

      return $this->db->get()->result();
  }  
  public function get_delivery_data($nama_part, $nomor_part) {
    // Buat query untuk mencari data berdasarkan nama_part dan nomor_part
    $this->db->where('nama_part', $nama_part);
    $this->db->where('nomor_part', $nomor_part);
    $this->db->where('MONTH(tanggal_masuk)', date('m'));

    // Eksekusi query
    $query = $this->db->get('nama_tabel_pengiriman');

    // Kembalikan hasil query sebagai array
    return $query->result();
}

  public function cari_pengiriman($nama_part, $nomor_part, $nomor_po, $bulan) {
      // Contoh query pencarian berdasarkan nama_part, nomor_part, dan bulan
      $this->db->select('*');
      $this->db->from('tb_actual_delivery'); // Ganti dengan nama tabel yang sesuai
      $this->db->like('nama_part', $nama_part);
      $this->db->like('nomor_part', $nomor_part);
      $this->db->like('nomor_po', $nomor_po);
      $this->db->like('bulan', $bulan);
      $query = $this->db->get();

      // Mengembalikan hasil query sebagai array
      return $query->result();
  }

  public function cari_pengiriman_data_po($nama_part, $nomor_part, $nomor_po, $bulan) {
    // Contoh query pencarian berdasarkan nama_part, nomor_part, dan bulan
    $this->db->select('*');
    $this->db->from('tb_po'); // Ganti dengan nama tabel yang sesuai
    $this->db->like('nama_part', $nama_part);
    $this->db->like('nomor_part', $nomor_part);
    $this->db->like('nomor_po', $nomor_po);
    $this->db->like('bulan', $bulan);
    $query = $this->db->get();

    // Mengembalikan hasil query sebagai array
    return $query->result();
}

  public function cari_pengiriman_po($nama_part, $nomor_part, $nomor_po, $bulan)
  {
      // Query pencarian dengan kondisi WHERE
      $this->db->select('*');
      $this->db->from('tb_po');
      
      // Tambahkan kondisi WHERE sesuai dengan parameter yang diberikan
      if (!empty($nama_part)) {
          $this->db->where('nama_part', $nama_part);
      }
      
      if (!empty($nomor_part)) {
          $this->db->where('nomor_part', $nomor_part);
      }
      
      if (!empty($nomor_po)) {
          $this->db->where('nomor_po', $nomor_po);
      }
      
      if (!empty($bulan)) {
          $this->db->where('bulan', $bulan);
      }
      
      $query = $this->db->get();
      return $query->result();
  }
  
  public function get_existing_data_stok($nomor_part, $nama_part)
  {
      // Ambil data dengan nomor_part dan nama_part yang sama
      $this->db->where('nomor_part', $nomor_part);
      $this->db->where('nama_part', $nama_part);
      $query = $this->db->get('tb_actual_datastok');

      if ($query->num_rows() > 0) {
          return $query->row_array();
      } else {
          return null;
      }
  }

  public function update_existing_data_stok($data, $where)
  {
      // Update data_stok berdasarkan nomor_part dan nama_part
      $this->db->where($where);
      $this->db->update('tb_actual_datastok', $data);
  }

  public function get_akumulasi_delv($nama_customer = null, $bulan = null)
  {
      $this->db->select('nama_customer, bulan, nomor_po, nomor_part, nama_part, satuan, SUM(pengiriman) as totalDelivery');
      $this->db->from('tb_akumulasi');
  
      if ($nama_customer !== null) {
          $this->db->where('nama_customer', $nama_customer);
      }
  
      if ($bulan !== null) {
          $this->db->where('bulan', $bulan);
      }
  
      $this->db->group_by('nama_customer, bulan, nomor_po, nomor_part, nama_part, satuan');
      return $this->db->get()->result();
  }
  

}
 ?>
