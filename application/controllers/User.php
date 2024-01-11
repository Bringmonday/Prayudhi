<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
  
  public function __construct() {
    parent::__construct();
    $this->load->model('M_admin');
    $this->load->library('upload');
  }

  public function index(){
    if($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 0){
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
      $data['DataPO'] = $this->M_admin->sum('tb_po','jumlah');    
      $data['DeliveryPart'] = $this->M_admin->sum('tb_actual_delivery','pengiriman');    
      $data['dataUser'] = $this->M_admin->numrows('user');
      $this->load->view('user/index',$data);
    }else {
      $this->load->view('login/login');
    }
  }

  public function sigout(){
    session_destroy();
    redirect('login');
  }

  ####################################
              // Profile
  ####################################

  public function profile()
  {
    $data['token_generate'] = $this->token_generate();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->session->set_userdata($data);
    $this->load->view('user/profile',$data);
  }

  public function token_generate()
  {
    return $tokens = md5(uniqid(rand(), true));
  }

  private function hash_password($password)
  {
    return password_hash($password,PASSWORD_DEFAULT);
  }

  public function proses_new_password()
  {
    $this->form_validation->set_rules('email','Email','required');
    $this->form_validation->set_rules('new_password','New Password','required');
    $this->form_validation->set_rules('confirm_new_password','Confirm New Password','required|matches[new_password]');

    if($this->form_validation->run() == TRUE)
    {
      if($this->session->userdata('token_generate') === $this->input->post('token'))
      {
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $new_password = $this->input->post('new_password');

        $data = array(
            'email'    => $email,
            'password' => $this->_passwordhash($new_password)
        );

        $where = array(
            'id_user' =>$this->session->userdata('id_user')
        );

        $this->M_admin->update_password('user',$where,$data);

        $this->session->set_flashdata('msg_berhasil','Password Telah Diganti');
        redirect(base_url('user/profile'));
      }
    }else {
      $this->load->view('user/profile');
    }
  }

  public function proses_gambar_upload()
  {
    $config =  array(
                   'upload_path'     => "./assets/upload/user/img/",
                   'allowed_types'   => "gif|jpg|png|jpeg",
                   'encrypt_name'    => False, //
                   'max_size'        => "50000",  // ukuran file gambar
                   'max_height'      => "9680",
                   'max_width'       => "9024"
                 );
      $this->load->library('upload',$config);
      $this->upload->initialize($config);

      if( ! $this->upload->do_upload('userpicture'))
      {
        $this->session->set_flashdata('msg_error_gambar', $this->upload->display_errors());
        $this->load->view('user/profile');
      }else{
        $upload_data = $this->upload->data();
        $nama_file = $upload_data['file_name'];
        $ukuran_file = $upload_data['file_size'];

        //resize img + thumb Img -- Optional
        $config['image_library']     = 'gd2';
				$config['source_image']      = $upload_data['full_path'];
				$config['create_thumb']      = FALSE;
				$config['maintain_ratio']    = TRUE;
				$config['width']             = 150;
				$config['height']            = 150;

        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
				if (!$this->image_lib->resize())
        {
          $data['pesan_error'] = $this->image_lib->display_errors();
          $this->load->view('user/profile',$data);
        }

        $where = array(
                'username_user' => $this->session->userdata('name')
        );

        $data = array(
                'nama_file' => $nama_file,
                'ukuran_file' => $ukuran_file
        );

        $this->M_admin->update('tb_upload_gambar_user',$data,$where);
        $this->session->set_flashdata('msg_berhasil_gambar','Gambar Sukses di Unggah');
        redirect(base_url('user/profile'));
      }
  }

  ####################################
           // End Profile
  ####################################

  ####################################
        // DATA ACTUAL DATA STOK
  ####################################

  public function form_datastok()
  {
    $data['list_part'] = $this->M_admin->select('tb_part');
    $data['list_customer'] = $this->M_admin->select_customer('customer');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('user/form_datastok/form_insert',$data);
  }

  public function tabel_datastok()
  {
    $data = array(
              'list_data' => $this->M_admin->get_record_datastok('tb_actual_datastok'),
              'avatar'    => $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'))
            );
    $this->load->view('user/tabel/tabel_datastok',$data);
  }

  public function update_datastok($id_data_stok)
  {
    $where = array('id_data_stok' => $id_data_stok);
    $data['data_stok_update'] = $this->M_admin->get_data_stok('tb_actual_datastok',$where);
    $data['list_part'] = $this->M_admin->select('tb_part');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('user/form_datastok/form_update',$data);
  }

  public function delete_datastok($id_data_stok)
  {
      $where = array('id_data_stok' => $id_data_stok);
      $dataToDelete = $this->M_admin->get_data_stok('tb_actual_datastok', $where);
  
      if ($dataToDelete) {
          $nama_part = $dataToDelete->nama_part;
          $nomor_part = $dataToDelete->nomor_part;
  
          // Ambil data pengiriman yang sesuai
          $where_delivery = array(
              'nama_part' => $nama_part,
              'nomor_part' => $nomor_part
          );
  
          $dataDeliveryToDelete = $this->M_admin->get_data_delv('tb_actual_delivery', $where_delivery);
  
          if ($dataDeliveryToDelete) {
              // Mengembalikan nilai pengiriman yang akan dihapus ke data_stok
              $data_stok_sebelum = $this->M_admin->get_data_stok_by_nomor_part($nama_part);
              $data_stok_baru = $data_stok_sebelum->data_stok + $dataDeliveryToDelete->pengiriman;
              $this->M_admin->update_data_stok($nama_part, $data_stok_baru);
          }
  
          // Hapus data pengiriman dari tb_actual_delivery
          $this->M_admin->delete('tb_actual_delivery', $where_delivery);
  
          // Hapus data dari tb_actual_datastok
          $this->M_admin->delete('tb_actual_datastok', $where);
  
          // Redirect kembali ke halaman tabel_datastok
          redirect(base_url('user/tabel_datastok'));
      } else {
          // Jika data tidak ditemukan, atur pesan error atau tindakan yang sesuai
          echo "Data tidak ditemukan atau sudah dihapus sebelumnya.";
      }
  }
    

  public function proses_tambah_dataStok_insert()
  {
      $this->form_validation->set_rules('id_data_stok', 'Id Data Stok', 'required');
      $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Input', 'required');
      $this->form_validation->set_rules('nama_customer', 'Customer', 'required');
      $this->form_validation->set_rules('nomor_part', 'Nomor Part', 'required');
      $this->form_validation->set_rules('nama_part', 'Nama Part', 'required');
      $this->form_validation->set_rules('data_stok', 'Actual Data Stok', 'required');
  
      if ($this->form_validation->run() == TRUE) {
          $id_data_stok = $this->input->post('id_data_stok', TRUE);
          $tanggal_masuk = $this->input->post('tanggal_masuk', TRUE);
          $nama_customer = $this->input->post('nama_customer', TRUE);
          $nomor_part = $this->input->post('nomor_part', TRUE);
          $nama_part = $this->input->post('nama_part', TRUE);
          $data_stok = $this->input->post('data_stok', TRUE);
  
          // Cek apakah data dengan nomor_part dan nama_part yang sama sudah ada dalam tabel_datastok
          $existing_data_stok = $this->M_admin->get_existing_data_stok($nomor_part, $nama_part);
  
          if ($existing_data_stok) {
              // Jika sudah ada, tambahkan data_stok yang baru ke yang sudah ada
              $where = array('nomor_part' => $nomor_part, 'nama_part' => $nama_part);
              $existing_stok = $existing_data_stok['data_stok'];
              $updated_stok = $existing_stok + $data_stok;
  
              $data = array(
                  'id_data_stok' => $id_data_stok,
                  'tanggal_masuk' => $tanggal_masuk,
                  'nama_customer' => $nama_customer,
                  'nomor_part' => $nomor_part,
                  'nama_part' => $nama_part,
                  'data_stok' => $updated_stok
              );
  
              $this->M_admin->update_existing_data_stok($data, $where);
          } else {
              // Jika belum ada, tambahkan data_stok baru
              $data = array(
                  'id_data_stok' => $id_data_stok,
                  'tanggal_masuk' => $tanggal_masuk,
                  'nama_customer' => $nama_customer,
                  'nomor_part' => $nomor_part,
                  'nama_part' => $nama_part,
                  'data_stok' => $data_stok
              );
  
              $this->M_admin->insert('tb_actual_datastok', $data);
          }
  
          echo '<script language="javascript">
                window.location="tabel_datastok";
              </script>';
          exit();
      } else {
          $data['list_satuan'] = $this->M_admin->select('tb_satuan');
          $this->load->view('user/form_datastok/form_insert', $data);
      }
  }
  
  public function proses_tambah_dataStok_update()
  {
    $this->form_validation->set_rules('id_data_stok','Id Data Stok','required');
    $this->form_validation->set_rules('tanggal_masuk','Tanggal Input','required');
    $this->form_validation->set_rules('nama_customer','Customer','required');
    $this->form_validation->set_rules('nomor_part','Nomor Part','required');
    $this->form_validation->set_rules('nama_part','Nama Part','required');
    $this->form_validation->set_rules('data_stok','Actual Data Stok','required');

    if($this->form_validation->run() == TRUE)
    {
      $id_data_stok = $this->input->post('id_data_stok',TRUE);
      $tanggal_masuk = $this->input->post('tanggal_masuk',TRUE);
      $nama_customer     = $this->input->post('nama_customer',TRUE);
      $nomor_part  = $this->input->post('nomor_part',TRUE);
      $nama_part  = $this->input->post('nama_part',TRUE);
      $data_stok     = $this->input->post('data_stok',TRUE);

      $where = array('id_data_stok' => $id_data_stok);
      $data = array(
            'id_data_stok'         => $id_data_stok,
            'tanggal_masuk'         => $tanggal_masuk,
            'nama_customer'   => $nama_customer,
            'nomor_part'      => $nomor_part,
            'nama_part'       => $nama_part,
            'data_stok'       => $data_stok
      );
      $this->M_admin->update('tb_actual_datastok',$data,$where);
      $this->session->set_flashdata('msg_berhasil','Data Stok Berhasil Diupdate');
      redirect(base_url('user/tabel_datastok'));
    }else{
      $this->load->view('user/form_datastok/form_update');
    }
  }
  public function input_pengiriman()
  {
      // Ambil data dari form input pengiriman
      $nomor_part = $this->input->post('nomor_part');
      $pengiriman = $this->input->post('pengiriman');
  
      // Cari data stok berdasarkan nomor_part yang sesuai
      $data_stok = $this->M_admin->get_data_stok_by_nomor_part($nomor_part);
  
      if ($data_stok) {
          // Update data stok berdasarkan jumlah pengiriman
          $data_stok_baru = $data_stok->data_stok - $pengiriman;
  
          // Lakukan validasi agar stok tidak menjadi negatif
          if ($data_stok_baru >= 0) {
              // Simpan perubahan stok ke dalam database
              $this->M_admin->update_data_stok($nomor_part, $data_stok_baru);
  
              // Simpan data pengiriman ke dalam tabel tb_actual_delivery
              $data_pengiriman = array(
                  'nomor_part' => $nomor_part,
                  'pengiriman' => $pengiriman,
                  // tambahkan field lain sesuai kebutuhan
              );
  
              $this->M_admin->insert_pengiriman($data_pengiriman);
  
              // Redirect atau tampilkan pesan sukses
              redirect(base_url('user/tabel/tabel_datastok'));
          } else {
              // Tampilkan pesan error jika stok menjadi negatif
              echo 'Stok tidak cukup!';
          }
      } else {
          // Tampilkan pesan error jika data stok tidak ditemukan
          echo 'Data stok tidak ditemukan!';
      }
  }
  
  ####################################
      // END ACTUAL DATA STOK
  ####################################

  ####################################
      // DATA ACTUAL DATA DELIVERY
  ####################################

  public function form_datadelv()
  {
    $data['list_part'] = $this->M_admin->select('tb_part');
    $data['list_bulan'] = $this->M_admin->select_bulan('bulan');
    $data['list_part_po'] = $this->M_admin->select('tb_part_po');
    $data['list_customer'] = $this->M_admin->select_customer('customer');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('user/form_datadelv/form_insert',$data);
  }

  public function tabel_datadelv()
  {
    $data = array(
              'list_data' => $this->M_admin->get_record_datadelv('tb_actual_delivery'),
              'list_bulan' => $this->M_admin->select_bulan('bulan'),
              'list_no_po' => $this->M_admin->select_no_po('tb_po'),
              'list_part' => $this->M_admin->select('tb_part'),
              'avatar'    => $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'))
            );
    $this->load->view('user/tabel/tabel_datadelv',$data);
  }
  public function tabel_datapo()
  {
    $data = array(
              'list_data' => $this->M_admin->get_record_stok_po('tb_po'),
              'list_no_po' => $this->M_admin->select_no_po('tb_po'),
              'list_part_po' => $this->M_admin->select('tb_part_po'),
              'list_part' => $this->M_admin->select('tb_part'),
              'avatar'    => $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'))
            );
    $this->load->view('user/tabel/tabel_datapo',$data);
  }

  public function tabel_akumulasi()
  {
    $nama_customer = $this->input->post('nama_customer');
    $bulan = $this->input->post('bulan');
    $data = array(
      'list_data' => $this->M_admin->get_list_data('tb_actual_delivery'),
      'list_part' => $this->M_admin->select('tb_part'),
      'list_no_po' => $this->M_admin->select_no_po('tb_po'),
      'list_part_po' => $this->M_admin->select('tb_part_po'),
      'avatar'    => $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name')),
      'results' => $this->M_admin->get_akumulasi(),
      'hasil' => $this->M_admin->get_akumulasi_delv()

    );
    foreach ($data['list_data'] as &$dd) {
      $jumlah_data_po = $this->M_admin->get_jumlah_po($dd->nomor_po, $dd->nama_part);
      if (!empty($jumlah_data_po)) {
          $dd->jumlah_po = $jumlah_data_po[0]->jumlah;
      } else {
          $dd->jumlah_po = 0; 
      }
    }
      $this->load->view('user/tabel/tabel_akumulasi',$data);
  }

  public function show_delivery_by_criteria($nama_part, $nomor_part, $bulan)
  {
      // Panggil model untuk mengambil data pengiriman berdasarkan kriteria
      $data['list_data'] = $this->M_admin->get_delivery_by_criteria($nama_part, $nomor_part, $bulan);
      // Load view untuk menampilkan data pengiriman
      $this->load->view('user/view_delivery_by_criteria', $data);
  }  
  
  public function sum_delv($columnValue) {
    $data = $this->M_admin->sum_delv($columnValue);

    // Lakukan apa pun yang ingin Anda lakukan dengan data, misalnya kirim ke view
    $this->load->view('user/tabel/tabel_akumulasi',$data);
}

  public function update_datadelv($id_pengiriman)
  {
    $where = array('id_pengiriman' => $id_pengiriman);
    $data['data_delv_update'] = $this->M_admin->get_data_delv('tb_actual_delivery',$where);
    $data['list_bulan'] = $this->M_admin->select_bulan('bulan');
    $data['list_no_po'] = $this->M_admin->select_no_po('tb_po');
    $data['list_part_po'] = $this->M_admin->select('tb_part_po');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('user/form_datadelv/form_update',$data);
  }

  public function delete_datadelv($id_pengiriman)
  {
      // Cek apakah data dengan id_pengiriman tersebut ada di tabel tb_actual_delivery
      $where = array('id_pengiriman' => $id_pengiriman);
      $data_exists = $this->M_admin->get_data_by_id('tb_actual_delivery', $where);
  
      if ($data_exists) {
          // Ambil data pengiriman yang akan dihapus
          $delivery_data = $this->M_admin->get_data_delv('tb_actual_delivery', $where);
          
          // Hapus data dari tabel tb_actual_delivery
          $this->M_admin->delete('tb_actual_delivery', $where);
  
          // Hapus data dari tabel tb_akumulasi berdasarkan id_pengiriman
          $this->M_admin->delete('tb_akumulasi', $where);
  
          // Kembalikan stok ke kondisi semula
          foreach ($delivery_data as $delivery_item) {
              $nomor_part = $delivery_item->nomor_part;
              $nama_part = $delivery_item->nama_part;
              $pengiriman = $delivery_item->pengiriman;
              
              // Ambil data stok sebelum pengiriman
              $stok_sebelumnya = $this->M_admin->get_data_stok_by_nomor_part($nomor_part);
              
              if ($stok_sebelumnya) {
                  $data_stok_baru = $stok_sebelumnya->data_stok + $pengiriman;
                  
                  // Update data stok
                  $this->M_admin->update_data_stok($nomor_part, $data_stok_baru);
              }
          }
  
          // Redirect ke halaman tabel_datadelv setelah berhasil menghapus data
          redirect(base_url('user/cari_pengiriman'));
      } else {
          // Jika data tidak ditemukan, tampilkan pesan error atau halaman not found
          show_error('Data not found', 404);
      }
  }
  
  public function get_bulan_by_po($nomor_po)
  {
      // Gantilah "select_bulan_by_po" dengan fungsi yang benar-benar mengambil data bulan berdasarkan nomor PO dari database
      $data_bulan = $this->M_admin->select_bulan_by_po($nomor_po);
      
      // Ubah data bulan menjadi format JSON dan kirimkan sebagai respons
      echo json_encode($data_bulan);
  }


  public function input_datadelv($id_pengiriman)
  {
    $where = array('id_pengiriman' => $id_pengiriman);
    $data['data_delv_input'] = $this->M_admin->get_data_delv('tb_actual_delivery',$where);
    $data['list_bulan'] = $this->M_admin->select_bulan('bulan');
    $data['list_no_po'] = $this->M_admin->select_no_po('tb_po');
    $data['list_part_po'] = $this->M_admin->select('tb_part_po');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('user/form_datadelv/form_input',$data);
  }

  public function proses_tambah_dataDelv_insert()
{
    $this->form_validation->set_rules('id_pengiriman', 'id_pengiriman', 'required');
    // ... tambahkan aturan validasi lainnya sesuai kebutuhan

    if ($this->form_validation->run() == TRUE) {
        // Proses input data
        $id_pengiriman = $this->input->post('id_pengiriman', TRUE);
        $tanggal_masuk = $this->input->post('tanggal_masuk', TRUE);
        $nama_customer = $this->input->post('nama_customer', TRUE);
        $nomor_po      = $this->input->post('nomor_po', TRUE);
        $nomor_part    = $this->input->post('nomor_part', TRUE);
        $nama_part     = $this->input->post('nama_part', TRUE);
        $satuan        = $this->input->post('satuan', TRUE);
        $pengiriman    = $this->input->post('pengiriman', TRUE);
        $bulan         = $this->input->post('bulan', TRUE);

        $data = array(
            'id_pengiriman' => $id_pengiriman,
            'tanggal_masuk' => $tanggal_masuk,
            'nama_customer' => $nama_customer,
            'nomor_po'      => $nomor_po,
            'nomor_part'    => $nomor_part,
            'nama_part'     => $nama_part,
            'satuan'        => $satuan,
            'pengiriman'    => $pengiriman,
            'bulan'         => $bulan
        );

        // Panggil fungsi insert dengan nama tabel yang berbeda
        $this->M_admin->insert('tb_actual_delivery', $data);
        $this->M_admin->insert('tb_akumulasi', $data);

        echo '<script language="javascript">
                window.location="tabel_datadelv";
              </script>';
        exit();
    } else {
        $data['list_satuan'] = $this->M_admin->select('tb_satuan');
        $this->load->view('user/form_datadelv/form_insert', $data);
    }
}

  public function proses_tambah_dataDelv_update()
  {
      $this->form_validation->set_rules('id_pengiriman', 'id_pengiriman', 'required');
      // ... tambahkan aturan validasi lainnya sesuai kebutuhan
      
      $this->form_validation->set_rules('id_pengiriman', 'Id Purchase Order', 'required');
      $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Input', 'required');
      $this->form_validation->set_rules('nama_customer', 'Customer', 'required');
      $this->form_validation->set_rules('nomor_po', 'Nomor Purchase Order', 'required');
      $this->form_validation->set_rules('nomor_part', 'Nomor Part', 'required');
      $this->form_validation->set_rules('nama_part', 'Nama Part', 'required');
      $this->form_validation->set_rules('satuan', 'Satuan Part', 'required');
      $this->form_validation->set_rules('pengiriman', 'Actual Delivery', 'required');
      $this->form_validation->set_rules('bulan', 'Bulan', 'required');

      if ($this->form_validation->run() == TRUE) {
          $id_pengiriman = $this->input->post('id_pengiriman', TRUE);
          $tanggal_masuk = $this->input->post('tanggal_masuk', TRUE);
          $nama_customer = $this->input->post('nama_customer', TRUE);
          $nomor_po = $this->input->post('nomor_po', TRUE);
          $nomor_part = $this->input->post('nomor_part', TRUE);
          $nama_part = $this->input->post('nama_part', TRUE);
          $satuan = $this->input->post('satuan', TRUE);
          $pengiriman = $this->input->post('pengiriman', TRUE);
          $bulan = $this->input->post('bulan', TRUE);

          // Ambil nilai pengiriman lama
          $old_delivery_data = $this->M_admin->get_data_delv('tb_actual_delivery', array('id_pengiriman' => $id_pengiriman));
          $old_delivery = $old_delivery_data[0]->pengiriman;

          // Hitung selisih antara pengiriman baru dan lama
          $selisih = $pengiriman - $old_delivery;

          // Perbarui stok sesuai dengan selisih
          $stok_sebelumnya = $this->M_admin->get_data_stok_by_nomor_part($nomor_part);

          if ($stok_sebelumnya) {
              $data_stok_baru = $stok_sebelumnya->data_stok - $selisih;
              $this->M_admin->update_data_stok($nomor_part, $data_stok_baru);
          }

          // Perbarui data pengiriman setelah memperbarui stok
          $where = array('id_pengiriman' => $id_pengiriman);
          $data = array(
              'id_pengiriman' => $id_pengiriman,
              'tanggal_masuk' => $tanggal_masuk,
              'nama_customer' => $nama_customer,
              'nomor_po' => $nomor_po,
              'nomor_part' => $nomor_part,
              'nama_part' => $nama_part,
              'satuan' => $satuan,
              'pengiriman' => $pengiriman,
              'bulan' => $bulan
          );

          // Panggil fungsi update dengan nama tabel yang berbeda
          $this->M_admin->update('tb_actual_delivery', $data, $where);
          $this->M_admin->update('tb_akumulasi', $data, $where);
      
          $this->session->set_flashdata('msg_berhasil', 'Data Delivery Part Berhasil Diupdate');
          redirect(base_url('user/tabel_datadelv'));
      } else {
          $this->load->view('user/form_datadelv/form_update');
      }
  }


  public function proses_tambah_dataDelv_input()
  {
    $this->form_validation->set_rules('id_pengiriman', 'id_pengiriman', 'required');
    // ... tambahkan aturan validasi lainnya sesuai kebutuhan

    if ($this->form_validation->run() == TRUE) {
        // Proses input data
        $id_pengiriman = $this->input->post('id_pengiriman', TRUE);
        $tanggal_masuk = $this->input->post('tanggal_masuk', TRUE);
        $nama_customer = $this->input->post('nama_customer', TRUE);
        $nomor_po      = $this->input->post('nomor_po', TRUE);
        $nomor_part    = $this->input->post('nomor_part', TRUE);
        $nama_part     = $this->input->post('nama_part', TRUE);
        $satuan        = $this->input->post('satuan', TRUE);
        $pengiriman    = $this->input->post('pengiriman', TRUE);
        $bulan         = $this->input->post('bulan', TRUE);

        $data = array(
            'id_pengiriman' => $id_pengiriman,
            'tanggal_masuk' => $tanggal_masuk,
            'nama_customer' => $nama_customer,
            'nomor_po'      => $nomor_po,
            'nomor_part'    => $nomor_part,
            'nama_part'     => $nama_part,
            'satuan'        => $satuan,
            'pengiriman'    => $pengiriman,
            'bulan'         => $bulan
        );

        // Panggil fungsi insert dengan nama tabel yang berbeda
        $this->M_admin->insert('tb_actual_delivery', $data);
        $this->M_admin->insert('tb_akumulasi', $data);

        $data_pengiriman = $this->M_admin->get_data_pengiriman($id_pengiriman);

    if ($data_pengiriman) {
        $nomor_part = $data_pengiriman->nomor_part;
        $nama_part = $data_pengiriman->nama_part;
        $pengiriman = $data_pengiriman->pengiriman;

        // Ambil data stok berdasarkan nomor_part dan nama_part
        $data_stok = $this->M_admin->get_data_stok_by_nomor_part($nomor_part);

        if ($data_stok) {
            // Kurangkan nilai stok dengan jumlah pengiriman
            $data_stok_baru = $data_stok->data_stok - $pengiriman;

            // Update nilai stok
            $this->M_admin->update_data_stok($nomor_part, $data_stok_baru);}}

        echo '<script language="javascript">
                window.location="cari_pengiriman";
              </script>';
        exit();
    } else {
        $data['list_satuan'] = $this->M_admin->select('tb_satuan');
        $this->load->view('user/form_datadelv/form_input', $data);
    }
  }
  ####################################
      // END DATA ACTUAL DELIVERY
  ####################################



  ####################################
        // DATA BARANG MASUK
  ####################################

  public function tabel_barangmasuk()
  {
    $data['list_data'] = $this->M_admin->get_record_masuk('tb_actual_delivery');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('user/tabel/tabel_barangmasuk',$data);
  }


  public function downloadPDF() {
    // Load list_data
    $data['list_data'] = $this->M_admin->get_list_data('tb_actual_delivery');
    foreach ($data['list_data'] as &$dd) {
        $jumlah_data_po = $this->M_admin->get_jumlah_po($dd->nomor_po, $dd->nama_part);
        if (!empty($jumlah_data_po)) {
            $dd->jumlah_po = $jumlah_data_po[0]->jumlah;
        } else {
            $dd->jumlah_po = 0; 
        }
    }

    // Load other data
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name')); // Gantilah $data_avatar dengan data avatar yang sesuai
    $html = $this->load->view('user/tabel/tabel_akumulasi', $data, true);
    
    // Generate a unique filename for the PDF
    $pdfFileName = 'akumulasidelivery' . uniqid() . '.pdf';
    
    // Path to save the temporary HTML file
    $tempHtmlFilePath = APPPATH . 'views/temp/' . uniqid() . '.html';
    
    // Save the HTML content to a temporary file
    file_put_contents($tempHtmlFilePath, $html);
    
    // Path to save the generated PDF file
    $pdfFilePath = APPPATH . 'views/temp/' . $pdfFileName;
    
    // Set custom width and height (for example, A4 size: 210mm x 297mm)
    $customWidth = 300; // in millimeters
    $customHeight = 250; // in millimeters
    // Use shell command to convert HTML to PDF using wkhtmltopdf with custom size
    $command = "wkhtmltopdf --page-width $customWidth --page-height $customHeight $tempHtmlFilePath $pdfFilePath";
    shell_exec($command);
    
    // Delete the temporary HTML file
    unlink($tempHtmlFilePath);
    
    // Download the generated PDF file
    if (file_exists($pdfFilePath)) {
        $this->load->helper('download');
        force_download($pdfFileName, file_get_contents($pdfFilePath));
        
        // Delete the generated PDF file after download
        unlink($pdfFilePath);
    } else {
        echo "Failed to generate PDF";
    }
}

