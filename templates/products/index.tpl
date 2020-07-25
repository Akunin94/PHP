{include file="header.tpl" h1='Список товаров'}
	<div class="mb-4 d-flex justify-content-between">
		<a href="/products/add" class="btn btn-success">Добавить</a>
	</div>
	<nav>
		<ul class="pagination">
			{section loop=$pages_count name=pagination}
			<li class="page-item {if $smarty.get.p == $smarty.section.pagination.iteration || (!$smarty.get.p && $smarty.section.pagination.iteration==1 ) }active{/if}">
				<a href="{$smarty.server.PATH_INFO}?p={$smarty.section.pagination.iteration}" class="page-link">{$smarty.section.pagination.iteration}</a>
			</li>
			{/section}
		</ul>
	</nav>
	<table class="table table-light table-striped table-bordered table-hover">
		<thead class="thead-dark">
			<tr>
				<th>Название товара</th>
				<th>Артикул</th>
				<th>Цена</th>
				<th class="text-nowrap">Кол-во</th>
				<th>Категория</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$products item=e}
			<tr>
				<td>
					<small class="text-muted">({$e.id})</small>
					{$e.name}
					{if !empty($e.images)}
					<br />
					{foreach from=$e.images item=b}
					<img width="30" src="{$b.path}" alt="{$b.name}">
					{/foreach}
					{/if}

					{if $e.description}
					<small class="text-muted mt-1 d-block">{$e.description}</small>
					{/if}
				</td>
				<td>{$e.article}</td>
				<td class="text-nowrap">{$e.price} <strong>₽</strong></td>
				<td>{$e.amount}</td>
				<td>{$e.category_name}</td>
				<td class="text-center">
					<a class="btn mb-1 btn-primary" href="/products/edit?id={$e.id}">Редактировать</a>
					<form action="/products/delete" method="post" class="d-inline"><input type="hidden" name="id" value="{$e.id}"><button type="submit" class="btn mb-1 btn-secondary">Удалить</form>
				</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
{include file="bottom.tpl"}