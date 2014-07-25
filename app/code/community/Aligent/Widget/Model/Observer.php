<?php

class Aligent_Widget_Model_Observer {

    public function widgetWidgetInstanceSaveBefore($oObserver)
    {
        $oRequest = Mage::app()->getRequest();
        $oWidgetInstance = $oObserver->getObject();

        $sEnabled = (bool) $oRequest->getPost('enabled');
        $sFromDate = (string) $oRequest->getPost('from_date');
        $sToDate = (string) $oRequest->getPost('to_date');

        if ($sFromDate) {
            $sFromDate = date('Y-m-d', strtotime(str_replace('/', '-', $sFromDate)));
        } else {
            $sFromDate = null;
        }

        if ($sToDate) {
            $sToDate = date('Y-m-d', strtotime(str_replace('/', '-', $sToDate)));
        } else {
            $sToDate = null;
        }


        $oWidgetInstance->setEnabled($sEnabled);
        $oWidgetInstance->setFromDate($sFromDate);
        $oWidgetInstance->setToDate($sToDate);
    }

    public function widgetWidgetInstanceCollectionLoadBefore($oObserver)
    {
        $sDate = date("Y-m-d", Mage::getModel('core/date')->timestamp(time()));
        $cWidgets = $oObserver->getWidgets();
        $cWidgets
            ->addFieldToSelect('*')
            ->addFieldToFilter('enabled', 1);

        $cWidgets->getSelect()->where("(from_date IS NULL AND to_date IS NULL) OR ('$sDate' >= from_date AND to_date IS NULL) OR ('$sDate' < to_date AND from_date IS NULL) OR ('$sDate' >= from_date AND '$sDate' < to_date)");
    }


    /**
     * Flushes BLOCK_HTML cache
     */
    private function _flushCache()
    {
        try {
            $type = 'block_html';
            Mage::app()->getCacheInstance()->cleanType($type);

        } catch (Exception $e) {
            Mage::log($e->getMessage());
        }
    }

    /**
     * Flushes cache if there's any from_date or to_date of any enabled widget equal to today.
     * @param Varien_Event_Observer $oObserver
     */
    public function widgetWidgetInstanceFlushCache(Varien_Event_Observer $oObserver)
    {
        /** @var $oWidget Mage_Widget_Model_Widget_Instance */

        $sDate = date("Y-m-d", Mage::getModel('core/date')->timestamp(time()));

        $oWidgets = Mage::getModel('widget/widget_instance')
            ->getCollection()
            ->addFieldToSelect('*')
            ->addFieldToFilter('enabled', 1)
            ->addFieldToFilter(array('from_date', 'to_date'), array($sDate, $sDate))
        ;

        if($oWidgets->count() > 0)
        {
            $this->_flushCache();
        }
    }
}
