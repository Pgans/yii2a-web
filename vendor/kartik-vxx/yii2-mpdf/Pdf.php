<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2017
 * @package yii2-mpdf
 * @version 1.0.1
 */

namespace kartik\mpdf;

use mPDF;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;

/**
 * The Pdf class is a Yii2 component that allows to convert HTML content to portable document format (PDF). It allows
 * configuration of how the PDF document is generated and how it should be delivered to the user. This component uses
 * the [[mPDF]] library and includes various additional enhancements specifically for the Yii2 framework.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class Pdf extends Component
{
    /**
     * Blank default mode
     */
    const MODE_BLANK = '';
    /**
     * Core fonts mode
     */
    const MODE_CORE = 'c';
    /**
     * Unicode UTF-8 encoded mode
     */
    const MODE_UTF8 = 'UTF-8';
    /**
     * Asian fonts mode
     */
    const MODE_ASIAN = '+aCJK';
    /**
     * A3 page size format
     */
    const FORMAT_A3 = 'A3';
    /**
     * A4 page size format
     */
    const FORMAT_A4 = 'A4';
    /**
     * Letter page size format
     */
    const FORMAT_LETTER = 'Letter';
    /**
     * Legal page size format
     */
    const FORMAT_LEGAL = 'Legal';
    /**
     * Folio page size format
     */
    const FORMAT_FOLIO = 'Folio';
    /**
     * Ledger page size format
     */
    const FORMAT_LEDGER = 'Ledger-L';
    /**
     * Tabloid page size format
     */
    const FORMAT_TABLOID = 'Tabloid';
    /**
     * Portrait orientation
     */
    const ORIENT_PORTRAIT = 'P';
    /**
     * Landscape orientation
     */
    const ORIENT_LANDSCAPE = 'L';
    /**
     * File output sent to browser inline
     */
    const DEST_BROWSER = 'I';
    /**
     * File output sent for direct download
     */
    const DEST_DOWNLOAD = 'D';
    /**
     * File output sent to a file
     */
    const DEST_FILE = 'F';
    /**
     * File output sent as a string
     */
    const DEST_STRING = 'S';
    /**
     * @var string specifies the mode of the new document. If the mode is set by passing a country/language string,
     * this may also set: available fonts, text justification, and directionality RTL.
     */
    public $mode = self::MODE_BLANK;
    /**
     * @var string|array, the format can be specified either as a pre-defined page size, or as an array of width and
     * height in millimetres.
     */
    public $format = self::FORMAT_A4;
    /**
     * @var integer sets the default document font size in points (pt)
     */
    public $defaultFontSize = 0;
    /**
     * @var string sets the default font-family for the new document. Uses default value set in defaultCSS
     * unless codepage has been set to "win-1252". If codepage="win-1252", the appropriate core Adobe font
     * will be set i.e. Helvetica, Times, or Courier.
     */
    public $defaultFont = '';
    /**
     * @var float sets the page left margin for the new document. All values should be specified as LENGTH in
     * millimetres. If you are creating a DOUBLE-SIDED document, the margin values specified will be used for
     * ODD pages; left and right margins will be mirrored for EVEN pages.
     */
    public $marginLeft = 15;
    /**
     * @var float sets the page right margin for the new document (in millimetres).
     */
    public $marginRight = 15;
    /**
     * @var float sets the page top margin for the new document (in millimetres).
     */
    public $marginTop = 16;
    /**
     * @var float sets the page bottom margin for the new document (in millimetres).
     */
    public $marginBottom = 16;
    /**
     * @var float sets the page header margin for the new document (in millimetres).
     */
    public $marginHeader = 9;
    /**
     * @var float sets the page footer margin for the new document (in millimetres).
     */
    public $marginFooter = 9;
    /**
     * @var string specifies the default page orientation of the new document.
     */
    public $orientation = self::ORIENT_PORTRAIT;
    /**
     * @var string css file to prepend to the PDF
     */
    public $cssFile = '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css';
    /**
     * @var string additional inline css to append after the cssFile
     */
    public $cssInline = '';
    /**
     * @var string the HTML content to be converted to PDF
     */
    public $content = '';
    /**
     * @var string the output filename
     */
    public $filename = '';
    /**
     * @var string the output destination
     */
    public $destination = self::DEST_BROWSER;
    /**
     * @var string the folder path for storing the temporary data generated by mpdf.
     * If not set this defaults to `Yii::getAlias('@runtime/mpdf')`.
     */
    public $tempPath;
    /**
     * @var array the mPDF methods that will called in the sequence listed before rendering the content. Should be an
     * associative array entered as `$method => $params` pairs, where:
     * - `$method`: _string_, is the mPDF method / function name
     * - `$param`: _mixed_, are the mPDF method parameters
     */
    public $methods = '';
    /**
     * @var string the mPDF configuration options entered as `$key => value` pairs, where:
     * - `$key`: _string_, is the configuration property name
     * - `$value`: _mixed_, is the configured property value
     */
    public $options = [
        'autoScriptToLang' => true,
        'ignore_invalid_utf8' => true,
        'tabSpaces' => 4,
    ];
    /**
     * @var mPDF api instance
     */
    protected $_mpdf;
    /**
     * @var string the css file content
     */
    protected $_css;
    /**
     *
     * @var array list of file paths that should be attached to the generated PDF
     */
    protected $_pdfAttachments;

    /**
     * Defines a mPDF temporary path if not set.
     *
     * @param string $prop the mPDF constant to define
     * @param string $dir the directory to create
     *
     * @throws InvalidConfigException
     */
    protected static function definePath($prop, $dir)
    {
        if (defined($prop)) {
            return;
        }
        $status = true;
        if (!is_dir($dir)) {
            $status = mkdir($dir, 0777, true);
        }
        if (!$status) {
            throw new InvalidConfigException("Could not create the folder '{$dir}' in '\$tempPath' set.");
        }
        define($prop, $dir);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->initTempPaths();
        parent::init();
        $this->parseFormat();
    }

    /**
     * Initialize folder paths to allow [[mPDF]] to write temporary data.
     */
    public function initTempPaths()
    {
        if (empty($this->tempPath)) {
            $this->tempPath = Yii::getAlias('@runtime/mpdf');
        }
        $prefix = $this->tempPath . DIRECTORY_SEPARATOR;
        static::definePath('_MPDF_TEMP_PATH', "{$prefix}tmp");
        static::definePath('_MPDF_TTFONTDATAPATH', "{$prefix}ttfontdata");
    }

    /**
     * Renders and returns the PDF output. Uses the class level property settings.
     *
     * @return mixed
     */
    public function render()
    {
        $this->configure($this->options);
        if (!empty($this->methods)) {
            foreach ($this->methods as $method => $param) {
                $this->execute($method, $param);
            }
        }
        return $this->output($this->content, $this->filename, $this->destination);
    }

    /**
     * Validates and fetches the mPDF API instance.
     *
     * @return mPDF
     */
    public function getApi()
    {
        if (empty($this->_mpdf) || !$this->_mpdf instanceof mPDF) {
            $this->setApi();
        }
        return $this->_mpdf;
    }

    /**
     * Sets the mPDF API instance
     */
    public function setApi()
    {
        $this->_mpdf = new mPDF(
            //$this->mode,
            'thsaraban',
            $this->format,
            $this->defaultFontSize,
            $this->defaultFont,
            $this->marginLeft,
            $this->marginRight,
            $this->marginTop,
            $this->marginBottom,
            $this->marginHeader,
            $this->marginFooter,
            $this->orientation
        );
    }

    /**
     * Fetches the content of the CSS file if supplied
     *
     * @return string
     */
    public function getCss()
    {
        if (!empty($this->_css)) {
            return $this->_css;
        }
        $cssFile = empty($this->cssFile) ? '' : Yii::getAlias($this->cssFile);
        if (empty($cssFile) || !file_exists($cssFile)) {
            $css = '';
        } else {
            $css = file_get_contents($cssFile);
        }
        $css .= $this->cssInline;
        return $css;
    }

    /**
     * Gets the list of currently attached PDF attachments.
     *
     * @return array
     */
    public function getPdfAttachments()
    {
        return $this->_pdfAttachments;
    }

    /**
     * Adds a PDF attachment to the generated PDF
     *
     * @param string $filePath
     */
    public function addPdfAttachment($filePath)
    {
        $this->_pdfAttachments[] = $filePath;
    }

    /**
     * Configures mPDF options
     *
     * @param array $options the mPDF configuration options entered as `$key => value` pairs, where:
     * - `$key`: _string_, is the configuration property name
     * - `$value`: _mixed_, is the configured property value
     */
    public function configure($options = [])
    {
        if (empty($options)) {
            return;
        }
        $api = $this->getApi();
        foreach ($options as $key => $value) {
            if (property_exists($api, $key)) {
                $api->$key = $value;
            }
        }
    }

    /**
     * Calls the mPDF method with parameters
     *
     * @param string $method the mPDF method / function name
     * @param array  $params the mPDF parameters
     *
     * @return mixed
     * @throws InvalidParamException
     */
    public function execute($method, $params = [])
    {
        $api = $this->getApi();
        if (!method_exists($api, $method)) {
            throw new InvalidParamException("Invalid or undefined mPDF method '{$method}' passed to 'Pdf::execute'.");
        }
        if (!is_array($params)) {
            $params = [$params];
        }
        return call_user_func_array([$api, $method], $params);
    }

    /**
     * Generates a PDF output
     *
     * @param string $content the input HTML content
     * @param string $file the name of the file. If not specified, the document will be sent to the browser inline
     * (i.e. [[DEST_BROWSER]]).
     * @param string $dest the output destination. Defaults to [[DEST_BROWSER]].
     *
     * @return mixed
     */
    public function output($content = '', $file = '', $dest = self::DEST_BROWSER)
    {
        $api = $this->getApi();
        $css = $this->getCss();
        $pdfAttachments = $this->getPdfAttachments();
        if (!empty($css)) {
            $api->WriteHTML($css, 1);
            $api->WriteHTML($content, 2);
        } else {
            $api->WriteHTML($content);
        }

        if ($pdfAttachments) {
            $api->SetImportUse();
            $api->SetHeader(null);
            $api->SetFooter(null);
            foreach ($pdfAttachments as $attachment) {
                $this->writePdfAttachment($api, $attachment);
            }
        }
        return $api->Output($file, $dest);
    }

    /**
     * Parse the format automatically based on the orientation
     */
    protected function parseFormat()
    {
        $landscape = self::ORIENT_LANDSCAPE;
        $tag = '-' . $landscape;
        if ($this->orientation == $landscape && is_string($this->format) && substr($this->format, -2) != $tag) {
            $this->format .= $tag;
        }
    }

    /**
     * Appends the given attachment to the generated PDF
     *
     * @param mPDF   $api the mPDF API instance
     * @param string $attachment the attachment name
     */
    private function writePdfAttachment($api, $attachment)
    {
        $pageCount = $api->SetSourceFile($attachment);
        for ($i = 1; $i <= $pageCount; $i++) {
            $api->AddPage();
            $templateId = $api->ImportPage($i);
            $api->UseTemplate($templateId);
        }
    }

}