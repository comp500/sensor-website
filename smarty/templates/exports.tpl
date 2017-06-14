{extends file="skeleton.tpl"}
{block name=body}
	<div class="container">
		<form>
			
			<div class="g-recaptcha" data-sitekey="6LcleyUUAAAAADxr2PBh6xbEkq-g9xyC888XAeZ5"></div>
		</form>
	</div>
{/block}
{block name=js}
	<script src='https://www.google.com/recaptcha/api.js'></script>
{/block}
{assign "page" "exports"}