<section class="title">
	<h4><?php echo lang('cp:list'); ?></h4>
</section>

<section class="item">
	<?php echo form_open('admin/cic/cp/delete');?>
	
	<?php if (!empty($items)): ?>
	
		<table>
			<thead>
				<tr>
					<th><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
					<th><?php echo lang('cp:id'); ?></th>
					<th><?php echo lang('cic:c_name'); ?></th>
					<th><?php echo lang('cic:mobile'); ?></th>
					<th><?php echo lang('cic:email'); ?></th>
					<th width="200px">Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="7">
						<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
					</td>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach( $items as $item ): ?>
				<tr>
					<td><?php echo form_checkbox('action_to[]', $item->id); ?></td>
					<td><?php echo $item->id; ?></td>
					<td><?php echo $array_for_title[$item->title]." ".$item->fname." ".$item->mname." ".$item->lname;?></td>
					<td><?php echo $item->mobile; ?></td>
					<td><?php echo $item->email; ?></td>					
					<td class="actions">
						<?php echo
						anchor('cic', lang('cic:view'), 'class="button" target="_blank"').' '.
						anchor('admin/cic/cp/edit/'.$item->id, lang('cic:edit'), 'class="button"').' '.
						anchor('admin/cic/cp/delete/'.$item->id, 	lang('cic:delete'), array('class'=>'button')); ?>
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