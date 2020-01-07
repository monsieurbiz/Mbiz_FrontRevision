<?php
/**
 * This file is part of Mbiz_FrontRevision for Magento.
 *
 * @license MIT
 * @author Maxime Huran <m.huran@monsieurbiz.com> <@MaximeHuran>
 * @category Mbiz
 * @package Mbiz_FrontRevision
 * @copyright Copyright (c) 2020 Monsieur Biz (https://monsieurbiz.com)
 */

class Mbiz_FrontRevision_Block_Html_Head extends Mage_Page_Block_Html_Head
{
    /**
     * Append revision number to JS and CSS filepath via regex
     * @return string
     */
    protected function &_prepareStaticAndSkinElements($format, array $staticItems, array $skinItems, $mergeCallback = null)
    {
        $html = parent::_prepareStaticAndSkinElements($format, $staticItems, $skinItems, $mergeCallback);
        $html = preg_replace('/href="(.*)\.css"/isU', sprintf('href="$1.css?v=%s"', $this->getRevisionNumber()), $html);
        $html = preg_replace('/src="(.*)\.js"/isU', sprintf('src="$1.js?v=%s"', $this->getRevisionNumber()), $html);

        return $html;
    }

    /**
     * @return string
     */
    private function getRevisionNumber()
    {
        return (string) Mage::getStoreConfig('dev/css_js_revision/revision_number');
    }
}
