<?php

namespace Digeetis\APIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation;

class APIController extends Controller{
    
    private function isDateValid($timestamp){
        if(!empty($timestamp)){
            if(!is_numeric($timestamp)){
                return FALSE;
            }
            $datetime = new \DateTime();
            if(!$datetime->setTimestamp($timestamp)){
                return FALSE;                
            }
            return TRUE;
        }
        else{
            return TRUE;
        }
    }
    
    private function isLimitValid($limit){
        if(!empty($limit)){
            if(!is_numeric($limit) || $limit<=0){
                return FALSE;
            }
            return TRUE;
        }
        else{
            return TRUE;
        }
    }
    
    private function isReturnFormatValid($returnFormat){
        if(!empty($returnFormat)){
            if(!in_array($returnFormat, array('json'))){
                return FALSE;
            }
            return TRUE;
        }
        else{
            return TRUE;
        }
    }
    
    public function getStreamAction(){ 
        $request = $this->getRequest();
        
        /*if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }*/
        
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            $response = new \Symfony\Component\HttpFoundation\Response();
            $response->headers->set('Content-type', 'application/json');
            $response->headers->set("Access-Control-Allow-Origin", "*");
            $response->headers->set("Access-Control-Allow-Methods", "GET, POST, OPTIONS");
            $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
            return $response;
            /*if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

            return;*/
        }
        
        $toEcho = array();
        $em = $this->getDoctrine()->getManager();
        
