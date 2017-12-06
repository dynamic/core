<?php

/**
 * Class NewsMigrationTask
 */
class NewsMigrationTask extends BuildTask
{
	/**
	 * @var string
	 */
	protected $title = 'Migrate news to blog';

	/**
	 * @var string
	 */
	protected $description = 'Migrates NewsHolder and NewsArticle pages to Blog and BlogPost pages respectively';

	/**
	 * @var bool
	 */
	protected $enabled = true;

	/**
	 * @param $request
	 */
	public function run($request)
	{
		$this->migrate();
	}

	/**
	 *
	 */
	private function migrate()
	{
		$blogCount = 0;
		$postCount = 0;
		$tagCount = 0;

		$this->updatePages(Blog::class, 'NewsHolder', $blogCount, $tagCount);
		$this->updatePages(BlogPost::class, 'NewsArticle', $postCount, $tagCount);

		echo "<br />";
		echo "Updated {$tagCount} tags. (only updated ones that where used)<br />";
		echo "Updated {$blogCount} blogs and {$postCount} posts. <br />";
	}

	/**
	 * @param $class
	 * @param $old
	 * @param $count
	 */
	private function updatePages($class, $old, &$count, &$tagCount)
	{
		SiteTree::get()->each(function (SiteTree $page) use ($class, $old, &$count, &$tagCount) {
			if ($page->getObsoleteClassName() === $old || $page->getClassName() === $old) {
				$published = $page->isPublished();

				$oldTags = false;
				$imageID = 0;
				$publishDate = false;
				if ($class === BlogPost::class) {
					$oldTags = $page->Tags();
					if ($page->ThumbnailID > 0) {
						$imageID = $page->ThumbnailID;
					} else {
						$imageID = $page->ImageID;
					}
					$publishDate = $page->DateAuthored;
				}

				/** @var SiteTree $page */
				$page = $page->newClassInstance($class);

				// post gets all tags if this isn't done
				$page->Tags()->removeAll();

				// add image relation
				if ($imageID > 0) {
					$page->FeaturedImageID = $imageID;
				}

				if ($publishDate) {
					$page->PublishDate = $publishDate;
				}

				// write the page
				$page->write();
				if ($published && ($class !== BlogPost::class || (
							$class === BlogPost::class && $publishDate
						))) {
					$page->doPublish();
				} else if ($class === BlogPost::class && !$publishDate) {
					echo "'{$page->Title}' was not published because it had no publish date. <br />";
				}
				$this->addTags($page, $oldTags, $tagCount);

				$count++;
			}
		});
	}

	/**
	 * @param SiteTree $page
	 * @param DataList|bool $oldTags
	 * @param $count
	 */
	private function addTags(SiteTree $page, DataList $oldTags, &$count)
	{
		if (!$oldTags) {
			return;
		}

		if ($page->getClassName() === BlogPost::class) {
			$oldTags->each(function ($tag) use ($page, &$count) {
				$new = BlogTag::get()->filter(array(
					'Title' => $tag->Title,
					'BlogID' => $page->ParentID
				))->first();

				if ($new === null) {
					$new = BlogTag::create();
					$new->Title = $tag->Title;
					$new->BlogID = $page->ParentID;
					$new->write();

					$count++;
				}

				if ($new != null) {
					$page->Tags()->add($new);
				}
			});
		}
	}
}
