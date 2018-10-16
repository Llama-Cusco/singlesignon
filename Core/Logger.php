<?php


namespace Itratos\SingleSignOn\Core;


class Logger
{

    protected $logTitle = '';


    protected function getLogFilePath()
    {
        $logDirectoryPath = \OxidEsales\Eshop\Core\Registry::getConfig()->getLogsDir();

        return $logDirectoryPath . 'singlesignon.log';
    }


    public function setTitle($title)
    {
        $this->logTitle = $title;
    }


    public function getTitle()
    {
        return $this->logTitle;
    }


    public function log($logData)
    {

        $handle = fopen($this->getLogFilePath(), "a+");

        if ($handle !== false) {
            if (is_string($logData)) {
                parse_str($logData, $result);
            } else {
                $result = $logData;
            }

            if (is_array($result)) {
                foreach ($result as $key => $value) {
                    if (is_string($value)) {
                        $result[$key] = urldecode($value);
                    }
                }
            }

            fwrite($handle, "======================= " . $this->getTitle() . " [" . date("Y-m-d H:i:s") . "] ======================= #\n\n");
            fwrite($handle, trim(var_export($result, true)) . "\n\n");
            fclose($handle);
        }

        die();

        //resetting log title
        $this->setTitle('');
    }
}