public function cari_pengiriman() {
  // Mengambil nilai input dari form
  $nama_part = $this->input->post('nama_part');
  $nomor_part = $this->input->post('nomor_part');
  $nomor_po = $this->input->post('nomor_po');
  $bulan = $this->input->post('bulan');

  // Query ke database berdasarkan kriteria pencarian
  $list_data = $this->M_admin->cari_pengiriman($nama_part, $nomor_part, $nomor_po, $bulan);
  // Mendefinisikan variabel $avatar di sini
  $avatar = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));

  // Mengambil data lainnya
  $data = array(
    'list_data' => $list_data,
    'list_bulan' => $this->M_admin->select_bulan('bulan'),
    'list_part' => $this->M_admin->select('tb_part'),
    'list_no_po' => $this->M_admin->select_no_po('tb_po'),
    'list_part_po' => $this->M_admin->select('tb_part_po'),
    'avatar' => $avatar
  );
  foreach ($data['list_data'] as &$dd) {
    $jumlah_data_po = $this->M_admin->get_jumlah_po($dd->nomor_po, $dd->nama_part);
    if (!empty($jumlah_data_po)) {
        $dd->jumlah_po = $jumlah_data_po[0]->jumlah;
    } else {
        $dd->jumlah_po = 0; 
    }
  }
  // Menampilkan hasil pencarian ke view yang sesuai
  $this->load->view('user/detail_pengiriman', $data);
}

