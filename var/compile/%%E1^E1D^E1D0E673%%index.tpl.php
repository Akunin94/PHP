<?php /* Smarty version 2.6.31, created on 2020-08-16 07:52:07
         compiled from products/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('h1' => 'Список товаров')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<div class="mb-4 d-flex justify-content-between">
		<a href="/products/add" class="btn btn-success">Добавить</a>
	</div>
	<nav>
		<ul class="pagination">
			<?php unset($this->_sections['pagination']);
$this->_sections['pagination']['loop'] = is_array($_loop=$this->_tpl_vars['pages_count']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pagination']['name'] = 'pagination';
$this->_sections['pagination']['show'] = true;
$this->_sections['pagination']['max'] = $this->_sections['pagination']['loop'];
$this->_sections['pagination']['step'] = 1;
$this->_sections['pagination']['start'] = $this->_sections['pagination']['step'] > 0 ? 0 : $this->_sections['pagination']['loop']-1;
if ($this->_sections['pagination']['show']) {
    $this->_sections['pagination']['total'] = $this->_sections['pagination']['loop'];
    if ($this->_sections['pagination']['total'] == 0)
        $this->_sections['pagination']['show'] = false;
} else
    $this->_sections['pagination']['total'] = 0;
if ($this->_sections['pagination']['show']):

            for ($this->_sections['pagination']['index'] = $this->_sections['pagination']['start'], $this->_sections['pagination']['iteration'] = 1;
                 $this->_sections['pagination']['iteration'] <= $this->_sections['pagination']['total'];
                 $this->_sections['pagination']['index'] += $this->_sections['pagination']['step'], $this->_sections['pagination']['iteration']++):
$this->_sections['pagination']['rownum'] = $this->_sections['pagination']['iteration'];
$this->_sections['pagination']['index_prev'] = $this->_sections['pagination']['index'] - $this->_sections['pagination']['step'];
$this->_sections['pagination']['index_next'] = $this->_sections['pagination']['index'] + $this->_sections['pagination']['step'];
$this->_sections['pagination']['first']      = ($this->_sections['pagination']['iteration'] == 1);
$this->_sections['pagination']['last']       = ($this->_sections['pagination']['iteration'] == $this->_sections['pagination']['total']);
?>
			<li class="page-item <?php if ($_GET['p'] == $this->_sections['pagination']['iteration'] || ( ! $_GET['p'] && $this->_sections['pagination']['iteration'] == 1 )): ?>active<?php endif; ?>">
				<a href="<?php echo $_SERVER['PATH_INFO']; ?>
?p=<?php echo $this->_sections['pagination']['iteration']; ?>
" class="page-link"><?php echo $this->_sections['pagination']['iteration']; ?>
</a>
			</li>
			<?php endfor; endif; ?>
		</ul>
	</nav>
	<table class="table table-light table-striped table-bordered table-hover">
		<thead class="thead-dark">
			<tr>
				<th>Название товара</th>
				<th>Артикул</th>
				<th>Цена</th>
				<th class="text-nowrap">Кол-во</th>
				<th>Категория</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['e']):
?>
			<tr>
				<td>
					<small class="text-muted">(<?php echo $this->_tpl_vars['e']->getId(); ?>
)</small>
					<?php echo $this->_tpl_vars['e']->getName(); ?>


					<?php if ($this->_tpl_vars['e']->getImages()): ?>
					<div class="gallery">
						<?php $_from = $this->_tpl_vars['e']->getImages(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['b']):
?>
						<a <?php if ($this->_tpl_vars['k'] != 0): ?>class="d-none"<?php endif; ?> href="<?php echo $this->_tpl_vars['b']->getPath(); ?>
">
							<img class="img-thumbnail rounded" width="100" src="<?php echo $this->_tpl_vars['b']->getPath(); ?>
" alt="<?php echo $this->_tpl_vars['b']->getName(); ?>
">
						</a>						
						<?php endforeach; endif; unset($_from); ?>
					</div>
					<?php endif; ?>

					<?php if ($this->_tpl_vars['e']->getDescription): ?>
					<small class="text-muted mt-1 d-block"><?php echo $this->_tpl_vars['e']->getDescription; ?>
</small>
					<?php endif; ?>
				</td>
				<td><?php echo $this->_tpl_vars['e']->getArticle(); ?>
</td>
				<td class="text-nowrap"><?php echo $this->_tpl_vars['e']->getPrice(); ?>
 <strong>₽</strong></td>
				<td><?php echo $this->_tpl_vars['e']->getAmount(); ?>
</td>
				<?php $this->assign('productCategory', $this->_tpl_vars['e']->getCategory()); ?>
				<td><?php echo $this->_tpl_vars['productCategory']->getName(); ?>
</td>
				<td class="text-center">
					<a class="btn mb-1 btn-primary" href="/products/edit?id=<?php echo $this->_tpl_vars['e']->getId(); ?>
">Редактировать</a>
					<form action="/products/delete" method="post" class="d-inline"><input type="hidden" name="id" value="<?php echo $this->_tpl_vars['e']->getId(); ?>
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