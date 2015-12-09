<?php
/**
 * Created by PhpStorm.
 * User: maciej
 * Date: 08/12/2015
 * Time: 21:54
 */

/**
 * This class handles XML document that contains QOF Data
 */
class LoadQofData
{

    /**
     * Stores url of the QOF xml file within the class.
     * @var string
     */
    private $fileUrl;

    /**
     * Stores XML file contents
     * @var object
     */
    private $fileContent;


    /**
     * @param string $file URL of the XML file.
     */
    function __construct($file = "")
    {
        // sets $fileUrl variable
        $this->fileUrl = !empty($file) ? $file : "";
    }

    /**
     * Function checks HTTP response for code 200 in order to establish if the file exists under the given URL.
     * @return boolean Returns true if file exists, false otherwise.
     */
    private function fileExists()
    {
        if(empty($this->fileUrl)){
            $message = sprintf("File url is empty!\n", $this->fileUrl);
            die($message);
        }

        // stores HTTP response headers
        $file_headers = @get_headers($this->fileUrl);

        return $file_headers[0] === 'HTTP/1.1 200 OK' ? true : false;
    }

    /**
     * Checks if given file is of XML type.
     * @return boolean Returns true if file is of XML type, returns false otherwise.
     */
    private function fileIsXml()
    {

        // Stores URL path component.
        $file = parse_url($this->fileUrl, PHP_URL_PATH);

        // Stores file extention.
        $file = pathinfo($file, PATHINFO_EXTENSION);

        return strtolower($file) === "xml" ? true : false;
    }


    /**
     * Loads entire XML file to $fileContent variable.
     * @return bool Returns true if success, false otherwise.
     */
    private function loadXml()
    {
        if(!$this->fileExists()){
            $message = sprintf("File: '%s' does not exist!\n", $this->fileUrl);
            die($message);
        }

        if(!$this->fileIsXml()){
            $message = sprintf("File: '%s' is not of XML type!\n", $this->fileUrl);
            die($message);
        }

        // Loads contents of the XML file into $fileContent variable.
        if(!$this->fileContent = simplexml_load_file($this->fileUrl)){
            $message = sprintf("Could not load file: %s\n", $this->fileUrl);
            die($message);
        }
    }

    /**
     * Returns data array.
     * @return array
     */
    public function getDataArray(){

        // Stores data array.
        $dataArray = array();

        // Loads the XML file.
        $this->loadXml();


        foreach($this->fileContent as $item) {

            // Stores item attributes in appropriate variable.
            list($type, $score, $targetScore) = $item->attributes();

            // Stores item value as string
            $description = trim((string)$item);

            // Stores entire item in an array, values are casted to a string type.
            $dataArray[] = array(
                "type" => (string)$type,
                "score" => (string)$score,
                "targetScore" => (string)$targetScore,
                "description" => $description,
            );
        }

        // Return data array.
        return $dataArray;
    }
}