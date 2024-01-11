<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

  public function __construct(){
		parent::__construct();
    $this->load->model('M_admin');
    $this->load->library('upload');
	}

  public function index(){
    if($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 1){
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
      $data['DataPO'] = $this->M_admin->sum('tb_po','jumlah');    
      $data['DeliveryPart'] = $this->M_admin->sum('tb_actual_delivery','pengiriman');    
      $data['dataUser'] = $this->M_admin->numrows('user');
      $this->load->view('admin/index',$data);
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
    $this->load->view('admin/profile',$data);
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
            'password' => $this->hash_password($new_password)
        );

        $where = array(
            'id_user' =>$this->session->userdata('id_user')
        );

        $this->M_admin->update_password('user',$where,$data);

        $this->session->set_flashdata('msg_berhasil','Password Telah Diganti');
        redirect(base_url('admin/profile'));
      }
    }else {
      $this->load->view('admin/profile');
    }
  }

  public function proses_gambar_upload()
  {
    $config =  array(
                   'upload_path'     => "./assets/upload/user/img/",
                   'allowed_types'   => "gif|jpg|png|jpeg",
                   'encrypt_name'    => False, 
                   'max_size'        => "50000",  
                   'max_height'      => "9680",
                   'max_width'       => "9024"
                 );
      $this->load->library('upload',$config);
      $this->upload->initialize($config);

      if( ! $this->upload->do_upload('userpicture'))
      {
        $this->session->set_flashdata('msg_error_gambar', $this->upload->display_errors());
        $this->load->view('admin/profile');
      }else{
        $upload_data = $this->upload->data();
        $nama_file = $upload_data['file_name'];
        $ukuran_file = $upload_data['file_size'];

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
          $this->load->view('admin/profile',$data);
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
        redirect(base_url('admin/profile'));
      }
  }

  ####################################
           // End Profile
  ####################################

  public function form_customer()
  {
    $data['list_data'] = $this->M_admin->select('customer');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_customer/form_insert',$data);
  }

  public function proses_tambah_dataCust_insert()
  {
    $this->form_validation->set_rules('nama_customer','Nama Customer','required');

    $nama_customer = $this->input->post('nama_customer');
    $sql = $this->db->query("SELECT nama_customer FROM customer WHERE nama_customer='$nama_customer'");
    $cek_kode = $sql->num_rows();

    if($cek_kode > 0) {
      echo '<script language="javascript">
              window.alert("Tidak Bisa Menambahkan Data Barang! \n Id Part Sudah Terdaftar Di Database!");
              window.location="form_customer";
            </script>';
      exit();

    } else if ($this->form_validation->run() == TRUE) {
      $nama_customer = $this->input->post('nama_customer',TRUE);

      $data = array(
            'nama_customer'         => $nama_customer
      );

      $this->M_admin->insert('customer',$data);

      echo '<script language="javascript">
              window.location="form_customer";
            </script>';
      exit();

    } else {
      $data['list_satuan'] = $this->M_admin->select('tb_satuan');
      $this->load->view('admin/form_customer/form_insert',$data);
    }
  }
  public function tabel_customer()
  {
    $data = array(
    'list_data' => $this->M_admin->get_record_customer('customer'),
    'avatar' => $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'))
    );
        $this->load->view('admin/form_customer/form_insert',$data);
      }

  public function delete_customer($id_customer)
  {
          // Panggil model untuk menghapus customer berdasarkan ID
          $this->M_admin->delete_customer($id_customer);
  
          // Redirect kembali ke halaman customer setelah menghapus
          redirect(base_url('admin/form_customer'));
  }
      
  
  ####################################
        // DATA PART CUSTOMER
  ####################################

  public function form_datapart()
  {
    $data['list_customer'] = $this->M_admin->select('customer');
    $data['list_bulan'] = $this->M_admin->select_bulan('bulan');
    $data['list_no_po'] = $this->M_admin->select_no_po('tb_po');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_datapart/form_insert',$data);
  }

  public function tabel_datapart()
  {
    $data = array(
              'list_data' => $this->M_admin->get_record_stok('tb_part'),
              'avatar'    => $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'))
            );
    $this->load->view('admin/tabel/tabel_datapart',$data);
  }
  public function tabel_akumulasi()
  {
    $data = array(
      'list_data' => $this->M_admin->get_list_data('tb_actual_delivery'),
      'avatar'    => $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name')),
      'results' => $this->M_admin->get_akumulasi() 
    );
    foreach ($data['list_data'] as &$dd) {
      $jumlah_data_po = $this->M_admin->get_jumlah_po($dd->nomor_po, $dd->nama_part);
      if (!empty($jumlah_data_po)) {
          $dd->jumlah_po = $jumlah_data_po[0]->jumlah;
      } else {
          $dd->jumlah_po = 0; 
      }
    }
      $this->load->view('admin/tabel/tabel_akumulasi',$data);
  }

  public function tabel_datadelv()
  {
    $data = array(
              'list_data' => $this->M_admin->get_record_datadelv('tb_actual_delivery'),    
              'list_bulan' => $this->M_admin->select_bulan('bulan'),
              'list_part' => $this->M_admin->select('tb_part'),
              'list_part_po' => $this->M_admin->select('tb_part_po'),
              'avatar'    => $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'))
            );
    $this->load->view('admin/tabel/tabel_datadelv',$data);
  }

  public function update_datapart($id_part)
  {
    $where = array('id_part' => $id_part);
    $data['data_part_update'] = $this->M_admin->get_data('tb_part',$where);
    $data['list_customer'] = $this->M_admin->select('customer');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_datapart/form_update',$data);
  }

  public function delete_datapart($id_part)
  {
    $where = array('id_part' => $id_part);
    $this->M_admin->delete('tb_part',$where);
    redirect(base_url('admin/tabel_datapart'));
  }

  public function input_datapart($id_part)
  {
    $where = array('id_part' => $id_part);
    $data['data_part_input'] = $this->M_admin->get_data('tb_part',$where);
    $data['list_satuan'] = $this->M_admin->select('tb_satuan');
    $data['list_bulan'] = $this->M_admin->select_bulan('bulan');
    $data['list_no_po'] = $this->M_admin->select_no_po('tb_po');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_datapo/form_insert',$data);
  }

  public function proses_tambah_dataPart_insert()
  {
    $this->form_validation->set_rules('id_part','Id Part','required');
    $this->form_validation->set_rules('nama_customer','Customer','required');
    $this->form_validation->set_rules('nomor_part','Nomor Part','required');
    $this->form_validation->set_rules('nama_part','Nama Part','required');

    $id_part = $this->input->post('id_part');
    $sql = $this->db->query("SELECT id_part FROM tb_part WHERE id_part='$id_part'");
    $cek_kode = $sql->num_rows();

    if($cek_kode > 0) {
      echo '<script language="javascript">
              window.alert("Tidak Bisa Menambahkan Data Barang! \n Id Part Sudah Terdaftar Di Database!");
              window.location="form_datapart";
            </script>';
      exit();

    } else if ($this->form_validation->run() == TRUE) {
      $id_part = $this->input->post('id_part',TRUE);
      $nomor_part  = $this->input->post('nomor_part',TRUE);
      $nama_part  = $this->input->post('nama_part',TRUE);
      $customer     = $this->input->post('nama_customer',TRUE);

      $data = array(
            'id_part'         => $id_part,
            'nomor_part'      => $nomor_part,
            'nama_part'       => $nama_part,
            'nama_customer'   => $customer
      );

      $this->M_admin->insert('tb_part',$data);

      echo '<script language="javascript">
              window.location="tabel_datapart";
            </script>';
      exit();

    } else {
      $data['list_satuan'] = $this->M_admin->select('tb_satuan');
      $this->load->view('admin/form_datapart/form_insert',$data);
    }
  }

  public function proses_tambah_dataPart_update()
  {
    $this->form_validation->set_rules('id_part','Id Part','required');
    $this->form_validation->set_rules('nama_customer','Nama Customer','required');
    $this->form_validation->set_rules('nomor_part','Nomor Part','required');
    $this->form_validation->set_rules('nama_part','Nama Part','required');

    if($this->form_validation->run() == TRUE)
    {
      $id_part = $this->input->post('id_part',TRUE);
      $nama_customer = $this->input->post('nama_customer',TRUE);
      $nomor_part  = $this->input->post('nomor_part',TRUE);
      $nama_part  = $this->input->post('nama_part',TRUE);

      $where = array('id_part' => $id_part);
      $data = array(
            'id_part' => $id_part,
            'nama_customer' => $nama_customer,
            'nomor_part'  => $nomor_part,
            'nama_part'  => $nama_part
      );
      $this->M_admin->update('tb_part',$data,$where);
      $this->session->set_flashdata('msg_berhasil','Data Part Berhasil Diupdate');
      redirect(base_url('admin/tabel_datapart'));
    }else{
      $this->load->view('admin/form_datapart/form_update');
    }
  }
  ####################################
      // END DATA PART CUSTOMER
  ####################################

  ####################################
        // DATA PURCHASE ORDER
  ####################################

  public function form_datapo()
  {
    $data['list_satuan'] = $this->M_admin->select('tb_satuan');
    $data['list_bulan'] = $this->M_admin->select_bulan('bulan');
    $data['list_no_po'] = $this->M_admin->select_no_po('tb_po');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_datapo/form_insert',$data);
  }

  public function tabel_datapo()
  {
    $data = array(
              'list_data' => $this->M_admin->get_record_stok_po('tb_po'),
              'avatar'    => $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'))
            );
    $this->load->view('admin/tabel/tabel_datapo',$data);
  }

  public function update_data_po($id_po)
  {
    $where = array('id_po' => $id_po);
    $data['data_po_update'] = $this->M_admin->get_data_po('tb_po',$where);
    $data['list_no_po'] = $this->M_admin->select_no_po('tb_po');
    $data['list_bulan'] = $this->M_admin->select_bulan('bulan');
    $data['list_satuan'] = $this->M_admin->select('tb_satuan');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_datapo/form_update',$data);
  }
  public function input_datapo($id_po)
  {
    $where = array('id_po' => $id_po);
    $data['data_po_input'] = $this->M_admin->get_data_po('tb_po',$where);
    $data['list_no_po'] = $this->M_admin->select_no_po('tb_po');
    $data['list_bulan'] = $this->M_admin->select_bulan('bulan');
    $data['list_satuan'] = $this->M_admin->select('tb_satuan');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_datapo/form_input',$data);
  }

  public function delete_data_po($id_po)
  {
    $where = array('id_po' => $id_po);
    $this->M_admin->delete('tb_po',$where);

    $where_part_po = array('nomor_po' => $id_po);
    $this->M_admin->delete('tb_part_po', $where_part_po);
    
    redirect(base_url('admin/cari_po'));
  }

  public function proses_tambah_dataPo_insert()
  {
    $this->form_validation->set_rules('id_po','Id Purchase Order','required');
    $this->form_validation->set_rules('bulan','Bulan Purchase Order','required');
    $this->form_validation->set_rules('tanggal_masuk','Tanggal Input','required');
    $this->form_validation->set_rules('nama_customer','Customer','required');
    $this->form_validation->set_rules('nomor_po','Nomor Purchase Order','required');
    $this->form_validation->set_rules('nomor_part','Nomor Part','required');
    $this->form_validation->set_rules('nama_part','Nama Part','required');
    $this->form_validation->set_rules('satuan','Satuan Part','required');
    $this->form_validation->set_rules('jumlah','Qty Purchase Order','required');
    $this->form_validation->set_rules('harga','Harga Part','required');
    $this->form_validation->set_rules('keterangan','Keterangan');

    $id_po = $this->input->post('id_po');
    $sql = $this->db->query("SELECT id_po FROM tb_po WHERE id_po='$id_po'");
    $cek_kode = $sql->num_rows();

    if($cek_kode > 0) {
      echo '<script language="javascript">
              window.alert("Tidak Bisa Menambahkan Data Barang! \n Id Purchase Order Sudah Terdaftar Di Database!");
              window.location="form_datapo";
            </script>';
      exit();

    } else if ($this->form_validation->run() == TRUE) {
      $id_po = $this->input->post('id_po',TRUE);
      $bulan = $this->input->post('bulan',TRUE);
      $tanggal_masuk = $this->input->post('tanggal_masuk',TRUE);
      $nama_customer     = $this->input->post('nama_customer',TRUE);
      $nomor_po  = $this->input->post('nomor_po',TRUE);
      $nomor_part  = $this->input->post('nomor_part',TRUE);
      $nama_part  = $this->input->post('nama_part',TRUE);
      $satuan     = $this->input->post('satuan',TRUE);
      $jumlah    = $this->input->post('jumlah',TRUE);
      $harga     = $this->input->post('harga',TRUE);
      $keterangan     = $this->input->post('keterangan',TRUE);

      $data = array(
            'id_po'         => $id_po,
            'bulan'         => $bulan,
            'tanggal_masuk'         => $tanggal_masuk,
            'nama_customer'         => $nama_customer,
            'nomor_po'      => $nomor_po,
            'nomor_part'      => $nomor_part,
            'nama_part'       => $nama_part,
            'satuan'   => $satuan,
            'jumlah'   => $jumlah,
            'harga'   => $harga,
            'keterangan'   => $keterangan
      );

      $this->M_admin->insert('tb_po', $data);

        // Insert data ke tb_part_po
        $data_part_po = array(
            'nomor_po' => $nomor_po,
            'bulan' => $bulan
        );

        $this->M_admin->insert('tb_part_po', $data_part_po);

        echo '<script language="javascript">
                  window.location="tabel_datapo";
                </script>';
        exit();
    } else {
        $data['list_satuan'] = $this->M_admin->select('tb_satuan');
        $this->load->view('admin/form_datapo/form_insert', $data);
    }
  }

  public function proses_tambah_dataPo_update()
  {
    $this->form_validation->set_rules('id_po','Id Purchase Order','required');
    $this->form_validation->set_rules('bulan','Bulan Purchase Order','required');
    $this->form_validation->set_rules('tanggal_masuk','Tanggal Input','required');
    $this->form_validation->set_rules('nama_customer','Customer','required');
    $this->form_validation->set_rules('nomor_po','Nomor Purchase Order','required');
    $this->form_validation->set_rules('nomor_part','Nomor Part','required');
    $this->form_validation->set_rules('nama_part','Nama Part','required');
    $this->form_validation->set_rules('satuan','Satuan Part','required');
    $this->form_validation->set_rules('jumlah','Qty Purchase Order','required');
    $this->form_validation->set_rules('harga','Harga Part','required');
    $this->form_validation->set_rules('keterangan','Keterangan');

    if($this->form_validation->run() == TRUE)
    {
      $id_po = $this->input->post('id_po',TRUE);
      $bulan = $this->input->post('bulan',TRUE);
      $tanggal_masuk = $this->input->post('tanggal_masuk',TRUE);
      $nama_customer     = $this->input->post('nama_customer',TRUE);
      $nomor_po  = $this->input->post('nomor_po',TRUE);
      $nomor_part  = $this->input->post('nomor_part',TRUE);
      $nama_part  = $this->input->post('nama_part',TRUE);
      $satuan     = $this->input->post('satuan',TRUE);
      $jumlah    = $this->input->post('jumlah',TRUE);
      $harga     = $this->input->post('harga',TRUE);
      $keterangan     = $this->input->post('keterangan',TRUE);

      $where = array('id_po' => $id_po);
      $data = array(
              'id_po'         => $id_po,
              'bulan'         => $bulan,
              'tanggal_masuk'         => $tanggal_masuk,
              'nama_customer'         => $nama_customer,
              'nomor_po'      => $nomor_po,
              'nomor_part'      => $nomor_part,
              'nama_part'       => $nama_part,
              'satuan'   => $satuan,
              'jumlah'   => $jumlah,
              'harga'   => $harga,
              'keterangan'   => $keterangan
      );
      $this->M_admin->update('tb_po',$data,$where);
      $this->session->set_flashdata('msg_berhasil','Data Purchase Order Berhasil Diupdate');
      redirect(base_url('admin/cari_po'));
    }else{
      $this->load->view('admin/form_datapo/form_update');
    } 
  }

  public function proses_tambah_dataPO_input()
  {
    $this->form_validation->set_rules('id_po', 'id_po','required');

    if ($this->form_validation->run() == TRUE) {
        $id_po         = $this->input->post('id_po', TRUE);
        $bulan         = $this->input->post('bulan',TRUE);
        $tanggal_masuk = $this->input->post('tanggal_masuk', TRUE);
        $nama_customer = $this->input->post('nama_customer', TRUE);
        $nomor_po      = $this->input->post('nomor_po', TRUE);
        $nomor_part    = $this->input->post('nomor_part', TRUE);
        $nama_part     = $this->input->post('nama_part', TRUE);
        $satuan        = $this->input->post('satuan', TRUE);
        $jumlah        = $this->input->post('jumlah', TRUE);
        $harga         = $this->input->post('harga', TRUE);
        $keterangan    = $this->input->post('keterangan', TRUE);

        $data = array(
            'id_po' => $id_po,
            'bulan'         => $bulan,
            'tanggal_masuk' => $tanggal_masuk,
            'nama_customer' => $nama_customer,
            'nomor_po'      => $nomor_po,
            'nomor_part'    => $nomor_part,
            'nama_part'     => $nama_part,
            'satuan'        => $satuan,
            'jumlah'         => $jumlah,
            'harga'         => $harga,
            'keterangan'         => $keterangan
        );

        $this->M_admin->insert('tb_po', $data);

        echo '<script language="javascript">
                window.location="cari_po";
              </script>';
        exit();
    } else {
        $data['list_satuan'] = $this->M_admin->select('tb_satuan');
        $this->load->view('admin/form_datapo/form_input', $data);
    }
  }
  ####################################
      // END DATA PURCHASE ORDER
  ####################################

  ####################################
        // DATA BARANG MASUK
  ####################################

  public function tabel_barangmasuk()
  {
    $data['list_data'] = $this->M_admin->get_record_masuk('tb_po');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/tabel/tabel_barangmasuk',$data);
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
    'list_part_po' => $this->M_admin->select('tb_part_po'),
    'list_no_po' => $this->M_admin->select_no_po('tb_po'),
    'avatar' => $avatar
  );

  // Menampilkan hasil pencarian ke view yang sesuai
  $this->load->view('admin/tabel/tabel_datadelv', $data);
}

public function cari_po() {
  // Mengambil nilai input dari form
  $nama_part = $this->input->post('nama_part');
  $nomor_part = $this->input->post('nomor_part');
  $nomor_po = $this->input->post('nomor_po');
  $bulan = $this->input->post('bulan');

  // Query ke database berdasarkan kriteria pencarian
  $list_data = $this->M_admin->cari_pengiriman_data_po($nama_part, $nomor_part, $nomor_po, $bulan);
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
  $this->load->view('admin/detail_pengiriman', $data);
}

}
?>
