<?php

namespace Fabfoto\TrainTimingBundle\Station\StationFetcher;

use Fabfoto\TrainTimingBundle\Station\Exception\StationException;

interface FetcherInterface
{
    /**
     * Fetch the last tweets of a user on twitter
     *
     * @throws StationException When we do not manage to get a valid answer from the sncf API
     *
     * @return array
     */
    public function fetch();
}
