<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class XmlToArrayController extends Controller
{
    /**
     * @Route("/read", name="read")
     */
    public function indexAction()
    {
        $max = 10;
        $number = random_int(0, $max);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }



    /**
     * @Route("/read1", name="read1")
     */
    public function read1Action()
    {
        $xmlfile = '/home/vinam/Downloads/google.com!cxsoftinfo.com!1532390400!1532476799.xml';
        $xmlDoc = new \DOMDocument();
        $xmlDoc->load($xmlfile);

        $x = $xmlDoc->documentElement;
        foreach ($x->childNodes AS $item) {
            print $item->nodeName . " = " . $item->nodeValue . "<br>";
        }

        die();
    }



    /**
     * @Route("/read2", name="read2")
     */
    public function read2Action()
    {
        $xmlfile = '/home/vinam/Downloads/google.com!cxsoftinfo.com!1532390400!1532476799.xml';
        $xmlparser = xml_parser_create();

        // open a file and read data
        $fp = fopen($xmlfile, 'r');
        $xmldata = fread($fp, 4096);

        xml_parse_into_struct($xmlparser,$xmldata,$values);

        xml_parser_free($xmlparser);
        print_r($values);

        die();
    }



    /**
     * @Route("/read3", name="read3")
     */
    public function read3Action()
    {
        $path = '/home/vinam/Downloads/google.com!cxsoftinfo.com!1532390400!1532476799.xml';
        $xmlfile = file_get_contents($path);
        $dom = new \DOMDocument;
        $dom->loadXML($xmlfile);
        $books = $dom->getElementsByTagName('auth_results');
        foreach ($books as $book) {
            //echo $book->nodeValue, PHP_EOL;
            print_r($book);
            echo "<br/><br/><br/>";
        }

        die();
    }



    /**
     * @Route("/read4", name="read4")
     */
    public function read4Action()
    {
        // Convert sample.xml File Into String.
        $path = '/home/vinam/Downloads/google.com!cxsoftinfo.com!1532390400!1532476799.xml';
        $xmlfile = file_get_contents($path);

        // Convert string of XML into an Object
        $ob= simplexml_load_string($xmlfile);

        // Encode XML Object Into JSON
        $json  = json_encode($ob);

        // Decode Json Object
        $configData = json_decode($json, true);

        print_r($configData);
        die();
    }
}
?>
