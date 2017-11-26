<?php

namespace ChemicalsBundle\Utils;

/**
 * Class REST Helper.
 *
 * @author Aurélien Muller
 */
class RESTHelper
{
    /**
     * Gets data from periodic table of chemical elements.
     * 
     * Json format formula -> name.
     * Uses a REST webservice. Not in use anymore !
     *
     * @return mixed
     */
    public function getPeriodicElements()
    {
        // That URL is used to get the list of chemical elements :
        // key: formula; value : name.
        // NB : that webservice is now deprecated.
        $serviceUrl = "https://nickclifford.me/api/pt.php?mode=names";
        return $this->get($serviceUrl, 'json');
    }
    
    /**
     * Sends a GET request on service url.
     *
     * @param type $serviceUrl
     * @param type $format
     *
     * @return mixed
     */
    public function get($serviceUrl, $format = 'json')
    {
        $curl = curl_init($serviceUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $curlResponse = curl_exec($curl);
        curl_close($curl);

        // Return type will be array.
        if ($format == 'json') {
            $curlResponse = json_decode($curlResponse, true);
        }
        
        return $curlResponse;
    }
}
