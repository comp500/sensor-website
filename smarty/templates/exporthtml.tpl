{extends file="skeleton.tpl"}
{block name=body}
	<div class="container">
		<a href="/exports" class="btn btn-outline-primary mt-4">Go back</button>
		<h1>Recorded data export</h1>
		<table class="table">
			<thead>
				<tr>
					{foreach $titles as $title}<th>{$title}</th>
					{/foreach}<th>Date Recorded</th>
				</tr>
			</thead>
			<tbody>
				{foreach $data as $entity}
					<tr>
						{foreach $entity as $value}<th>{$value}</th>
						{/foreach}
					</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
{/block}
{block name=js}{/block}
{assign "page" "exports"}
