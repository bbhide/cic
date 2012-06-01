<section class="title">
	<!-- We'll use $this->method to switch between cic.create & cic.edit -->
	<h4><?php echo lang('cp:'.$this->method); ?></h4>
</section>

<section class="item">

	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud" id="cp_frm"'); ?>
		
		<div class="form_inputs">
	
		<ul>

			<li class="<?php echo alternator('', 'even'); ?>" >
				<label for="fname"><?php echo lang('cic:name'); ?> </label>
				<div class="input">
					<?php echo form_dropdown('title', $array_for_title,$title,'id="cptitle" class="small"'); ?>
					<?php echo form_input('fname', set_value('fname', $fname), 'id="fname" class="width-15" placeholder="'.lang('cic:fname').'"'); ?>
					<?php echo form_input('mname', set_value('mname', $mname), 'class="width-15" placeholder="'.lang('cic:mname').'"'); ?>
					<?php echo form_input('lname', set_value('lname', $lname), 'class="width-15" placeholder="'.lang('cic:lname').'"'); ?>

				</div>
			</li>

			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="email"><?php echo lang('cic:email'); ?> <span>*</span></label>
				<div class="input more_container" id="email_container">
					<input type="email" name="email[]"  class="email" placeholder="for example: person@company.com"/>&nbsp;<button class="btn blue addmore">+ Add</button><br/>
					<?php
					$emails = empty($email)?array():explode(',', $email);
					foreach($emails as $email) : ?>
						<input type="email" name="email[]" value="<?=$email?>" class="email" placeholder="for example: person@company.com" /><br/>
					<?php endforeach; ?>
				</div>
			</li>
			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="mobile"><?php echo lang('cic:mobile'); ?></label>
				<div class="input more_container" id="mobile_container" >
					<input type="text" name="mobile[]"  class="mobile" placeholder="for example: 919820000000"/>&nbsp;<button class="btn blue addmore">+ Add</button><br/>
					<?php
					$mobiles = empty($mobile)?array():explode(',', $mobile);
					foreach($mobiles as $mobile) : ?>
						<input type="text" name="mobile[]" value="<?=$mobile?>" class="mobile" placeholder="for example: 919820000000" /><br/>
					<?php endforeach; ?>
				</div>
			</li>
		</ul>
		
		</div>
		
		<div class="buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
		</div>
		
	<?php echo form_close(); ?>

</section>