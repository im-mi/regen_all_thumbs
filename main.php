<?php
/*
 * Name: Regen All Thumbs
 * Author: im-mi <im.mi.mail.mi@gmail.com>
 * License: GPLv2
 * Description: Regenerate all thumbnail images
 * Documentation:
 *  This adds a button in the admin tools page which allows
 *  an admin to regenerate every thumbnail at once.
 *  This process may take a while depending on the number of
 *  posts and number of thumbnails being generated.
 */
class RegenAllThumbs extends Extension {
	public function onPageRequest(PageRequestEvent $event) {
		global $database, $page, $user;

		if($event->page_matches("regen_all_thumbs") && $user->can("delete_image")) {
			$images = $database->get_all("SELECT hash, ext FROM images");
			foreach ($images as $image) {
				send_event(new ThumbnailGenerationEvent($image["hash"], $image["ext"], isset($_POST["force"])));
			}
			$this->theme->display_results($page);
		}
	}

	public function onAdminBuilding(AdminBuildingEvent $event) {
		$this->theme->display_admin_block();
	}
}