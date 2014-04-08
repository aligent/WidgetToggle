<?php
/**
 * Created by PhpStorm.
 * User: brent
 * Date: 7/04/14
 * Time: 10:48 AM
 */
class Aligent_Widget_Block_Widget_Adminhtml_Widget_Instance_Grid extends Mage_Widget_Block_Adminhtml_Widget_Instance_Grid {

    protected function _prepareColumns()
    {
        $this->addColumnAfter('enabled', array(
            'header'    => Mage::helper('widget')->__('Enabled'),
            'width'     => '100',
            'align'     => 'center',
            'index'     => 'enabled',
        ), 'instance_id');

        $this->addColumnAfter('from_date', array(
            'header'    => Mage::helper('widget')->__('From Date'),
            'width'     => '100',
            'align'     => 'center',
            'index'     => 'from_date',
        ), 'enabled');

        $this->addColumnAfter('to_date', array(
            'header'    => Mage::helper('widget')->__('To Date'),
            'width'     => '100',
            'align'     => 'center',
            'index'     => 'to_date',
        ), 'from_date');

        return parent::_prepareColumns();
    }

}
