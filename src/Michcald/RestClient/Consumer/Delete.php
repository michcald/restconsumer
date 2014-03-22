<?php

namespace Michcald\RestClient\Consumer;

class Delete extends \Michcald\RestClient\Consumer
{
    public function execute()
    {
        $request = $this->getRequest();

        $curl = new Rest_Request_Curl();
        $curl->setOption(CURLOPT_TIMEOUT, 30)
                ->setOption(CURLOPT_URL, $request->getUrl())
                ->setOption(CURLOPT_RETURNTRANSFER, true)
                ->setOption(CURLOPT_POSTFIELDS, http_build_query($request->getParams()))
                ->setOption(CURLOPT_CUSTOMREQUEST, 'DELETE');

        if ($request->getAuth()) {
            $request->getAuth()->execute($curl);
        }

        $curl->execute();

        $response = new \Michcald\RestClient\Response();
        $response->setStatusCode($curl->getStatusCode())
            ->setContentType($curl->getContentType())
            ->setBody($curl->getResponse());

        return $response;
    }
}
