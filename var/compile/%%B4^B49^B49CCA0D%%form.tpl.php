<?php /* Smarty version 2.6.31, created on 2020-07-23 16:41:33
         compiled from products/form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'products/form.tpl', 40, false),)), $this); ?>
<div class="mb-4 d-flex justify-content-between">
    <a href="/products/list" class="btn btn-secondary">Назад к списку товаров</a>
</div>
<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['product']['id']; ?>
">

    <div class="form-group">
        <label for="name">Название товара: </label>
        <input autofocus class="form-control" type="text" name="name" id="name" required value="<?php echo $this->_tpl_vars['product']['name']; ?>
">
    </div>
    <div class="form-group">
        <label for="article">Артикул товара: </label>
        <input class="form-control" type="text" name="article" id="article" required value="<?php echo $this->_tpl_vars['product']['article']; ?>
">
    </div>
    <div class="form-group">
        <label for="images">Фото товара: </label>
        <input multiple type="file" name="images[]" id="images">
    </div>
    <div class="form-group">
        <label for="price">Цена товара: </label>
        <input class="form-control" type="number" name="price" id="price" required value="<?php echo $this->_tpl_vars['product']['price']; ?>
">
    </div>
    <div class="form-group">
        <label for="amount">Количество товара: </label>
        <input class="form-control" type="number" name="amount" id="amount" required value="<?php echo $this->_tpl_vars['product']['amount']; ?>
">
    </div>
    <div class="form-group">
        <label for="category">Категория товара: </label>
        <select class="form-control" name="category_id">
            <option value="">Не выбрано</option>
            <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['e']):
?>
            <option <?php if ($this->_tpl_vars['product']['category_id'] == $this->_tpl_vars['e']['id']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['e']['id']; ?>
"><?php echo $this->_tpl_vars['e']['name']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
    </div>
    <div class="form-group">
        <label for="description">Описание товара: </label>
        <textarea name="description" rows="4" class="form-control" id="description"><?php echo $this->_tpl_vars['product']['description']; ?>
</textarea>
    </div>
    <button type="submit" class="btn btn-success"><?php echo ((is_array($_tmp=@$this->_tpl_vars['submit_name'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Сохранить') : smarty_modifier_default($_tmp, 'Сохранить')); ?>
</button>
</form>