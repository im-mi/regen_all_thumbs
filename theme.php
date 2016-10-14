<?php

class RegenAllThumbsTheme extends Themelet {
	public function display_admin_block() {
		global $page;

		$html = make_form(make_link("regen_all_thumbs"))."
			<input type='submit' value='Regenerate All Thumbnails'>
			<label for='force' title='Regenerate the thumbnail even if one already exists'>Force: </label><input type='checkbox' name='force' id='force'>
			</form>
		";
		$page->add_block(new Block("Regenerate All Thumbnails", $html));
	}

	public function display_results(Page $page) {
		$page->set_title("Regenerate All Thumbnails");
		$page->set_heading("All Thumbnails Regenerated");
		$page->add_block(new NavBlock());
		$page->add_block(new Block("All Thumbnails Regenerated", "All thumbnails have been regenerated."));
	}
}