
    <!-- Page Content -->
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 text-left">
                       <h4>Page Contact</h4>
                    </div>
                    <div class="col-md-6 text-right">
                       <div class="btn-group" role="group" aria-label="...">
                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div  id="page-content"> 
                
                  <form action="<?= base_url('app_contact').'/edit/' ?>" method="post" enctype="multipart/form-data">
                    <h5 class="text-info">Article Category</h5>
                    <hr/>
                    <!-- OUTPUT MESSAGE -->
                    <?= $this->messagecontroll->showMessage() ?>
                    <!-- OUTPUT MESSAGE -->
                    <div class="control-group">
                      <label class="control-label">Setting Email Address</label>
                      <div class="controls">
                        <div class="notif-info">
                            <p>Use delimiter <b>( # )</b> if you have more than 1 email address</p>
                            <p><b>Example: email1@yahoo.com#email2@gmail.com</b></p>
                        </div>
                         <input type="text" style="width:90%" name="contact_email" value="<?= $datadb['contact_email'] ?>"/>
                      </div>
                    </div>
                    <hr />
                    <div class="control-group">
                      <label class="control-label">Contact Phone</label>
                      <div class="controls">
                      <input type="text"  style="width:90%" name="contact_phone" value="<?= $datadb['contact_phone'] ?>"/>
                      </div>
                    </div>
                    <hr />
                    <div class="control-group">
                      <label class="control-label">Contact Office</label>
                      <div class="controls">
                        <textarea  id="text-editor-mini1" rows="5" name="contact_office"><?= $datadb['contact_office'] ?></textarea>
                      </div>
                    </div>
                    <hr/>
                    <div class="form-actions no-margin">
                      <button type="reset" class="btn">Cancel</button>
                      <button type="submit" class="btn btn-info">Update</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Container -->