public function cari_po()
{
    // Mengambil nilai input dari form
    $nama_part = $this->input->post('nama_part');
    $nomor_part = $this->input->post('nomor_part');
    $nomor_po = $this->input->post('nomor_po');
    $bulan = $this->input->post('bulan');

    // Query ke database berdasarkan kriteria pencarian
    $list_data = $this->M_admin->cari_pengiriman_po($nama_part, $nomor_part, $nomor_po, $bulan);

    // Mendefinisikan variabel $avatar di sini
    $avatar = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));

    // Mengambil data lainnya
    $data = array(
        'list_data' => $list_data,
        'list_no_po' => $this->M_admin->select_no_po('tb_po'),
        'list_part' => $this->M_admin->select('tb_part'),
        'list_part_po' => $this->M_admin->select('tb_part_po'),
        'avatar' => $avatar
    );

    // Menampilkan hasil pencarian ke view yang sesuai
    $this->load->view('user/tabel/tabel_datapo', $data);
}

public function cari_akumulasi()
{
    // Mengambil nilai input dari form
    $nama_part = $this->input->post('nama_part');
    $nomor_part = $this->input->post('nomor_part');
    $nomor_po = $this->input->post('nomor_po');
    $bulan = $this->input->post('bulan');

    // Query ke database berdasarkan kriteria pencarian
    $list_data = $this->M_admin->cari_pengiriman_po($nama_part, $nomor_part, $nomor_po, $bulan);

    // Mendefinisikan variabel $avatar di sini
    $avatar = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('name'));


    
    // Mengambil data lainnya
    $data = array(
        'list_data' => $list_data,
        'list_no_po' => $this->M_admin->select_no_po('tb_po'),
        'list_part' => $this->M_admin->select('tb_part'),
        'list_part_po' => $this->M_admin->select('tb_part_po'),
        'avatar' => $avatar
    );

    // Menampilkan hasil pencarian ke view yang sesuai
    $this->load->view('user/tabel/tabel_akumulasi', $data);
}


