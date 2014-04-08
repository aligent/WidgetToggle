<?php
/**
 * Created by PhpStorm.
 * User: brent
 * Date: 7/04/14
 * Time: 10:48 AM
 */
class Aligent_Widget_Block_Widget_Adminhtml_Widget_Instance_Edit_Tab_Main extends Mage_Widget_Block_Adminhtml_Widget_Instance_Edit_Tab_Main {


    protected function _prepareForm()
    {
        parent::_prepareForm();

        $oHelper = Mage::helper('widget');
        $oForm = $this->getForm();
        $oFieldSet = $oForm->getElement('base_fieldset');

        $sDateFormatIso = Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);
        $sInputImage = $this->getSkinUrl('images/grid-cal.gif');
        $bTime = false;

        $sEnabledField = 'enabled';
        $sEnabledLabel = 'Enabled';

        $oFieldSet->addField($sEnabledField, 'select', array(
            'label'     => $oHelper->__($sEnabledLabel),
            'title'     => $oHelper->__($sEnabledLabel),
            'name'      => $sEnabledField,
            'required'  => true,
            'options'   => array(
                '1'         => $oHelper->__('Enabled'),
                '0'         => $oHelper->__('Disabled'),
            ),
            'note'      => $oHelper->__('Toggles the widget to display or not.')
        ));

        $sFromField = 'from_date';
        $sFromLabel = 'From Date';

        $oFieldSet->addField($sFromField, 'date', array(
            'name'          => $sFromField,
            'label'         => $oHelper->__($sFromLabel),
            'title'         => $oHelper->__($sFromLabel),
            'image'         => $sInputImage,
            'input_format'  => Varien_Date::DATE_INTERNAL_FORMAT,
            'format'        => $sDateFormatIso,
            'time'          => $bTime,
            'note'          => Mage::helper('widget')->__('Widget will display from this date (inclusive), but only if the widget is enabled.')
        ));

        $sToField = 'to_date';
        $sToLabel = 'To Date';

        $oFieldSet->addField($sToField, 'date', array(
            'name'          => $sToField,
            'label'         => $oHelper->__($sToLabel),
            'title'         => $oHelper->__($sToLabel),
            'image'         => $sInputImage,
            'input_format'  => Varien_Date::DATE_INTERNAL_FORMAT,
            'format'        => $sDateFormatIso,
            'time'          => $bTime,
            'note'          => Mage::helper('widget')->__('Widget will display to this date (exclusive), but only if the widget is enabled.')
        ));

    }

}
