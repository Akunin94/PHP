{include file="header.tpl" h1='Загрузка файла импорта'}
<div class="mb-4">
    <a href="/products/list" class="btn btn-secondary">Назад к списку товаров</a>
</div>
<form method="post" enctype="multipart/form-data" action="/import/upload">
    <div class="form-group">
        <label for="import_file">Фото импорта(csv): </label>
        <input multiple type="file" name="import_file" id="import_file">
    </div>
    <button type="submit" class="btn btn-success">Импортировать</button>
</form>
{include file="bottom.tpl"}