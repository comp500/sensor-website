{extends file="skeleton.tpl"}
{block name=body}
	<div class="container">
		<h1 class="mt-4">Export recorded data</h1>
		<form method="post">
			<!--<legend>Select date range</legend>
			<div class="form-group form-inline">
				<label for="end-time-year" class="col-2 col-form-label">Start date</label>
				<input class="form-control" type="number" placeholder="YYYY" min="2017" max="2100" name="start-time-year">
				<input class="form-control" type="number" placeholder="MM" min="1" max="12" name="start-time-month">
				<input class="form-control" type="number" placeholder="DD" min="1" max="31" name="start-time-day">
			</div>
			<div class="form-group form-inline">
				<label for="end-time-year" class="col-2 col-form-label">End date</label>
				<input class="form-control" type="number" placeholder="YYYY" min="2017" max="2100" name="end-time-year">
				<input class="form-control" type="number" placeholder="MM" min="1" max="12" name="end-time-month">
				<input class="form-control" type="number" placeholder="DD" min="1" max="31" name="end-time-day">
			</div>-->
			
			<fieldset class="form-group">
				<legend>Select sort order</legend>
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-check-input" name="sort" value="desc" checked>
						Descending (newest to oldest)
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-check-input" name="sort" value="asc">
						Ascending (oldest to newest)
					</label>
				</div>
			</fieldset>
			
			<fieldset class="form-group">
				<legend>Select format</legend>
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-check-input" name="output-format" value="html" checked>
						HTML (for easy viewing)
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-check-input" name="output-format" value="csv">
						CSV (for Excel)
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-check-input" name="output-format" value="json">
						JSON (for custom programs)
					</label>
				</div>
			</fieldset>
			<div class="g-recaptcha" data-sitekey="6LcleyUUAAAAADxr2PBh6xbEkq-g9xyC888XAeZ5"></div>
			<button type="submit" class="btn btn-primary mb-4">Download</button>
		</form>
	</div>
{/block}
{block name=js}
	<script src='https://www.google.com/recaptcha/api.js'></script>
{/block}
{assign "page" "exports"}
