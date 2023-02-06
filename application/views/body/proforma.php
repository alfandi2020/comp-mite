<br><br><br>
<main id="main">
<section id="hero" class="d-flex align-items-center">
   <div class="container">
      <div class="row">
         <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Disclaimer!</h4>
            <p>The following price simulation is an estimated price. For more details, please contact our marketing. Thank you.</p>
            <!-- <hr>
            <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p> -->
         </div>
      </div>
      <div class="row">
         <!-- <div class="col-lg-4 d-flex flex-column justify-content-center">
            <h1 style="font-size: 25px;" data-aos="fade-up">PT MITRA ELANG NIAGA INDONESIA</h1>
            <h2 data-aos="fade-up" data-aos-delay="400">The line between disorder and order lies in logistics
            </h2>
            <div data-aos="fade-up" data-aos-delay="600">
            <div class=" text-lg-start"> <a href="#about"
                  class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Contact Us</span> <i class="bi bi-arrow-right"></i> </a></div>
            </div>
         </div> -->
         <div class="col-lg-12" data-aos="zoom-out" data-aos-delay="200"> 
            <!-- <img src="<?= base_url() ?>assets/img/h1.png" class="img-fluid" alt=""> -->
            <h3>Simulasi Harga</h3>
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>No.</th>
                     <!-- <th>Airline</th> -->
                     <th>Berangkat</th>
                     <th>Tujuan</th>
                     <th>Harga</th>
                     <th>Berat</th>
                     <th>Koli</th>
                     <th>Total</th>
                     <th>Rincian</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  $no = 1;
                  if(count($pricelist) > 0) {
                     foreach ($pricelist as $key => $p) {
                        if ($p->maskapai_id == "LAG") {
                           $maskapai = "Lion Air Group";
                        } else if ($p->maskapai_id == "CTL") {
                           $maskapai = "Citilink";
                        } else if ($p->maskapai_id == "GIA") {
                           $maskapai = "Garuda Indonesia";
                        }
                        ?>
                        <tr>
                           <td><?= $no ?>.</td>
                           <!-- <td><?= $maskapai?></td> -->
                           <td><?php
                           $get_des = $this->db->get_where('mite_destinasi',['kode_destinasi' => $p->origin])->row_array();
                           $get_des2 = $this->db->get_where('mite_destinasi',['kode_destinasi' => $p->destinasi])->row_array();
                           echo $get_des['kode_destinasi'] . ' ('.$get_des['destinasi'].')';
                           ?></td>
                           <td><?php
                           echo $get_des2['kode_destinasi'] . ' ('.$get_des2['destinasi'].')';
                            ?></td>
                           <td align=right>Rp <?php 
                           $this->db->where('nama_inggris',$this->input->get('inputProduct'));
			                     $get_product = $this->db->get('jenis_product')->row_array();
                                 if($this->input->get('inputProduct') == $get_product['nama_inggris']){
                                    $tambah_charge = $get_product['handling'];
                                 }else{
                                    $tambah_charge = 0;
                                 }
                          echo number_format(intval($p->all_in) + intval($tambah_charge),2) ?></td>
                           <td align=right><?= $this->input->get('inputWeight') ?></td>
                           <td align=right><?= $this->input->get('inputKoli') ?></td>
                           <td align=right>Rp <?php 
                           $weight = intval($this->input->get('inputWeight'));
                           $xx = intval($p->all_in) + $tambah_charge;
                          echo number_format($xx * $weight,2) ?></td>
                           <td align=center>
                              <?php if ($this->session->userdata('id_user') == true) { ?>
                                 <button class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#demo<?= $p->id ?>" class="accordion-toggle">
                                    Rincian 
                                 </button>
                              <?php } ?>
                              <b id="<?= $p->id.",".$this->input->get('inputWeight').",". $this->input->get('inputKoli') . "," . $this->input->get('inputProduct') ?>" class="btn btn-primary btn-sm booking">Pesan Sekarang!</b>
                              <!-- href="https://menindo.com/dash/booking/b/<?= $p->id?>" -->
                           </td>
                        </tr>
                        <tr>
                           <td colspan=10 style="padding: 0 !important;">
                              <div class="accordian-body collapse" id="demo<?= $p->id ?>">
                                 <table class="table table-bordered">
                                    <thead>
                                       <tr>
                                          <th>Deskripsi</th>
                                          <th>Berat</th>
                                          <th>Harga per unit</th>
                                          <th>Subtotal</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                                       $this->db->where('id', $p->id);
                                       $a = $this->db->get('mite_pricelist')->row_array();
                                       $weight = $this->input->get('inputWeight');
                                       $s_smu_basic = $a['smu_basic'] * $weight;
                                       $s_ppn_smu = $s_smu_basic * 0.11;

                                       $s_ra = $a['r_a'] * $weight;
                                       $s_warehouse = $a['warehouse'] * $weight;
                                       $s_ihc = $a['ihc'] * $weight;
                                       $s_handling = $a['handling'] * $weight;

                                       $s_grandtotal = $s_smu_basic + $s_ppn_smu + $s_ra + $s_warehouse + $s_ihc + $s_handling;

                                       $s_grandtotal2 = $a['all_in'] * $weight;
                                       ?>
                                       <tr>
                                          <td>SMU Basic</td>
                                          <td align=right><?= number_format($weight) ?> kgs</td>
                                          <td align=right>Rp <?= number_format($a['smu_basic'])?></td>
                                          <td align=right>Rp <?=number_format($s_smu_basic)?></td>
                                       </tr>
                                       <tr>
                                          <td>PPN SMU (11%)</td>
                                          <td colspan=2></td>
                                          <td align=right>Rp <?=number_format($s_ppn_smu)?></td>
                                       </tr>
                                       <tr>
                                          <td>Regulated Agent</td>
                                          <td align=right><?= number_format($weight) ?> kgs</td>
                                          <td align=right>Rp <?= number_format($a['r_a'])?></td>
                                          <td align=right>Rp <?=number_format($s_ra)?></td>
                                       </tr>
                                       <tr>
                                          <td>Warehouse</td>
                                          <td align=right><?= number_format($weight) ?> kgs</td>
                                          <td align=right>Rp <?= number_format($a['warehouse'])?></td>
                                          <td align=right>Rp <?=number_format($s_warehouse)?></td>
                                       </tr>
                                       <tr>
                                          <td>IHC</td>
                                          <td align=right><?= number_format($weight) ?> kgs</td>
                                          <td align=right>Rp <?= number_format($a['ihc'])?></td>
                                          <td align=right>Rp <?=number_format($s_ihc)?></td>
                                       </tr>
                                       <tr>
                                          <td>Handling Charges - Per Kg (Incl. Print Label)</td>
                                          <td align=right><?= number_format($weight) ?> kgs</td>
                                          <td align=right>Rp <?= number_format($a['handling'])?></td>
                                          <td align=right>Rp <?=number_format($s_handling)?></td>
                                       </tr>
                                       <tr>
                                          <th colspan=3>Grandtotal</th>
                                          <td align=right>Rp <?=number_format($s_grandtotal)?></td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </td>
                        </tr>
                        <?php 
                        $no++;
                     } 
                  } else {
                     redirect();
                  }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</section>
</main>