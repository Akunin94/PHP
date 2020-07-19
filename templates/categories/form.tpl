<div class="mb-4 d-flex justify-content-between">
    <a href="/categories/list" class="btn btn-secondary">Назад к списку категорий</a>
</div>
<form method="post">
    <input type="hidden" name="id" value="{$category.id}">
    <div class="form-group">
        <label for="name">Название категории: </label>
        <input autofocus autocomplete="off" class="form-control" type="text" name="name" id="name" required value="{$category.name}">
    </div>
    <button type="submit" class="btn btn-success">{$submit_name|default:'Сохранить'}</button>
</form>