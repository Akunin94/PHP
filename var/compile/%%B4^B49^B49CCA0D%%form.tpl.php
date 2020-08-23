<?php /* Smarty version 2.6.31, created on 2020-08-23 18:51:04
         compiled from products/form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'products/form.tpl', 93, false),)), $this); ?>
<div class="mb-4 d-flex justify-content-between">
    <a href="/products/" class="btn btn-secondary">Назад к списку товаров</a>
</div>
<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['product']->getId(); ?>
">

    <div class="form-group">
        <label for="name">Название товара: </label>
        <input autofocus class="form-control" type="text" name="name" id="name" required value="<?php echo $this->_tpl_vars['product']->getName(); ?>
">
    </div>
    <div class="form-group">
        <label for="article">Артикул товара: </label>
        <input class="form-control" type="text" name="article" id="article" required value="<?php echo $this->_tpl_vars['product']->getArticle(); ?>
">
    </div>
    <div class="form-group">
        <label for="image_url">Ссылка на изображение: </label>
        <input class="form-control" type="text" name="image_url" id="image_url">
    </div>
    <div class="form-group">
        <label for="images">Фото товара: </label>
        <input multiple type="file" name="images[]" id="images">
    </div>
    <?php if (! empty ( $this->_tpl_vars['product']->getImages() )): ?>
    <div class="form-group d-flex">
        <?php $_from = $this->_tpl_vars['product']->getImages(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['e']):
?>
        <div class="card mr-1 p-1 align-items-center" style="width: 180px;">
            <img class="mw-100" src="<?php echo $this->_tpl_vars['e']->getPath(); ?>
" alt="<?php echo $this->_tpl_vars['e']->getName(); ?>
">
            <div class="card-body p-0 mt-1 d-flex justify-content-center align-items-end">
                <button class="btn btn-danger btn-lg" type="submit" onclick="return deleteImage(this)" data-image-id="<?php echo $this->_tpl_vars['e']->getId(); ?>
">Удалить</button>
            </div>
        </div>
        <?php endforeach; endif; unset($_from); ?>
    </div>

    <?php echo '
    <script>
        function deleteImage(button) {
            let imageId = $(button).attr(\'data-image-id\'),
                url = \'/products/delete_images\';

            imageId = parseInt(imageId);

            if (!imageId) {
                alert(\'Проблема с image_id\');
                return false;
            }

            const formData = new FormData();
            formData.append(\'product_image_id\', imageId);

            fetch(url, {
                method: \'POST\',
                body: formData
            })
            .then((response) => {
                response.text()
                .then((text) => {
                    if (text.indexOf(\'error\') > -1) {
                        alert(\'Ошибка при удалении\');
                    } else {
                        document.location.reload();
                    }
                })
            });

            return false;
        }
    </script>
    '; ?>

    <?php endif; ?>
    <div class="form-group">
        <label for="price">Цена товара: </label>
        <input class="form-control" type="number" name="price" id="price" required value="<?php echo $this->_tpl_vars['product']->getPrice(); ?>
">
    </div>
    <div class="form-group">
        <label for="amount">Количество товара: </label>
        <input class="form-control" type="number" name="amount" id="amount" required value="<?php echo $this->_tpl_vars['product']->getAmount(); ?>
">
    </div>
    <div class="form-group">
        <label for="category">Категория товара: </label>
        <select class="form-control" name="category_id">
            <option value="">Не выбрано</option>
            <?php $this->assign('productCategory', $this->_tpl_vars['product']->getCategory()); ?>
            <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['e']):
?>
            <option <?php if ($this->_tpl_vars['productCategory']->getId() == $this->_tpl_vars['e']['id']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['e']['id']; ?>
"><?php echo $this->_tpl_vars['e']['name']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
    </div>
    <div class="form-group">
        <label for="description">Описание товара: </label>
        <textarea name="description" rows="4" class="form-control" id="description"><?php echo $this->_tpl_vars['product']->getDescription(); ?>
</textarea>
    </div>
    <button type="submit" class="btn btn-success"><?php echo ((is_array($_tmp=@$this->_tpl_vars['submit_name'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Сохранить') : smarty_modifier_default($_tmp, 'Сохранить')); ?>
</button>
</form>