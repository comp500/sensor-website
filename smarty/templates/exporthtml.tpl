{extends file="skeleton.tpl"}
{block name=body}
	<div class="container">
		<a href="/exports" class="btn btn-outline-primary mt-4">Go back</a>
		<h1>Recorded data export</h1>
		<p class="text-right"><em>{$dataLength} rows</em></p>
		<table class="table table-striped">
			<thead>
				<tr>
					{foreach $titles as $title}<td>{$title}</td>{/foreach}<td>Date Recorded</td>
				</tr>
			</thead>
			<tbody>
				{foreach $data as $entity}<tr>{foreach $entity as $value}<td>{$value}</td>{/foreach}</tr>{/foreach}
			</tbody>
		</table>
	</div>
{/block}
{assign "page" "exports"}
