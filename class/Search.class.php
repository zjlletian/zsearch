<?php
require_once(dirname(dirname(__FILE__)).'/Config.php');

class Search{
    //根据关键词搜索
    static function searchByKeyWord($keyword,$from,$size){
        ESConnector::connect();
        $searcharray=[
            "from"=> $from,
            "size"=> $size,
            "query"=>[
                "query_string"=>[
                    "query"=>$keyword,
                    "default_field"=> "title",
                    "fields"=> ["title","url","text"]
                ]
            ],
            "highlight"=>[
                "fields"=>[
                    "title"=>new stdClass(),
                    "text"=>new stdClass()
                ]
            ]
        ];
        return ESConnector::search('zspider','html',$searcharray);
    }
}