        $aggregate = $request->query->get('aggregate');
        $timestamp = $request->query->get('timestamp');
        $limit = $request->query->get('limit');
        $returnFormat = $request->query->get('format');
        if(empty($aggregate)){
            $toEcho['success'] = false;
            $toEcho['reason'] = "aggregate name is mandatory";
            $toEcho['error_code'] = 5;
            $content = $this->renderView('DigeetisAPIBundle::json.html.twig', array('data'=>json_encode($toEcho, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG)));
            $response = new HttpFoundation\Response($content);
            $response->headers->set('Content-type', 'application/json');
            $response->headers->set("Access-Control-Allow-Origin", "*");
            $response->headers->set("Access-Control-Allow-Methods", "GET, POST, OPTIONS");
            $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
            return $response;
        }
        if(!$this->isDateValid($timestamp)){
            $toEcho['success'] = false;
            $toEcho['reason'] = "timestamp is not valid (please go with unix timestamp)";
            $toEcho['error_code'] = 2;
            $content = $this->renderView('DigeetisAPIBundle::json.html.twig', array('data'=>json_encode($toEcho, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG)));
            $response = new HttpFoundation\Response($content);
            $response->headers->set('Content-type', 'application/json');
            $response->headers->set("Access-Control-Allow-Origin", "*");
            $response->headers->set("Access-Control-Allow-Methods", "GET, POST, OPTIONS");
            $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
            return $response;
        }
        if(!$this->isLimitValid($limit)){
            $toEcho['success'] = false;
            $toEcho['reason'] = "limit is not valid (please go with numeric >= 1)";
            $toEcho['error_code'] = 3;
            $content = $this->renderView('DigeetisAPIBundle::json.html.twig', array('data'=>json_encode($toEcho, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG)));
            $response = new HttpFoundation\Response($content);
            $response->headers->set('Content-type', 'application/json');
            $response->headers->set("Access-Control-Allow-Origin", "*");
            $response->headers->set("Access-Control-Allow-Methods", "GET, POST, OPTIONS");
            $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
            return $response;
        }
        if(!$this->isReturnFormatValid($returnFormat)){
            $toEcho['success'] = false;
            $toEcho['reason'] = "returnFormat is not valid (please go with json for now)";
            $toEcho['error_code'] = 4;
            $content = $this->renderView('DigeetisAPIBundle::json.html.twig', array('data'=>json_encode($toEcho, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG)));
            $response = new HttpFoundation\Response($content);
            $response->headers->set('Content-type', 'application/json');
            $response->headers->set("Access-Control-Allow-Origin", "*");
            $response->headers->set("Access-Control-Allow-Methods", "GET, POST, OPTIONS");
            $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
            return $response;
        }
        $aggregateObject = $em->getRepository('DigeetisAPIBundle:Aggregate')->findOneBy(array('name'=>$aggregate));
        if(empty($aggregateObject)){
            $toEcho['success'] = false;
            $toEcho['reason'] = "Aggregate does not exist";
            $toEcho['error_code'] = 5;
            $content = $this->renderView('DigeetisAPIBundle::json.html.twig', array('data'=>json_encode($toEcho, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG)));
            $response = new HttpFoundation\Response($content);
            $response->headers->set('Content-type', 'application/json');
            $response->headers->set("Access-Control-Allow-Origin", "*");
            $response->headers->set("Access-Control-Allow-Methods", "GET, POST, OPTIONS");
            $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
            return $response;
        }
        $asStream = $em->getRepository('DigeetisAPIBundle:AggregateStream');
        $streams = $asStream->findBy(array('aggregate'=>$aggregateObject));
        $toEcho['stream'] = array();
        $toEcho['stream']['title'] = $aggregateObject->getName();
        $toEcho['stream']['description'] = null;
        $toEcho['stream']['items'] = array();
        $count = 0;
        foreach($streams as $obj){
            foreach($obj->getStream()->getArticles() as $assoc){
                $item = array();
                $article = $assoc->getArticle();
                if(empty($timestamp)){
                    $item['action'] = 'add';
                }
                else{
                    $dateYMDHIS = $timestamp;
                    $dateCreation = $article->getDateCreation();
                    $dateUpdate = $article->getDateUpdate();
                    $isDeleted = $article->getIsDeleted();
                    if(!empty($dateUpdate) && $dateYMDHIS<$dateUpdate && $isDeleted==TRUE){
                        $item['action'] = 'delete';
                    }
                    else if($dateYMDHIS < $dateCreation && (empty($dateUpdate) ||  $dateYMDHIS<$dateUpdate)){
                        $item['action'] = 'add';
                    }
                    else if($dateYMDHIS >= $dateCreation && $dateYMDHIS<=$dateUpdate){
                        $item['action'] = 'update';
                    }
                    //process
                }
                if(isset($item['action']) && !empty($item['action'])){
                    $item['id'] = $article->getId();
                    $item['title'] = $article->getTitle();
                    $item['pubDate'] = $article->getDateCreation();
                    $item['updateDate'] = $article->getDateUpdate();
                    $item['thumbnails'] = $article->getThumbnails();
                    $item['content'] = $article->getContent();
                    $toEcho['stream']['items'][] = $item;
                    ++$count;
                    if(!empty($limit)){
                        if(count($toEcho['stream']['items'])>=$limit){
                            $toEcho['success'] = true;
                            $content = $this->renderView('DigeetisAPIBundle::json.html.twig', array('data'=>json_encode($toEcho, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG)));
                            $response = new HttpFoundation\Response($content);
                            $response->headers->set('Content-type', 'application/json');
                            $response->headers->set("Access-Control-Allow-Origin", "*");
                            $response->headers->set("Access-Control-Allow-Methods", "GET, POST, OPTIONS");
                            $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
                            return $response;
                        }
                    }
                }
            }
        }
        $toEcho['success'] = true;
        $content = $this->renderView('DigeetisAPIBundle::json.html.twig', array('data'=>json_encode($toEcho, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG)));
        $response = new HttpFoundation\Response($content);
        $response->headers->set('Content-type', 'application/json');
        $response->headers->set("Access-Control-Allow-Origin", "*");
        $response->headers->set("Access-Control-Allow-Methods", "GET, POST, OPTIONS");
        $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        return $response;
    }
    
}