public function update_pengiriman($id_pengiriman)
{
  $where = array('id_pengiriman' => $id_pengiriman);
  $data['data_delv_update'] = $this->M_admin->get_data_delv('tb_actual_delivery',$where);
  $data['list_bulan'] = $this->M_admin->select_bulan('bulan');
  $data['list_data'] = $this->M_admin->get_record_datadelv('tb_actual_delivery');
  $data['list_no_po'] = $this->M_admin->select_no_po('tb_po');
  $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
  $this->load->view('user/detail_pengiriman',$data);
}

public function delete_pengiriman($id_pengiriman)
{
    // Cek apakah data dengan id_pengiriman tersebut ada di tabel tb_actual_delivery
    $where = array('id_pengiriman' => $id_pengiriman);
    $data_exists = $this->M_admin->get_data_by_id('tb_actual_delivery', $where);

    if ($data_exists) {
        // Hapus data dari tabel tb_actual_delivery
        $this->M_admin->delete('tb_actual_delivery', $where);

        // Hapus data dari tabel tb_akumulasi berdasarkan id_pengiriman
        $this->M_admin->delete('tb_akumulasi', $where);

        // Redirect ke halaman tabel_datadelv setelah berhasil menghapus data
        redirect(base_url('user/detail_pengiriman'));
    } else {
        // Jika data tidak ditemukan, tampilkan pesan error atau halaman not found
        show_error('Data not found', 404);
    }
}
}
?>
