<?php

class Asd_CategoryList_Block_Categorylist extends \Mage_Core_Block_Abstract implements Mage_Widget_Block_Interface {

    protected function _toHtml() {
        $html = '';
        $currentCategory = Mage::getModel('catalog/layer')->getCurrentCategory();
        $currentCategoryLevel = $currentCategory->getLevel();
        if( $currentCategoryLevel == 2 ) {
            $currentCategoryId = $currentCategory->getId();
        } elseif( $currentCategoryLevel > 2 ) {
            $currentCategoryId = $currentCategory->getParentId();
        } else {
            $currentCategoryId = 0;
        }

        if( $currentCategoryId > 0 ) {
            $parentCategory = Mage::getModel('catalog/category')->load( $currentCategoryId );
            $childCategories = $parentCategory->getChildrenCategories()->addIsActiveFilter();
            if( $childCategories->count() > 0 ) {
                $currentCategoryId = $currentCategory->getId();
                $html .= '<nav><ul>';
                foreach( $childCategories as $category ) {
                    $class = $currentCategoryId == $category->getId() ? ' class="active"' : '';
                    $html .= '<li' . $class . '><a href="' . $category->getUrl() . '">' . $category->getName() . '</a></li>';
                }
                $html .= '</ul></nav>';
            }
        }
        return $html;
    }
    
    public function addData(array $arr) {
        
    }

    public function setData($key, $value = null) {
        
    }

}
