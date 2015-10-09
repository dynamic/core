<?php

class Linkable extends DataExtension {

  private static $db = array(
    'LinkType' => 'Enum("None, Internal, External", "None")',
    'ExternalLink' => 'Varchar(255)',
    'LinkLabel' => 'Varchar(255)'
  );

  private static $has_one = array(
    'PageLink' => 'SiteTree'
  );

  public function getLinkStatus() {
    if ($this->owner->LinkType != "None") {
      if ($this->owner->LinkType == 'Internal' && $this->owner->PageLink()->exists()) return 'yes';
      if ($this->owner->LinkType == 'External' && $this->owner->ExternalLink) return 'yes';
    }
    return 'no';
  }

  public function LinkStatus() {
    return $this->getLinkStatus();
  }

  public function getLinkTag() {
    if ($this->owner->LinkType == 'Internal' && $this->owner->PageLink()->exists())
      return '<a href="' . $this->owner->PageLink()->Link() . '">' . $this->owner->Title . '</a>';
    if ($this->owner->LinkType == 'External' && $this->owner->ExternalLink)
      return '<a href="' . $this->owner->ExternalLink . '" target="_blank">' . $this->owner->Title . '</a>';
    return false;
  }

  public function updateCMSFields(FieldList $fields) {
    $fields->removeByName('PageLinkID');
    $fields->addFieldsToTab('Root.Link', array(
      OptionSetField::create("LinkType", "Link", singleton($this->owner->class)->dbObject('LinkType')->enumValues()),
      TextField::create('LinkLabel', 'Link Label')
        ->displayIf("LinkType")->isEqualTo("Internal")->orIf("LinkType")->isEqualTo("External")->end(),
      DisplayLogicWrapper::create(
        TreeDropdownField::create('PageLinkID', 'Link to Page', 'SiteTree')
      )->displayIf('LinkType')->isEqualTo('Internal')->end(),
      TextField::create('ExternalLink', 'External URL')
        ->setAttribute('Placeholder', 'http://')
        ->displayIf("LinkType")->isEqualTo("External")->end(),
    ));
  }

}