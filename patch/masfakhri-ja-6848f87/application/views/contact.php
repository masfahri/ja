<section>
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <div class="icon-box-small"><i class="icon-map"></i>
              <hr>
              <h4>Address</h4>
              <p><span><?php echo $datadb['contact_office'] ?></span>
              </p>
            </div>
            <!-- end of icon box-->
          </div>
          <div class="col-sm-4">
            <div class="icon-box-small"><i class="icon-phone"></i>
              <hr>
              <h4>Phones</h4>
              <p><span><?php echo $datadb['contact_phone'] ?></span>
              </p>
            </div>
            <!-- end of icon box-->
          </div>
          <div class="col-sm-4">
            <div class="icon-box-small"><i class="icon-envelope"></i>
              <hr>
              <h4>E-mail</h4>
              <p><span><?php echo $datadb['contact_email'] ?></span>
              </p>
            </div>
            <!-- end of icon box-->
          </div>
        </div>
        <!-- end of row-->
      </div>
      <!-- end of container-->
    </section>
    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title">
              <h4 class="upper">Let's Join Us.</h4>
              <h3>Contact Us<span class="red-dot"></span></h3>
              <hr>
                                  <!-- OUTPUT MESSAGE -->
            <?= $this->messagecontroll->showMessage() ?>
                <!-- OUTPUT MESSAGE -->
            </div>
            <div class="section-content">
              <div class="contact-form">
                <form id="contact-form" method="POST" action="<?php echo base_url('contact') ?>">
                  <div class="form-group">
                    <input name="name" type="text"  placeholder="Your Name" data-required="true" class="form-control">
                  </div>
                  <div class="form-group">
                    <input name="email" type="email" placeholder="Your Email" data-required="true" class="form-control">
                  </div>
                  <div class="form-group">
                    <input name="subject" type="text" data-required="true" placeholder="Subject" class="form-control">
                  </div>
                  <div class="form-group">
                    <textarea name="message" placeholder="Message" data-required="true" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-color">Send Message</button>
                  </div>
                </form>
              </div>
              <!-- end of contact form-->
            </div>
            <!-- end of section-content-->
          </div>
        </div>
        <!-- end of row-->
      </div>
      <!-- end of container-->
    </section>
    <br/>