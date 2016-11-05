
		<!-- Page Content -->
		<div class="container" >
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 text-left">
						   <h4>Article Preview</h4>
						</div>
						<div class="col-md-6 text-right">
						   <div class="btn-group" role="group" aria-label="...">
						      <button type="button" class="btn btn-success exlink" data-url="<?= base_url('app_blog').'/data/'.$this->uri->segment(4).'/'.$this->uri->segment(5) ?>"><span class="glyphicon glyphicon-repeat"></span> Back To Master Data</button>
							     &nbsp;
                              <button type="button" class="btn btn-info exlink" data-url="<?= base_url('app_blog').'/edit/'.$initial_id.'/'.$this->uri->segment(4).'/'.$this->uri->segment(5) ?>"><span class="glyphicon glyphicon-edit"></span> Edit Article</button>
                            </div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div  id="page-content">    
                        <h5><b>Url Link</b> :<span class="copy-link"><?= str_replace('cms/', '', base_url()).'article/detail/'.$datadb['blog_id'].'/'.$this->uri->segment(5).'/'.$datadb['blog_category_name'].'/'.str_replace(' ', '_', $datadb['blog_title']) ?></span>    </h5>   
						<br /><br />
                        <iframe id="ipreview" src="<?= base_url('app_preview').'/data/'.$initial_id ?>"></iframe>	
					</div>
				</div>
			</div>
		</div>
		<!-- End Container -->
