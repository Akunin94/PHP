<div class="mb-4 d-flex justify-content-between">
    <a href="/products/" class="btn btn-secondary">Назад к списку товаров</a>
</div>
<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="{$product->getId()}">

    <div class="form-group">
        <label for="name">Название товара: </label>
        <input autofocus class="form-control" type="text" name="name" id="name" required value="{$product->getName()}">
    </div>
    <div class="form-group">
        <label for="article">Артикул товара: </label>
        <input class="form-control" type="text" name="article" id="article" required value="{$product->getArticle()}">
    </div>
    <div class="form-group">
        <label for="image_url">Ссылка на изображение: </label>
        <input class="form-control" type="text" name="image_url" id="image_url">
    </div>
    <div class="form-group">
        <label for="images">Фото товара: </label>
        <input multiple type="file" name="images[]" id="images">
    </div>
    {if !empty($product->getImages())}
    <div class="form-group d-flex">
        {foreach from=$product->getImages() item=e}
        <div class="card mr-1 p-1 align-items-center" style="width: 180px;">
            <img class="mw-100" src="{$e->getPath()}" alt="{$e->getName()}">
            <div class="card-body p-0 mt-1 d-flex justify-content-center align-items-end">
                <button class="btn btn-danger btn-lg" type="submit" onclick="return deleteImage(this)" data-image-id="{$e->getId()}">Удалить</button>
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
        <input class="form-control" type="number" name="price" id="price" required value="{$product->getPrice()}">
    </div>
    <div class="form-group">
        <label for="amount">Количество товара: </label>
        <input class="form-control" type="number" name="amount" id="amount" required value="{$product->getAmount()}">
    </div>
    <div class="form-group">
        <label for="category">Категория товара: </label>
        <select class="form-control" name="category_id">
            <option value="">Не выбрано</option>
            {assign var=productCategory value=$product->getCategory()}
            {foreach from=$categories item=e}
            <option {if $productCategory->getId() == $e.id}selected{/if} value="{$e.id}">{$e.name}</option>
            {/foreach}
        </select>
    </div>
    <div class="form-group">
        <label for="description">Описание товара: </label>
        <textarea name="description" rows="4" class="form-control" id="description">{$product->getDescription()}</textarea>
    </div>
    <button type="submit" class="btn btn-success">{$submit_name|default:'Сохранить'}</button>
</form>