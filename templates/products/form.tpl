<div class="mb-4 d-flex justify-content-between">
    <a href="/products/list" class="btn btn-secondary">Назад к списку товаров</a>
</div>
<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="{$product.id}">

    <div class="form-group">
        <label for="name">Название товара: </label>
        <input autofocus class="form-control" type="text" name="name" id="name" required value="{$product.name}">
    </div>
    <div class="form-group">
        <label for="article">Артикул товара: </label>
        <input class="form-control" type="text" name="article" id="article" required value="{$product.article}">
    </div>
    <div class="form-group">
        <label for="images">Фото товара: </label>
        <input multiple type="file" name="images[]" id="images">
    </div>
    {if !empty($product.images)}
    <div class="form-group d-flex">
        {foreach from=$product.images item=e}
        <div class="card mr-1 p-1 align-items-center" style="width: 180px;">
            <img class="mw-100" src="{$e.path}" alt="{$e.name}">
            <div class="card-body p-0 mt-1 d-flex justify-content-center align-items-end">
                <button class="btn btn-danger btn-lg" type="submit" onclick="return deleteImage(this)" data-image-id="{$e.id}">Удалить</button>
            </div>
        </div>
        {/foreach}
    </div>

    {literal}
    <script>
        function deleteImage(button) {
            let imageId = $(button).attr('data-image-id'),
                url = '/products/delete_images';

            imageId = parseInt(imageId);

            if (!imageId) {
                alert('Проблема с image_id');
                return false;
            }

            const formData = new FormData();
            formData.append('product_image_id', imageId);

            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then((response) => {
                response.text()
                .then((text) => {
                    if (text.indexOf('error') > -1) {
                        alert('Ошибка при удалении');
                    } else {
                        document.location.reload();
                    }
                })
            });

            return false;
        }
    </script>
    {/literal}
    {/if}
    <div class="form-group">
        <label for="price">Цена товара: </label>
        <input class="form-control" type="number" name="price" id="price" required value="{$product.price}">
    </div>
    <div class="form-group">
        <label for="amount">Количество товара: </label>
        <input class="form-control" type="number" name="amount" id="amount" required value="{$product.amount}">
    </div>
    <div class="form-group">
        <label for="category">Категория товара: </label>
        <select class="form-control" name="category_id">
            <option value="">Не выбрано</option>
            {foreach from=$categories item=e}
            <option {if $product.category_id == $e.id}selected{/if} value="{$e.id}">{$e.name}</option>
            {/foreach}
        </select>
    </div>
    <div class="form-group">
        <label for="description">Описание товара: </label>
        <textarea name="description" rows="4" class="form-control" id="description">{$product.description}</textarea>
    </div>
    <button type="submit" class="btn btn-success">{$submit_name|default:'Сохранить'}</button>
</form>