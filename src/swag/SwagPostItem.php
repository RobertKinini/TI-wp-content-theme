<?php

require_once __DIR__."/../utils/H5pUtil.php";

/**
 * An item in a swag post.
 */
class SwagPostItem {

	private $index;
	private $swagPost;
	private $type;
	private $parameters;

	/**
	 * Constructor.
	 */
	public function __construct($type, $parameters) {
		$this->type=$type;
		$this->parameters=$parameters;
	}

	/**
	 * Set index.
	 */
	public function setSwagPost($swagPost) {
		$this->swagPost=$swagPost;
	}

	/**
	 * Set index.
	 */
	public function setIndex($index) {
		$this->index=$index;
	}

	/**
	 * Is this the selected index? Determines this by checking
	 * the $_REQUEST["tab"] value.
	 */
	public function isSelected() {
		return $_REQUEST["tab"]==$this->index;
	}

	/**
	 * Get direct url.
	 */
	public function getUrl() {
		return $this->swagPost->getPost()->post_permalink."?tab=".$this->index;
	}

	/**
	 * Is this part completed?
	 */
	public function isCompleted($swagUser) {
		$objectUrl=$this->getObjectUrl();

		foreach ($this->swagPost->getRelatedStatements($swagUser) as $statement) {
			if ($statement["object"]["id"]==$objectUrl)
				return TRUE;
		}

		return FALSE;
	}

	/**
	 * Get xAPI for checking completion.
	 */
	public function getObjectUrl() {
		if (!$this->objectUrl) {
			switch ($this->type) {
				case "h5p":
					$id=H5pUtil::getH5pIdByShortcodeArgs($this->parameters);
					$this->objectUrl=
						get_site_url().
						"/wp-admin/admin-ajax.php?action=h5p_embed&id=".$id;
					break;

				case "deliverable":
					$slug=$this->parameters["slug"];
					$this->objectUrl=
						get_site_url().
						"/wp-content/plugins/wp-deliverable/deliverable.php/".$slug;
					break;
			}
		}

		return $this->objectUrl;
	}

	/**
	 * Get the title.
	 */
	public function getTitle() {
		global $wpdb;

		switch ($this->type) {
			case "h5p":
				$id=H5pUtil::getH5pIdByShortcodeArgs($this->parameters);
				return H5pUtil::getH5pTitleById($id);
				break;

			case "deliverable":
				$slug=$this->parameters["slug"];
				$q=$wpdb->prepare("SELECT title FROM {$wpdb->prefix}deliverable WHERE slug=%s",$slug);
				$title=$wpdb->get_var($q);

				if ($wpdb->last_error)
					throw new Exception($wpdb->last_error);

				return $title;
				break;
		}
	}

	/**
	 * Get content.
	 */
	public function getContent() {
		switch ($this->type) {
			case "h5p":
				$id=H5pUtil::getH5pIdByShortcodeArgs($this->parameters);
				return do_shortcode("[h5p id='$id']");
				break;

			case "deliverable":
				$slug=$this->parameters["slug"];
				return do_shortcode("[deliverable slug='$slug']");
				break;
		}
	}
}