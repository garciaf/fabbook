<?php

namespace Fabfoto\TrainTimingBundle\Station\StationFetcher;

use Fabfoto\TrainTimingBundle\Station\Exception\StationException;
use Fabfoto\TrainTimingBundle\Entity\Station;

class ApiFetcher implements FetcherInterface
{
    public function fetch()
    {
        $url = "http://sncf.mobi/infotrafic/iphoneapp/gares/index/lastUpdate/20090116182247";

        $data = $this->getContents($url);

        if (empty($data)) {
            throw new StationException('Received empty data from sncf.com');
        }

        $data = json_decode($data, true);

        if (null === $data) {
            throw new StationException('Unable to decode data from sncf.com');
        }

        $i = 0;
        $stations = array();
        //echo var_dump($data);die();
        foreach ($data["stations"] as $stationData) {
            $station = $this->createStation($stationData);
            //Test to get only the real train stations
            if($station->getStationType()==0){
                $stations[] = $station;
            }
        }

        return $stations;
    }

    protected function getContents($url)
    {
        return @file_get_contents($url);
    }

    protected function createStation($data)
    {
        return new Station($data);
    }

}
