<?php /* Smarty version 2.6.31, created on 2020-07-20 18:50:36
         compiled from categories/view.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('h1' => $this->_tpl_vars['current_category']['name'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<!-- <div class="mb-4 d-flex justify-content-between">
		<a href="/categories/add" class="btn btn-success">Добавить</a>
	</div> -->
	<table class="table table-light table-striped table-bordered table-hover">
		<thead class="thead-dark">
			<tr>
				<th>Название товаров</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['e']):
?>
			<tr>
				<td><?php echo $this->_tpl_vars['e']['name']; ?>
</td>
				<td class="text-right">
					<a class="btn mb-1 btn-primary" href="/products/edit?id=<?php echo $this->_tpl_vars['e']['id']; ?>
">Редактировать</a>
					<form action="/products/delete" method="post" class="d-inline"><input type="hidden" name="id" value="<?php echo $this->_tpl_vars['e']['id']; ?>
"><button type="submit" class="btn mb-1 btn-secondary">Удалить</form>
				</td>
			</tr>
			<?php endforeach; endif; unset($_from); ?>
		</tbody>
	</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>