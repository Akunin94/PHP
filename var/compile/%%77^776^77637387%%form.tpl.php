<?php /* Smarty version 2.6.31, created on 2020-07-19 11:19:14
         compiled from categories/form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'categories/form.tpl', 10, false),)), $this); ?>
<div class="mb-4 d-flex justify-content-between">
    <a href="/categories/list" class="btn btn-secondary">Назад к списку категорий</a>
</div>
<form method="post">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['category']['id']; ?>
">
    <div class="form-group">
        <label for="name">Название категории: </label>
        <input autofocus autocomplete="off" class="form-control" type="text" name="name" id="name" required value="<?php echo $this->_tpl_vars['category']['name']; ?>
">
    </div>
    <button type="submit" class="btn btn-success"><?php echo ((is_array($_tmp=@$this->_tpl_vars['submit_name'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Сохранить') : smarty_modifier_default($_tmp, 'Сохранить')); ?>
</button>
</form>