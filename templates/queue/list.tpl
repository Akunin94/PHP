{include file="header.tpl" h1='Список задач'}
	<table class="table table-light table-striped table-bordered table-hover">
		<thead class="thead-dark">
			<tr>
				<th>#</th>
				<th>Название задачи</th>
				<th>Статус задачи</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$tasks item=e}
			<tr>
				<td>{$e.id}</td>
				<td>{$e.name}</td>
				<td>
					<span class="badge badge-dark pb-2" style="font-size: inherit;">{$e.status}</span>
				</td>
				<td class="text-right">
					<a class="btn mb-1 btn-primary" href="/queue/run?id={$e.id}">Запустить</a>
					<form action="/queue/delete" method="post" class="d-inline">
						<input type="hidden" name="id" value="{$e.id}">
						<input type="submit" value="Удалить" class="btn mb-1 btn-secondary">
					</form>
				</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
{include file="bottom.tpl"}