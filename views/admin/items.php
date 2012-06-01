<section class="title">
	<h4><?php echo lang('cic:item_list'); ?></h4>
</section>

<section class="item">
	<?php echo form_open('admin/cic/delete');?>
	
	<?php if (!empty($items)): ?>
	
		<table>
			<thead>
				<tr>
					<th><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
					<th><?php echo lang('cic:c_name'); ?></th>
					<th><?php echo lang('cic:mailing'); ?></th>
					<th><?php echo lang('cic:mobile'); ?></th>
					<th><?php echo lang('cic:email'); ?></th>
					<th>Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="5">
						<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
					</td>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach( $items as $item ): ?>
				<tr>
					<td><?php echo form_checkbox('action_to[]', $item->id); ?></td>
					<td><?php
					if(!empty($item->c_name)){
						echo $item->c_name;
					} else {
						echo $array_for_title[$item->title]." ".$item->fname." ".$item->mname." ".$item->lname;
					}
					?></td>
					<td>
					<?php 
						$address = $arrayName = array(
							$item->mailing,
							$item->city,
							$item->state,
							$item->country
						);
						echo implode(", ", $address);
					?>
					</td>
					<td><?php echo $item->mobile; ?></td>
					<td><?php echo $item->email; ?></td>					
					<td class="actions">
						<?php echo
						anchor('cic', lang('cic:view'), 'class="button" target="_blank"').' '.
						anchor('admin/cic/edit/'.$item->id, lang('cic:edit'), 'class="button"').' '.
						anchor('admin/cic/delete/'.$item->id, 	lang('cic:delete'), array('class'=>'button')); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		
		<div class="table_action_buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete'))); ?>
		</div>
		
	<?php else: ?>
		<div class="no_data"><?php echo lang('cic:no_items'); ?></div>
	<?php endif;?>
	
	<?php echo form_close(); ?>
</section>