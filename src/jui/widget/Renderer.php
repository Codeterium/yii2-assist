<?php

/**
 * @package   yii2-assist
 * @version   1.0.1
 */

namespace codeterium\yii2assist\jui\widget;


use yii\helpers\Html;
use codeterium\yii2assist\jui\Widget;
use yii\base\Component;
use yii\widgets\Pjax;

class Renderer extends Component
{
    /**
     * @var Widget
     */
    public $widget;

    /**
     * @var isPjax
     */
    public $isPjax = false;

    /**
     * Begin Container
     *
     * @return string
     */
    public function beginContainer()
    {
        $options = $this->widget->options;
        $result = '';
        if ($this->isPjax) {
            ob_start();
            Pjax::begin([
                'id' => $this->widget->pjaxId,
                'options' => $this->widget->pjaxOptions,
            ]);
            $result .= ob_get_clean();
        }

        return $result . Html::beginTag('div', $options);
    }

    /**
     * End Container
     *
     * @return string
     */
    public function endContainer()
    {
        if ($this->isPjax) {
            ob_start();
            Pjax::end();
            echo Html::endTag('div');
            $result = ob_get_clean();
            return $result;
        }

        return Html::endTag('div');
    }
}
