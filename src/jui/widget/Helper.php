<?php

/**
 * @package   yii2-assist
 * @version   1.0.1
 */

namespace codeterium\yii2assist\jui\widget;


use yii\base\BaseObject;
use yii\helpers\Inflector;

class Helper extends BaseObject
{
    public $widget = null;
    public function getBundleClass()
    {
        $className = $this->getWidgetClass();
        $bundleClass = $className . 'Asset';

        return $bundleClass;
    }

    /**
     * @return string
     */
    public function getDefaultCssClass()
    {
        $parts = explode('\\', get_class($this->widget));
        $cssClass = Inflector::camel2id($parts[count($parts) - 1]);
        return $cssClass;
    }

    public function registerBundle()
    {
        $bundleClass = $this->getBundleClass();
        if (class_exists($bundleClass)) {
            $bundleClass::register($this->widget->view);
        }
    }

    public function getDefaultJsWidgetName($className = null)
    {
        if ($className === null) {
            $className = $this->getWidgetClass();
        }

        $parts = explode('\\', $className);
        $name = $parts[count($parts) - 1];
        return $name;
    }

    /**
     * @return string
     */
    protected function getWidgetClass()
    {
        $className = get_class($this->widget);
        return $className;
    }
}
