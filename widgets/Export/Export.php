<?php

namespace app\widgets\Export;

use kartik\export\ExportMenu;
use Yii;

class Export extends ExportMenu
{
    public $exportType = self::FORMAT_CSV;

    /**
     * Initializes the export menu.
     */
    public function init()
    {
        // Set default ID if not provided
        if (empty($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }

        // Set default export request parameter
        if (empty($this->exportRequestParam)) {
            $this->exportRequestParam = 'exportFull_' . $this->options['id'];
        }

        // Set POST parameters for export
        $_POST[Yii::$app->request->methodParam] = 'POST';
        $_POST[$this->exportRequestParam] = true;
        $_POST[$this->exportTypeParam] = $this->exportType;
        $_POST[$this->colSelFlagParam] = false;

        parent::init();
    }
}
