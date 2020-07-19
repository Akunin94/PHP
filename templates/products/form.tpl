<div class="mb-4 d-flex justify-content-between">
    <a href="/products/list" class="btn btn-secondary">Назад к списку товаров</a>
</div>
<form method="post">
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