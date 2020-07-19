{include file="header.tpl" h1='Список категорий'}
	<div class="mb-4 d-flex justify-content-between">
		<a href="/categories/add" class="btn btn-success">Добавить</a>
	</div>
	<table class="table table-light table-striped table-bordered table-hover">
		<thead class="thead-dark">
			<tr>
				<th>Название категории</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$categories item=e}
			<tr>
				<td>{$e.name}</td>
				<td class="text-right">
					<a class="btn mb-1 btn-primary" href="/categories/edit?id={$e.id}">Редактировать</a>
					<form action="/categories/delete" method="post" class="d-inline"><input type="hidden" name="id" value="{$e.id}"><input type="submit" value="Удалить категорию" class="btn mb-1 btn-secondary"></form>
					<form action="/categories/delete_category_products" method="post" class="d-inline"><input type="hidden" name="id" value="{$e.id}"><input type="submit" onclick="return confirm('Уверен что хочешь все товары данной категории грохнуть?')" value="Удалить все товары категории" class="btn mb-1 btn-danger"></form>
				</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
{include file="bottom.tpl"}