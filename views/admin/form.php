<section class="title">
	<!-- We'll use $this->method to switch between cic.create & cic.edit -->
	<h4><?php echo lang('cic:'.$this->method); ?></h4>
</section>

<section class="item">

	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud"'); ?>
		
		<div class="form_inputs">
	
		<ul>
			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="pin"><?php echo lang('cic:pin'); ?> <span>*</span>
					<small>This is the unique identity. PIN must be used in all your emails.It can be Numeric &amp; 4 Digit long. Leave it blank to generate PIN automatically</small>
				</label>
				<div class="input"><?php echo form_input('pin', set_value('pin', $pin), 'class="width-15" placeholder="'.lang('cic:pin').'"'); ?></div>
			</li>
			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="name"><?php echo lang('cic:type'); ?> <span>*</span></label>
				<div class="input">
					<?php echo form_dropdown('cic_type', $array_for_ctype,$cic_type,'id="cic_type"'); ?>
				</div>
			</li>
			<li class="<?php echo alternator('', 'even'); ?> comp_holder" >
				<label for="c_name"><?php echo lang('cic:c_name'); ?></label>
				<div class="input">
					<?php echo form_input('c_name', set_value('c_name', $c_name), 'id="c_name" class="width-15" placeholder="'.lang('cic:c_name').'"'); ?>
				</div>
			</li>

			<li class="<?php echo alternator('', 'even'); ?> comp_holder">
				<label for="comp_email"><?php echo lang('cic:comp_email'); ?> <span>*</span>
					<small>Company's main email id.(This id must not be individual's email id)</small>
				</label>
				<div class="input more_container" id="comp_email_container">
					<input type="email" name="comp_email" value="<?=set_value('comp_email', $comp_email)?>"  class="comp_email" placeholder="for example: person@company.com"/>
				</div>
			</li>

			<li class="<?php echo alternator('', 'even'); ?>" id="i_name_holder">
				<label for="fname"><?php echo lang('cic:owner_name'); ?> <span>*</span> 
					<small>Details of Head / Proprietor / Owner of the company only</small>
				</label>
				<div class="input">
					<?php echo form_dropdown('title', $array_for_title,$title,'id="cictitle" class="small"'); ?>
					<?php echo form_input('fname', set_value('fname', $fname), 'id="fname" class="width-15" placeholder="'.lang('cic:fname').'"'); ?>
					<?php echo form_input('mname', set_value('mname', $mname), 'class="width-15" placeholder="'.lang('cic:mname').'"'); ?>
					<?php echo form_input('lname', set_value('lname', $lname), 'class="width-15" placeholder="'.lang('cic:lname').'"'); ?>

				</div>
			</li>

			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="email"><?php echo lang('cic:email'); ?> <span>*</span>
				<small>Details of Head / Proprietor / Owner of the company only</small>
				</label>
				<div class="input more_container" id="email_container">
					<input type="email" name="email" value="<?=set_value('email', $email);?>" class="email" placeholder="for example: person@company.com"/>
				</div>
			</li>

			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="mobile"><?php echo lang('cic:mobile'); ?><span>*</span>
				<small>Details of Head / Proprietor / Owner of the company only</small>
				</label>
				<div class="input more_container" id="mobile_container" >
					<input name="mobile" value="<?=set_value('mobile', $mobile);?>" class="mobile" size="10" length="10" type='tel' pattern='\d\d\d\d\d\d\d\d\d\d' placeholder="for example: 982xxxxxxx"/>
				</div>
			</li>

			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="mailing"><?php echo lang('cic:mailing'); ?> <span>*</span></label>
				<div class="input">
					<?php echo form_input('mailing', set_value('mailing', $mailing), 'id="mailing" class="width-15" placeholder="'.lang('cic:mailing').'"'); ?>
					<?php echo form_input('city', set_value('city', $city), 'class="width-15" placeholder="'.lang('cic:city').'"'); ?>
					<?php echo form_input('state', set_value('state', $state), 'class="width-15" placeholder="'.lang('cic:state').'"'); ?>
					<?php echo form_input('pincode', set_value('pincode', $pincode), 'class="width-15" placeholder="'.lang('cic:pincode').'"'); ?>
					<?php echo form_input('country', set_value('country', $country), 'class="width-15" placeholder="'.lang('cic:country').'"'); ?>
				</div>
			</li>
			
			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="phone"><?php echo lang('cic:phone'); ?></label>
				<div class="input more_container" id="phone_container" >
					<input type="text" name="c_code" value="<?=set_value('c_code', $c_code);?>"  class="c_code" placeholder="for example: 022"/>
					<input type="text" name="phone" value="<?=set_value('phone', $phone);?>"  class="phone" placeholder="for example: 2899xxxx"/>
				</div>
			</li>

			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="cp"><?php echo lang('cic:cp'); ?> <span>*</span></label>
				<div class="input more_container" id="cp" >
					<label for="same">Same As above</label>
					<input type="checkbox" name="cp_same" value="1" id="same" <?php echo (set_value('cp_same',$cp_same))?'checked="checked"':''; ?>/><br/>
					<input type="hidden" name="cp" value=""/>
					<?php echo set_checkbox('cp_same',$cp_same); ?>
					<?php $cps = empty($cps)?array():explode(',', $cps); ?>
					<?php  echo form_dropdown('cp[]', $array_for_cp, $cp,'multiple id="cp_select"'); ?>
					<button class="btn blue" id="btnaddcp">+ Add Contact Person</button><br/>
				</div>
			</li>
		</ul>
		
		</div>
		
		<div class="buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
		</div>
		
	<?php echo form_close(); ?>

</section>