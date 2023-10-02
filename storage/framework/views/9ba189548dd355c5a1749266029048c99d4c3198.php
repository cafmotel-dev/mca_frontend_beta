<div class="modal fade" id="sendMailModel" role="dialog">
    <div class="modal-dialog modal-xl">
      <div class="modal-content bg-primary">
        <div class="modal-header">
          <h4 class="modal-title">Email Template</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>



        <div class="modal-body">
          <input type="hidden" name="lead_id" id="lead_id" value=""/>
          <input type="hidden" name="list_id" id="list_id" value=""/>
          <div class="row">
            <div class="col-md-4">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">To <span style="color: red;">*</span></label>
                  <input type="text" name="to"  class="form-control" id="toEmailId" disabled  />
                </div>
              </div>

             
              <div class="col-md-12">
                <div class="form-group">
                  <label>Templates</label>
                  <select id="templates" class="form-control" autocomplete="off" style="width: 100%;">
                  </select>
                </div>
              </div>

              <div class="col-md-12">
                <span id="setBoxValue" style="display: none;"></span>
                <div class="form-group">
                  <label>Lead Placeholders</label>
                  <select id="multiple_labels" class="form-control" autocomplete="off" style="width: 100%;"> 
                  </select>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label>Sender Placeholders</label>
                  <select id="multiple_names" class="form-control" autocomplete="off" style="width: 100%;"> </select>
                </div>
              </div>
            </div>

            <div class="col-md-8">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Subject</label>
                  <input type="text" class="form-control" name="subject" id="subject">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label>Templete Preview <span id="editor_text"></span></label>
                  <textarea type="text" class="form-control" name="body" value="" id="editor1"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <a href="/smtps" type="button"class="btn btn btn-danger waves-effect waves-light" data-dismiss="modal"><i class="fa fa-reply"></i> Cancel</a>
          <button type="button" name="submit" class="btn btn btn-primary waves-effect waves-light send_mail"><i class="fa fa-edit edit"></i> Send Mail</button>
        </div>
      </div>
    </div>
  </div>



  <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
  <?php /*?><script src="{{ asset("asset/plugins/ckeditor/ckeditor.js") }}"></script> <?php */ ?>
  <script src="<?php echo e(asset("asset/js/send_email_popup_model.js")); ?>"></script>
<?php /**PATH C:\xampp\htdocs\mca_crm\mca-crm-frontend\resources\views/send-email-popup/email-popup.blade.php ENDPATH**/ ?>