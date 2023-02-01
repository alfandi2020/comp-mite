<footer id="footer" class="footer">
    <!-- <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 text-center">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
          </div>
          <div class="col-lg-6">
            <form action="" method="post"> <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div> -->
    <!-- <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info"> <a href="index.html" class="logo d-flex align-items-center"> <img
                src="<?= base_url() ?>assets/img/mite.png" alt=""> </a>
            <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies
              darta donna mare fermentum iaculis eu non diam phasellus.</p>
            <div class="social-links mt-3">  -->
                <!-- <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>  -->
                <!-- <a href="#"
                class="facebook"><i class="bi bi-facebook"></i></a> -->
                 <!-- <a href="#" class="instagram"><i
                  class="bi bi-instagram"></i></a>  -->
                  <!-- <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a> -->
                <!-- </div>
          </div>
          <div class="col-lg-2 col-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Contact Us</h4>
            <p> A108 Adam Street <br> New York, NY 535022<br> United States <br><br> <strong>Phone:</strong> +1 5589
              55488 55<br> <strong>Email:</strong> <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                data-cfemail="6e070008012e0b160f031e020b400d0103">[email&#160;protected]</a><br></p>
          </div>
        </div>
      </div>
    </div> -->
    <div class="container">
      <div class="copyright"> &copy; Copyright. All Rights Reserved Menindo</div>
      <!-- <div class="credits"> Designed by BootstrapMade</div> -->
    </div>
  </footer> <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>
  <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?= base_url() ?>assets/vendor/aos/aos.js"></script>
  <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/php-email-form/validate.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="<?= base_url() ?>assets/js/main.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script async src='https://www.googletagmanager.com/gtag/js?id=G-P7JSYB1CSP'></script>
  <script>
    $(document).ready(function() {
      $(".booking").on('click', function (eventx) {
        eventx.preventDefault();
	      var id_book = this.id;
        <?php if ($this->session->userdata('id_user') == true) { ?>
          Swal.fire({
            title: 'Yakin ingin booking ?',
            // text : id_book,
            showCancelButton: true,
            confirmButtonText: 'Yes',
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: "booking",
                type: "POST",
                data: {id_booking: id_book},
                dataType: "json",
                success: function (data) {
                  if (data.status == 200) {
                    Swal.fire({
                      icon: 'success',
                      title: 'Berhasil...',
                      text: data.msg,
                    }).then((result2) => {
                      if (result2.isConfirmed == true) {
                        // window.location.replace('<?php
                        //   $params = 'inputProduct='.$_GET['inputProduct'].'&inputOrigin='.$_GET['inputOrigin'].'&inputDest='.$_GET['inputDest'].'&inputWeight='.$_GET['inputWeight'].'&inputKoli='.$_GET['inputKoli'];
                        //   base_url('home/proforma?'.$params.'') ?>');
                        window.location.replace('https://menindo.com/dash/dashboard');
                      }
                      window.location.replace('https://menindo.com/dash/pricelist/topup');
                    })
                  }else if(data.status == 303){
                      Swal.fire({
                        icon: 'info',
                        title: 'Opsss...',
                        text: data.msg,
                      }).then((result2) => {
                        if (result2.isConfirmed == true) {
                          window.location.replace('https://menindo.com/dash/pricelist/topup');
                        }
                        window.location.replace('https://menindo.com/dash/pricelist/topup');
                      })
                  }
                },
                error: function(err){
                  Swal.fire('error')
                }

              });
            } 
          })
        <?php }else{ ?>
          (async () => {
            const { value: formValues } = await Swal.fire({
              title: 'Login',
              text: 'silahkan login terlebih dahulu',
              html:
                '<input id="username" placeholder="Username" class="swal2-input">' +
                '<input id="password" placeholder="Password" class="swal2-input">',
              focusConfirm: false,
              showCancelButton: true,
              confirmButtonText: 'Login',
              preConfirm: () => {

                return [
                  document.getElementById('username').value,
                  document.getElementById('password').value
                ]
              }
            })
            if (formValues) {

              $.ajax({
                url: "login",
                type: "POST",
                data: {username: formValues[0],password:formValues[1]},
                dataType: "json",
                success: function (data) {
                  if (data.status == 200) {
                    Swal.fire({
                      icon: 'success',
                      title: 'Berhasil...',
                      text: data.msg,
                    }).then((result2) => {
                      if (result2.isConfirmed == true) {
                        window.location.replace('<?php
                          $params = 'inputProduct='.$_GET['inputProduct'].'&inputOrigin='.$_GET['inputOrigin'].'&inputDest='.$_GET['inputDest'].'&inputWeight='.$_GET['inputWeight'].'';
                          base_url('home/proforma?'.$params.'') ?>');
                      }
                      window.location.replace('<?= base_url('home/proforma?'.$params.'') ?>');
                    })
                  }else if(data.status == 400){
                    Swal.fire({
                      icon: 'error',
                      title: 'Opss...',
                      text: data.msg,
                    })
                  }else if (data.status == 305) {
                    Swal.fire({
                      icon: 'error',
                      title: 'Opss...',
                      text: data.msg,
                    })
                  }
                },
                error: function(err){
                  Swal.fire('error')
                }

              });
              // Swal.fire(formValues[1])
            }
          })()
        <?php } ?>
      })
    });

    if (window.self == window.top) {
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'G-P7JSYB1CSP');
    }
  </script>
  <script>
    function onlyNumberKey(evt) {
          
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
    </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
</body>

</html>