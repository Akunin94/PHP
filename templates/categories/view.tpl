{include file="header.tpl" h1=$current_category.name}
	<!-- <div class="mb-4 d-flex justify-content-between">
		<a href="/categories/add" class="btn btn-success">Добавить</a>
	</div> -->
	<table class="table table-light table-striped table-bordered table-hover">
		<thead class="thead-dark">
			<tr>
				<th>Название товаров</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$products item=e}
			<tr>
				<td>{$e.name}</td>
				<td class="text-right">
					<a class="btn mb-1 btn-primary" href="/products/edit?id={$e.id}">Редактировать</a>
					<form action="/products/delete" method="post" class="d-inline"><input type="hidden" name="id" value="{$e.id}"><button type="submit" class="btn mb-1 btn-secondary">Удалить</form>
				</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
{include file="bottom.tpl"}