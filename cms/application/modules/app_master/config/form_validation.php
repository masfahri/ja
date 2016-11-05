<?php

/***********************************************************
@author Raka Anggala W.S
@date 21/06/2014
@desc Configuration form validation field
      This config will use for every form submit
***********************************************************/
$config = array(
          'app_master' => array(
           array(
                    'field' => 'nip',
                    'label' => 'NIP',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),          
           array(
                    'field' => 'id_finger',
                    'label' => 'ID Fingerprint',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
           array(
                    'field' => 'nama',
                    'label' => 'Nama Guru',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
           array(
                    'field' => 'pasword',
                    'label' => 'Password',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),                            
           array(
                    'field' => 'file',
                    'label' => 'Foto Guru',
                    'rules' => 'xss_clean'
                 )  

            ),
          'jurusan' => array(
           array(
                    'field' => 'nama',
                    'label' => 'Nama Jurusan',
                    'rules' => 'required|max_length[50]|xss_clean'
                 )

            ),
          'kelas' => array(
           array(
                    'field' => 'Nama_Kelas',
                    'label' => 'Kelas',
                    'rules' => 'required|max_length[50]|xss_clean'
                 )           

            ),
          'siswa' => array(
           array(
                    'field' => 'nis',
                    'label' => 'NIS',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),           
           array(
                    'field' => 'id_finger',
                    'label' => 'ID Finger',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
           array(
                    'field' => 'absen',
                    'label' => 'Nomor Absen',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
           array(
                    'field' => 'nama_panggilan',
                    'label' => 'Nama Panggilan',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
           array(
                    'field' => 'nama_siswa',
                    'label' => 'Nama Siswa',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ), 
           array(
                    'field' => 'kelamin',
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
           array(
                    'field' => 'tempat_lahir',
                    'label' => 'Tempat Lahir',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
           array(
                    'field' => 'tgl_lahir',
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
           array(
                    'field' => 'agama',
                    'label' => 'Agama',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
           array(
                    'field' => 'id_kelas',
                    'label' => 'Kelas',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),                                                                                                                                      
            ),
          'karyawan' => array(
           array(
                    'field' => 'nup',
                    'label' => 'NUP',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),           
           array(
                    'field' => 'id_finger',
                    'label' => 'ID Finger',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
           array(
                    'field' => 'nama',
                    'label' => 'Nama Karyawan',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ), 
           array(
                    'field' => 'kelamin',
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
           array(
                    'field' => 'tempat_lahir',
                    'label' => 'Tempat Lahir',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
           array(
                    'field' => 'tgl_lahir',
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),
           array(
                    'field' => 'agama',
                    'label' => 'Agama',
                    'rules' => 'required|max_length[50]|xss_clean'
                 ),                                                                                                                                   
            )                                    

        )
?>