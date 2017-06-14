{extends file="skeleton.tpl"}
{block name=body}
	<div class="container">
		<form method="post">
			<legend>Make a choice</legend>
			<div class="form-group row">
				<label for="example-datetime-local-input" class="col-2 col-form-label">Start time</label>
				<div class="col-10">
					<input class="form-control" type="datetime-local" value="" name="start-time">
				</div>
			</div>
			<div class="form-group row">
				<label for="example-datetime-local-input" class="col-2 col-form-label">End time</label>
				<div class="col-10">
					<input class="form-control" type="datetime-local" value="" name="end-time">
				</div>
			</div>

			<fieldset class="form-group">
				<legend>Select format</legend>
				<div class="form-check">
					<label class="form-check-label">
			<input type="radio" class="form-check-input" name="output-format" value="csv" checked>
			CSV
		  </label>
				</div>
				<div class="form-check disabled">
					<label class="form-check-label">
			<input type="radio" class="form-check-input" name="output-format" value="json" disabled>
			JSON
		  </label>
				</div>
			</fieldset>
			<div class="g-recaptcha" data-sitekey="6LcleyUUAAAAADxr2PBh6xbEkq-g9xyC888XAeZ5"></div>
			<button type="submit" class="btn btn-primary">Download</button>
		</form>
	</div>
{/block}
{block name=js}
	<script src='https://www.google.com/recaptcha/api.js'></script>
{/block}
{assign "page" "exports"}
